<?php
require_once '../DB/Config.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idSortie = $_GET['id'];

    // Infos de la sortie
    $stmt = $pdo->prepare("SELECT ss.id_sortie, ss.date_sortie, c.nom_client
                           FROM SortieStock ss
                           JOIN Client c ON ss.id_client = c.id_client
                           WHERE ss.id_sortie = ?");
    $stmt->execute([$idSortie]);
    $sortie = $stmt->fetch();

    // Lignes de sortie
    $stmtArticles = $pdo->prepare("SELECT a.designation, lss.quantite, a.prix_vente
                                   FROM LigneSortieStock lss
                                   JOIN Article a ON lss.id_article = a.id_article
                                   WHERE lss.id_sortie = ?");
    $stmtArticles->execute([$idSortie]);
    $articles = $stmtArticles->fetchAll();
} else {
    die("ID de sortie invalide.");
}
