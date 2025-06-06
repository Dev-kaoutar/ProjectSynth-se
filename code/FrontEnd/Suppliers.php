<?php
include '../DB/Config.php';
include '../BackEnd/supprimerFournisseur.php'; // Include the backend logic for deleting a supplier
include '../BackEnd/BEntreeParFournisseur.php';

$limit = 25;

// Déterminer la page actuelle à partir de l'URL (par défaut à 1)
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculer l'offset
$offset = ($page - 1) * $limit;

// Compter le nombre total d'articles
$totalQuery = $pdo->query("SELECT COUNT(*) FROM Fournisseur");
$totalArticles = $totalQuery->fetchColumn();
$totalPages = ceil($totalArticles / $limit);

$sql = "SELECT * FROM Fournisseur WHERE actif = 1 ORDER BY id_fournisseur LIMIT $limit OFFSET $offset"; // Fetch only active suppliers
$stmt = $pdo->prepare($sql);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../CSS/styleListes.css">
</head>

<body>
  <?php include 'header.php' ?>
  <div class="list-container">
    <div class="one-line">
      <h2>Liste des Fournisseurs</h2>
      <div class="one-line">
        <div class="search-container">
          <input type="text" class="search-bar" placeholder="🔍︎ Rechercher..." onkeyup="search()">
        </div>
        <a href="ajouterFournisseur.php" class="add-user"><i class="fas fa-user-plus"></i></a>
      </div>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nom de fournisseur</th>
          <th>Raison Sociale</th>
          <th>Téléphone</th>
          <th>Email</th>
          <th>Adresse</th>
          <th>ville</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($stmt->rowCount() > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nom_fournisseur']) . "</td>";
            echo "<td>" . htmlspecialchars($row['raison_social']) . "</td>";
            echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['adresse']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ville']) . "</td>"; // Added ville column
            echo "<td>
                  <a href='EntréesParFournisseur.php?id=" . $row['id_fournisseur'] . "' class='history'><i class='fa-solid fa-history'></i></a>
                  <a href='InfoFornisseur.php?id=" . $row['id_fournisseur'] . "' class='edit'><i class='fas fa-edit'></i></a>
                  <a href='../BackEnd/supprimerFournisseur.php?id=" . $row['id_fournisseur'] . "' class='delete' onclick='return confirm(\"Voulez-vous vraiment supprimer ce fournisseur ?\")'><i class='fa-solid fa-trash-can'></i></a>
                </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='7'>Aucun fournisseur trouvé.</td></tr>";
        }
        ?>

      </tbody>
    </table>
    <!-- Pagination -->
    <?php include '../FrontEnd/Pagination.php'; ?>
  </div>
  <script src="../JS/Search.js"></script>
</body>

</html>