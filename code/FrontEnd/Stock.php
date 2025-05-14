<?php
require '../DB/config.php'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Stock</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="../css/StyleListes.css" />
</head>
<body>
<?php include '../FrontEnd/Header.php'; ?>
    <div class="list-container">
        <div class="one-line">
        <h2>Liste de Stock</h2>
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="🔍︎ Rechercher..." onkeyup="search()">
        </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Référence</th>
                    <th>Désignation</th>
                    <th>Marque</th>
                    <th>Catégorie</th>
                    <th>Quantité</th>
                    <th>Prix Achat</th>
                    <th>Prix Vente</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                $sql = "SELECT * FROM Article";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['id_article']}</td>
                        <td>{$row['reference']}</td>
                        <td>{$row['designation']}</td>
                        <td>{$row['marque']}</td>
                        <td>{$row['categorie']}</td>
                        <td>{$row['quantite_stock']}</td>
                        <td>{$row['prix_achat']} DH</td>
                        <td>{$row['prix_vente']} DH</td>
                        <td>{$row['description']}</td> 
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../JS/Search.js"></script>
</body>
</html>
