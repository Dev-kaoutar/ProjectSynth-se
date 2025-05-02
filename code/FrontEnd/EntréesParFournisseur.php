<?php
include '../DB/config.php'; // هاد الملف فيه الاتصال بقاعدة البيانات
include '../BackEnd/BEntreeParFournisseur.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styleInfoRH.css">
</head>

<body>
    <?php include '../FrontEnd/Header.php'; ?>
    <div class="form-container">
        <h3><i class="fas fa-truck"></i>Entrées du Fournisseur</h3>
        <table class="produits-table">
            <thead>
                <tr>
                    <th>Date d'entrée</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix d'achat unitaire (DH)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donnees as $date => $articles): ?>
                    <?php foreach ($articles as $index => $article): ?>
                        <tr>
                            <?php if ($index === 0): ?>
                                <td rowspan="<?= count($articles) ?>"><?= htmlspecialchars($date) ?></td>
                            <?php endif; ?>
                            <td><?= htmlspecialchars($article['produit']) ?></td>
                            <td><?= htmlspecialchars($article['quantite']) ?></td>
                            <td><?= htmlspecialchars($article['prix_achat']) ?> DH</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>