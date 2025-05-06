<?php 
include '../DB/Config.php';

// Initialisation des messages
$message = '';
$typeMessage = '';

// Traitement des erreurs
try {
    // Connexion et requête sécurisée
    $sql = "SELECT * FROM Client";
    $stmt = $pdo->query($sql);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Erreur lors du chargement des clients : " . htmlspecialchars($e->getMessage());
    $typeMessage = 'error';
    $clients = [];
}

// Message de suppression
if (isset($_GET['deleted']) && $_GET['deleted'] == 'success') {
    $message = "Le client a été supprimé avec succès.";
    $typeMessage = 'success';
} elseif (isset($_GET['deleted']) && $_GET['deleted'] == 'fail') {
    $message = "Erreur lors de la suppression du client.";
    $typeMessage = 'error';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Clients</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/styleListes.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <style>
    .message.success { color: green; padding: 10px; }
    .message.error { color: red; padding: 10px; }
  </style>
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
        <?php if (!empty($clients)) : ?>
          <?php foreach ($clients as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['nom_client']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['telephone']) ?></td>
              <td><?= htmlspecialchars($row['adresse']) ?></td>
              <td><?= htmlspecialchars($row['ville']) ?></td>
              <td>
                <a href="InfoClient.php?id=<?= $row['id_client'] ?>" class="view"><i class="fa-solid fa-eye"></i></a>
                <a href="SortiesParClient.php?id=<?= $row['id_client'] ?>" class="history"><i class="fa-solid fa-history"></i></a>
                <a href="../BackEnd/supprimerClient.php?id=<?= $row['id_client'] ?>" class="delete" onclick="return confirm('Voulez-vous vraiment supprimer ce client ?')"><i class="fa-solid fa-trash-can"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr><td colspan="6">Aucun client trouvé.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

</html>
