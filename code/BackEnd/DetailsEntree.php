<?php
require_once '../DB/Config.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idEntree = $_GET['id'];

    // Détails de l'entrée
    $stmt = $pdo->prepare("SELECT es.id_entree, es.date_entree, f.nom_fournisseur
                           FROM EntreeStock es
                           JOIN Fournisseur f ON es.id_fournisseur = f.id_fournisseur
                           WHERE es.id_entree = ?");
    $stmt->execute([$idEntree]);
    $entree = $stmt->fetch();

    // Articles de cette entrée
    $stmtArticles = $pdo->prepare("SELECT a.designation, les.quantite, a.prix_achat
                                   FROM LigneEntreeStock les
                                   JOIN Article a ON les.id_article = a.id_article
                                   WHERE les.id_entree = ?");
    $stmtArticles->execute([$idEntree]);
    $articles = $stmtArticles->fetchAll();
} else {
    die("ID d'entrée invalide.");
}
