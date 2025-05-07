<?php
include '../DB/Config.php';
include '../BackEnd/supprimerFournisseur.php'; // Include the backend logic for deleting a supplier
include '../BackEnd/BEntreeParFournisseur.php';

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
      <a href="ajouterFournisseur.php" class="add-user"><i class="fas fa-user-plus"></i></a>
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
        $sql = "SELECT * FROM Fournisseur";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['nom_fournisseur']) . "</td>";
          echo "<td>" . htmlspecialchars($row['raison_social']) . "</td>";
          echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
          echo "<td>" . htmlspecialchars($row['email']) . "</td>";
          echo "<td>" . htmlspecialchars($row['adresse']) . "</td>";
          echo "<td>" . htmlspecialchars($row['ville']) . "</td>"; // Added ville column
          echo "<td>
                <a href='InfoFornisseur.php?id=" . $row['id_fournisseur'] . "' class='view'><i class='fa-solid fa-eye'></i></a>
                <a href='EntréesParFournisseur.php?id=" . $row['id_fournisseur'] . "' class='history'><i class='fa-solid fa-history'></i></a>
                <a href='../BackEnd/supprimerFournisseur.php?id=" . $row['id_fournisseur'] . "' class='delete' onclick='return confirm(\"Voulez-vous vraiment supprimer ce fournisseur ?\")'><i class='fa-solid fa-trash-can'></i></a>
              </td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>

</html>