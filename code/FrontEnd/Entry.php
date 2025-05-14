<?php
require_once '../DB/Config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../CSS/styleListes.css">
    <!-- <link rel="stylesheet" href="/CSS/styleHeader.css"> -->
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet" />
</head>

<body>
    <?php include 'header.php' ?>

    <div class="list-container">
        <div class="one-line">
            <h3>Liste des Entrées d'Articles</h3>
            <a href="ajouterEntree.php" class="add"><i class="fas fa-plus-circle add-icon"></i></a>
        </div>
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="🔍︎ Rechercher..." onkeyup="search()">
            <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID d'entrée</th>
                    <th>Articles Entrés</th>
                    <th>Quantité Entrée</th>
                    <th>Fournisseur</th>
                    <th>Date d'Entrée</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php include '../BackEnd/ListeEntrees.php'; ?>                
            </tbody>
        </table>
    </div>
    <script src="../JS/Search.js"></script>
</body>

</html>