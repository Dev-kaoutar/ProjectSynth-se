<?php

// Connexion à la base de données
require_once '../DB/Config.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Si on demande les fournisseurs
        if (isset($_GET['fournisseurs'])) {
            $stmt = $pdo->query("SELECT id_fournisseur, nom_fournisseur FROM fournisseur");
            $fournisseurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($fournisseurs);
            exit;
        }

        // Si on demande les articles
        if (isset($_GET['articles'])) {
            $stmt = $pdo->query("SELECT reference, designation FROM Article");
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($articles);
            exit;
        }

        // Par défaut, retourne une erreur
        echo json_encode([
            'success' => false,
            'message' => 'Paramètre GET invalide.'
        ]);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lire les données JSON
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['articles']) || !is_array($data['articles']) || empty($data['articles'])) {
            throw new Exception("La liste des articles est vide ou invalide.");
        }

        $articles = $data['articles'];

        $premier_article = $articles[0];
        $id_fournisseur = $premier_article['id_fournisseur'] ?? null;
        $date_entree = $premier_article['date'] ?? null;

        if (empty($id_fournisseur) || empty($date_entree)) {
            throw new Exception("Le fournisseur ou la date d'entrée est manquant(e).");
        }

        // Créer l'entrée principale EntreeStock
        $stmt = $pdo->prepare("INSERT INTO EntreeStock (date_entree, id_fournisseur) VALUES (?, ?)");
        $stmt->execute([$date_entree, $id_fournisseur]);
        $id_entree = $pdo->lastInsertId();

        foreach ($articles as $article) {
            $reference = trim($article['reference']);
            $quantite = (int)$article['quantite'];

            // Vérifier si l'article existe
            $stmt = $pdo->prepare("SELECT id_article FROM Article WHERE reference = ?");
            $stmt->execute([$reference]);
            $id_article = $stmt->fetchColumn();

            // Insérer dans LigneEntreeStock
            $stmt = $pdo->prepare("
                INSERT INTO LigneEntreeStock (id_entree, id_article, quantite)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([$id_entree, $id_article, $quantite]);
        }

        echo json_encode([
            'success' => true,
            'message' => 'Tous les articles ont été ajoutés avec succès.'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => "Erreur : " . $e->getMessage()
    ]);
}
