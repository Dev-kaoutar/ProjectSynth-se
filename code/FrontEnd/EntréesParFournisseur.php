<?php
include '../DB/config.php'; 
include '../BackEnd/BEntreeParFournisseur.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Entrées du Fournisseur</title>
    <link rel="stylesheet" href="../css/styleInfoRH.css">
    <link rel="stylesheet" href="../css/styleListes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include '../FrontEnd/Header.php'; ?>
    <div class="form-container">
        <a href="../FrontEnd/Suppliers.php"><i class="fas fa-arrow-left" style="color: #1793d5;"></i></a>
        <h3><i class="fas fa-truck"></i> Entrées du Fournisseur</h3>
        <table class="produits-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total Produits</th>
                    <th>Total Prix (DH)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($donnees)): ?>
                    <?php foreach ($donnees as $id_entree => $info): 
                        $articles = $info['articles'];
                        $date = $info['date'];
                        $totalProduits = count($articles);
                        $totalPrix = array_sum(array_column($articles, 'prix_achat'));
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($date) ?></td>
                            <td><?= $totalProduits ?></td>
                            <td><?= number_format($totalPrix, 2) ?> DH</td>
                            <td>
                                <a href="DetailsEntree.php?id=<?= $id_entree ?>" class="view">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="text-align: center;">Aucune entrée disponible</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
