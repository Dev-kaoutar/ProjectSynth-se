<?php
include '../DB/Config.php';
include '../BackEnd/BSortieParClient.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Sorties des Clients</title>
    <link rel="stylesheet" href="../css/styleInfoRH.css">
</head>

<body>
    <?php include '../FrontEnd/Header.php'; ?>
    <div class="form-container">
        <a href="../FrontEnd/Clients.php"><i class="fas fa-arrow-left" style="color: #1793d5;"></i></a>
        <h3><i class="fas fa-box"></i> Sortie du Client</h3>
        <table class="produits-table">
            <thead>
                <tr>
                    <th>Date de sortie</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix de vente unitaire (DH)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $prevDate = '';
                foreach ($sorties as $row) {
                    echo "<tr>";
                    if ($row['date_sortie'] != $prevDate) {
                        echo "<td>" . htmlspecialchars($row['date_sortie']) . "</td>";
                        $prevDate = $row['date_sortie'];
                    } else {
                        echo "<td></td>";
                    }

                    echo "<td>" . htmlspecialchars($row['designation']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['quantite']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['prix_vente']) . " DH</td>";
                    echo "</tr>";
                }
                if (empty($sorties)) {
                    echo "<tr><td colspan='4' style='text-align: center;'>Aucune sortie disponible</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>