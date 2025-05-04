<?php
include '../DB/Config.php'; // Include the database connection file
try {
    $sql = "
        SELECT 
            s.date_sortie,
            a.designation,
            ls.quantite,
            a.prix_vente
        FROM SortieStock s
        JOIN LigneSortieStock ls ON s.id_sortie = ls.id_sortie
        JOIN Article a ON ls.id_article = a.id_article
        ORDER BY s.date_sortie ASC
    ";

    $stmt = $pdo->query($sql);
    $sorties = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération : " . $e->getMessage());
}
?>
