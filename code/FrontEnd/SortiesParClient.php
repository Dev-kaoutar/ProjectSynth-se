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
    <link rel="stylesheet" href="../css/styleListes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include '../FrontEnd/Header.php'; ?>
    <div class="form-container">
        <a href="../FrontEnd/Clients.php"><i class="fas fa-arrow-left" style="color: #1793d5;"></i></a>
        <h3><i class="fas fa-box"></i> Sorties du Client</h3>
        <table class="produits-table">
            <thead>
                <tr>
                    <th>Date de sortie</th>
                    <th>Total Produits</th>
                    <th>Total Prix (DH)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sorties)) : ?>
                    <?php foreach ($sorties as $sortie) : 
                        $id = $sortie['id_sortie'];
                        $date = $sortie['date_sortie'];
                        $total = 0;
                        $quantites = 0;

                        foreach ($sorties as $s) {
                            if ($s['id_sortie'] == $id) {
                                $quantites++;
                                $total += $s['prix_vente'] * $s['quantite'];
                            }
                        }
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($date) ?></td>
                            <td><?= $quantites ?></td>
                            <td><?= number_format($total, 2) ?> DH</td>
                            <td>
                                <a href="DetailsSortie.php?id=<?= $id ?>" class="view">
                                    <i class="fas fa-eye"></i> 
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Aucune sortie trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
