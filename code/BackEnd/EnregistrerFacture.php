<?php
require_once '../DB/Config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lire le JSON brut
    $data = json_decode(file_get_contents("php://input"), true);

    // Extraire les données
    $numero = $data['numero_facture'];
    $date = $data['date_facture'];
    $totalHT = $data['total_ht'];
    $tva = $data['tva'];
    $totalTTC = $data['total_ttc'];
    $modePaiement = $data['mode_paiement'];
    $id_client = $data['client'];
    $lignes = $data['lignes'];

    try {
        $check = $pdo->prepare("SELECT COUNT(*) FROM Facture WHERE numero_facture = ?");
        $check->execute([$numero]);
        if ($check->fetchColumn() > 0) {
            echo json_encode(["success" => false, "message" => "Numéro de facture déjà utilisé."]);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO Facture (numero_facture, date_facture, total_ht, tva, total_ttc, mode_paiement, id_client)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$numero, $date, $totalHT, $tva, $totalTTC, $modePaiement, $id_client]);
        $id_facture = $pdo->lastInsertId();

        foreach ($lignes as $ligne) {
            $ref = $ligne['ref'];
            $quantite = $ligne['qte'];
            $prixUnitaire = $ligne['prix'];
            $totalLigne = $ligne['total'];

            $stmtArticle = $pdo->prepare("SELECT id_article FROM Article WHERE reference = ?");
            $stmtArticle->execute([$ref]);
            $article = $stmtArticle->fetch();

            if (!$article) {
                echo json_encode(["success" => false, "message" => "Article avec la référence $ref introuvable."]);
                exit;
            }

            $id_article = $article['id_article'];

            $stmtLigne = $pdo->prepare("INSERT INTO LigneFacture (quantite, prix_unitaire, total_ligne, id_facture, id_article)
                                         VALUES (?, ?, ?, ?, ?)");
            $stmtLigne->execute([$quantite, $prixUnitaire, $totalLigne, $id_facture, $id_article]);
        }

        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Erreur : " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Requête non autorisée."]);
}
