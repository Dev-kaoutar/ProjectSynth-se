// File: Stock.php
<?php
include 'Header.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion de Stock</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="../css/StockStyle.css" />

</head>

<body>
    <div class="container">
        <h1>Liste de Stock</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>Smartphone</td>
                    <td>50</td>
                    <td>3000.00 DH</td>
                    <td>Téléphone</td>
                    <td>

                        <button class="edit" onclick="window.location.href='ModifierArticle.php'"><i class="fas fa-edit"></i></button>
                        <button class="details" onclick="window.location.href='DetailleArticle.php'"><i class="fas fa-info-circle"></i></button>


                    </td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Ordinateur Portable</td>
                    <td>30</td>
                    <td>8000.00 DH</td>
                    <td>Ordinateur</td>
                    <td>

                        <button class="edit" onclick="window.location.href='ModifierArticle.php'"><i class="fas fa-edit"></i></button>
                        <button class="details" onclick="window.location.href='DetailleArticle.php'"><i class="fas fa-info-circle"></i></button>


                    </td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Casque Bluetooth</td>
                    <td>100</td>
                    <td>500.00 DH</td>
                    <td>Casque</td>
                    <td>

                        <button class="edit" onclick="window.location.href='ModifierArticle.php'"><i class="fas fa-edit" ></i></button>
                        <button class="details" onclick="window.location.href='DetailleArticle.php'"><i class="fas fa-info-circle"></i></button>


                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>