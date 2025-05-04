<?php

header('Content-Type: application/json');
require_once '../DB/Config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // On vérifie s’il faut renvoyer les clients ou les articles
    $type = $_GET['type'] ?? '';

    if ($type === 'clients') {
        try {
            $stmt = $pdo->query("SELECT id_client, nom_client FROM Client");
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($clients);
        } catch (Exception $e) {
            echo json_encode([]);
        }
        exit;
    }

    if ($type === 'articles') {
        try {
            $stmt = $pdo->query("SELECT id_article, designation, quantite_stock FROM Article WHERE quantite_stock > 0");
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($articles);
        } catch (Exception $e) {
            echo json_encode([]);
        }
        exit;
    }

    // Si aucun type n'est fourni
    echo json_encode([]);
    exit;
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $articles = $data['articles'] ?? [];

    if (empty($articles)) {
        echo json_encode(['success' => false, 'message' => 'Aucun article à enregistrer.']);
        exit;
    }

    try {
        $pdo->beginTransaction();

        $nom_client = $articles[0]['destinataire'];
        $date_sortie = $articles[0]['date_sortie'];

        // Récupérer l'ID du client
        $stmt = $pdo->prepare("SELECT id_client FROM Client WHERE nom_client = ?");
        $stmt->execute([$nom_client]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_client = $result['id_client'] ?? null;

        if (!$result) {
            throw new Exception("Client '$nom_client' introuvable.");
        }

        $stmt = $pdo->prepare("INSERT INTO SortieStock (date_sortie, id_client) VALUES (?, ?)");
        $stmt->execute([$date_sortie, $id_client]);
        $id_sortie = $pdo->lastInsertId();

        foreach ($articles as $article) {
            $nom_article = $article['nom'];
            $quantite = $article['quantite'];

            // Récupérer l'article avec stock
            $stmt = $pdo->prepare("SELECT id_article, quantite_stock FROM Article WHERE designation = ?");
            $stmt->execute([$nom_article]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                throw new Exception("Article '$nom_article' introuvable.");
            }

            $id_article = $result['id_article'];
            $stock_dispo = $result['quantite_stock'];

            if ($quantite > $stock_dispo) {
                throw new Exception("Stock insuffisant pour l'article '$nom_article'.");
            }

            // Enregistrement ligne sortie
            $stmt = $pdo->prepare("INSERT INTO LigneSortieStock (quantite, id_sortie, id_article) VALUES (?, ?, ?)");
            $stmt->execute([$quantite, $id_sortie, $id_article]);

            // Mise à jour du stock
            $stmt = $pdo->prepare("UPDATE Article SET quantite_stock = quantite_stock - ? WHERE id_article = ?");
            $stmt->execute([$quantite, $id_article]);
        }

        $pdo->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
