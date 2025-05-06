<?php
require_once '../DB/Config.php'; // Inclure le fichier de configuration pour la connexion à la base de données
$sql = "SELECT 
        ss.id_sortie,
        ss.date_sortie,
        c.nom_client,
        GROUP_CONCAT(a.designation SEPARATOR ', ') AS articles,
        SUM(lss.quantite) AS quantite_totale
    FROM SortieStock ss
    INNER JOIN Client c ON ss.id_client = c.id_client
    INNER JOIN LigneSortieStock lss ON ss.id_sortie = lss.id_sortie
    INNER JOIN Article a ON lss.id_article = a.id_article
    GROUP BY ss.id_sortie, ss.date_sortie, c.nom_client
    ORDER BY ss.date_sortie DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$sorties = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($sorties) {
    foreach ($sorties as $sortie) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($sortie['id_sortie']) . "</td>";
        echo "<td>" . htmlspecialchars($sortie['articles']) . "</td>";
        echo "<td>" . htmlspecialchars($sortie['quantite_totale']) . "</td>";
        echo "<td>" . htmlspecialchars($sortie['nom_client']) . "</td>";
        echo "<td>" . htmlspecialchars($sortie['date_sortie']) . "</td>";
        echo "<td><a href='../FrontEnd/InfoSortie.php?id=" . $sortie['id_sortie'] . "' class='view'><i class='fa-solid fa-eye'></i></a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Aucune sortie trouvée.</td></tr>";
}
