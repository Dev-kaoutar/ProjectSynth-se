<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styleInfoFornisseur.css">
</head>

<body>
    <?php include '../FrontEnd/Header.php'; ?>
    <div class="form-container">
        <h3>📦 Entrées du Fournisseur</h3>
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
                <tr>
                    <td rowspan="2">24/04/2025</td>
                    <td>Ordinateur Portable</td>
                    <td>15</td>
                    <td>7500 DH</td>
                </tr>
                <tr>
                    <td>Clavier mécanique</td>
                    <td>10</td>
                    <td>350 DH</td>
                </tr>
                <tr>
                    <td>25/04/2025</td>
                    <td>Souris sans fil</td>
                    <td>30</td>
                    <td>120 DH</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>