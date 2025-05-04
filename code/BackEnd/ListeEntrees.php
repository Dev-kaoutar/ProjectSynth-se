<?php
require_once '../DB/Config.php';

// Requête pour récupérer les entrées d'articles avec leur fournisseur et les articles
$sql = "SELECT 
        es.id_entree,
        es.date_entree,
        f.nom_fournisseur,
        GROUP_CONCAT(a.designation SEPARATOR ', ') AS articles,
        SUM(les.quantite) AS quantite_totale
    FROM EntreeStock es
    INNER JOIN Fournisseur f ON es.id_fournisseur = f.id_fournisseur
    INNER JOIN LigneEntreeStock les ON es.id_entree = les.id_entree
    INNER JOIN Article a ON les.id_article = a.id_article
    GROUP BY es.id_entree, es.date_entree, f.nom_fournisseur
    ORDER BY es.date_entree DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$entrees = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($entrees) {
    foreach ($entrees as $entree) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($entree['id_entree']) . "</td>";
        echo "<td>" . htmlspecialchars($entree['articles']) . "</td>";
        echo "<td>" . htmlspecialchars($entree['quantite_totale']) . "</td>";
        echo "<td>" . htmlspecialchars($entree['nom_fournisseur']) . "</td>";
        echo "<td>" . htmlspecialchars($entree['date_entree']) . "</td>";
        echo "<td><a href='../FrontEnd/infoEntrer.php?id=" . $entree['id_entree'] . "' class='view'><i class='fa-solid fa-eye'></i></a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Aucune entrée trouvée.</td></tr>";
}
