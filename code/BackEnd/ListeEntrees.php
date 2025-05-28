<?php
require_once '../DB/Config.php';

// Paramètres de pagination
$limit = 25; // Nombre d'enregistrements par page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Compter le total d’entrées
$countSql = "SELECT COUNT(DISTINCT es.id_entree) AS total FROM EntreeStock es";
$totalStmt = $pdo->query($countSql);
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $limit);

// Requête principale avec pagination
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
        LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$entrees = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($entrees) {
    foreach ($entrees as $entree) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($entree['id_entree']) . "</td>";
        echo "<td>" . htmlspecialchars($entree['nom_fournisseur']) . "</td>";
        echo "<td>" . htmlspecialchars($entree['date_entree']) . "</td>";
        echo "<td><a href='../FrontEnd/infoEntrer.php?id=" . $entree['id_entree'] . "' class='view'><i class='fa-solid fa-eye'></i></a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Aucune entrée trouvée.</td></tr>";
}
