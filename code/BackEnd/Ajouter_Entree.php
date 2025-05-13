<?php

// Connexion à la base de données
require_once '../DB/Config.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $stmt = $pdo->query("SELECT id_fournisseur, nom_fournisseur FROM fournisseur");
        $fournisseurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($fournisseurs);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lire les données JSON
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['articles']) || !is_array($data['articles']) || empty($data['articles'])) {
            throw new Exception("La liste des articles est vide ou invalide.");
        }

        $articles = $data['articles'];

        // Utiliser les données du premier article pour la création de l'entrée principale
        $premier_article = $articles[0];
        // $fournisseur_nom = trim($premier_article['fournisseur'] ?? '');
        $id_fournisseur = $premier_article['id_fournisseur'] ?? null;
        $date_entree = $premier_article['date'] ?? null;

        if (empty($id_fournisseur) || empty($date_entree)) {
            throw new Exception("Le fournisseur ou la date d'entrée est manquant(e).");
        }

        // Créer l'entrée principale EntreeStock
        $stmt = $pdo->prepare("INSERT INTO EntreeStock (date_entree, id_fournisseur) VALUES (?, ?)");
        $stmt->execute([$date_entree, $id_fournisseur]);
        $id_entree = $pdo->lastInsertId();

        // Définir le pourcentage de marge (ex. 20%)
        $marge_percent = 20;

        // Insérer les articles et les lignes d'entrée
        foreach ($articles as $article) {
            $reference = trim($article['reference']);
            $nom = trim($article['nom']);
            $marque = trim($article['marque']);
            $categorie = trim($article['categorie']);
            $quantite = (int)$article['quantite'];
            $prix_achat = (float)$article['prix'];
            $description = trim($article['description'] ?? '');

            // Vérifier si l'article existe déjà
            $stmt = $pdo->prepare("SELECT id_article FROM Article WHERE reference = ?");
            $stmt->execute([$reference]);
            $existing_article = $stmt->fetch();
            if ($existing_article) {
                // Mettre à jour uniquement la quantité de l'article existant
                $stmt = $pdo->prepare("UPDATE Article SET quantite_stock = quantite_stock + ? WHERE id_article = ?");
                $stmt->execute([$quantite, $existing_article['id_article']]);

                // Insérer la ligne d'entrée stock
                $stmt = $pdo->prepare("
                INSERT INTO LigneEntreeStock (id_entree, id_article, quantite)
                VALUES (?, ?, ?)
                ");
                $stmt->execute([$id_entree, $existing_article['id_article'], $quantite]);

                continue; // Passer à l'article suivant
            }

            // Calcul du prix de vente avec une marge
            $prix_vente = round($prix_achat * (1 + $marge_percent / 100), 2);

            // Insérer l'article
            $stmt = $pdo->prepare("
            INSERT INTO Article (reference, designation, marque, categorie, quantite_stock, description, prix_achat, prix_vente)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
            $stmt->execute([
                $reference,
                $nom,
                $marque,
                $categorie,
                $quantite,
                $description,
                $prix_achat,
                $prix_vente
            ]);
            $id_article = $pdo->lastInsertId();

            // Insérer la ligne d'entrée stock
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
    // http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => "Erreur : " . $e->getMessage()
    ]);
}
