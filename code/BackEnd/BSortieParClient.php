<?php
include '../DB/Config.php';

try {
    $sql = "
        SELECT 
            s.id_sortie,
            s.date_sortie,
            a.designation,
            ls.quantite,
            a.prix_vente
        FROM SortieStock s
        JOIN LigneSortieStock ls ON s.id_sortie = ls.id_sortie
        JOIN Article a ON ls.id_article = a.id_article
        ORDER BY s.id_sortie ASC
    ";

    $stmt = $pdo->query($sql);
    $sorties = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de récupération des sorties : " . $e->getMessage());
}
?>
