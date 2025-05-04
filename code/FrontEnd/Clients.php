<?php 
include '../DB/Config.php';
include '../BackEnd/supprimerClient.php'; // Include the backend logic for deleting a client 
include '../BackEnd/BSortieParClient.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Clients</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/styleListes.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>

<body>
  <?php include 'header.php'; ?>
  <div class="list-container">
    <div class="one-line">
      <h2>Liste des Clients</h2>
      <a href="ajouterClient.php" class="add-user"><i class="fas fa-user-plus"></i></a>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nom de client</th>
          <th>Email</th>
          <th>Téléphone</th>
          <th>Adresse</th>
          <th>Ville</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM Client";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nom_client']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['adresse']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ville']) . "</td>"; // Added ville column
            echo "<td>
                <a href='InfoClient.php?id=" . $row['id_client'] . "' class='view'><i class='fa-solid fa-eye'></i></a>
                <a href='SortiesParClient.php?id=" . $row['id_client'] . "' class='history'><i class='fa-solid fa-history'></i></a>
                <a href='../BackEnd/supprimerClient.php?id=" . $row['id_client'] . "' class='delete' onclick='return confirm(\"Voulez-vous vraiment supprimer ce client ?\")'><i class='fa-solid fa-trash-can'></i></a>
              </td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>
