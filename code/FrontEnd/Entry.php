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
            <h2>Liste des Entrées d'Articles</h2>
            <a href="ajouterEntree.php" class="add"><i class="fas fa-plus-circle add-icon"></i></a>
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
                <!-- Exemple -->
                <tr>
                    <td>1</td>
                    <td>Article A, Article B, Article C</td>
                    <td>20</td>
                    <td>Fournisseur X</td>
                    <td>2025-04-09</td>
                    <td>
                        <a href="InfoEntrer.php" class="view"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Article D, Article E</td>
                    <td>15</td>
                    <td>Fournisseur Y</td>
                    <td>2025-04-10</td>
                    <td>
                        <a href="detailsEntree.php?ref=REF124" class="view"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Article F</td>
                    <td>8</td>
                    <td>Fournisseur Z</td>
                    <td>2025-04-11</td>
                    <td>
                        <a href="detailsEntree.php?ref=REF125" class="view"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>