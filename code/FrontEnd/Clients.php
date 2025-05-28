<?php 
include '../DB/Config.php';

// Initialisation des messages
$message = '';
$typeMessage = '';

// Traitement des erreurs
try {
    $limit = 25;

  // Déterminer la page actuelle à partir de l'URL (par défaut à 1)
  $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

  // Calculer l'offset
  $offset = ($page - 1) * $limit;

  // Compter le nombre total d'articles
  $totalQuery = $pdo->query("SELECT COUNT(*) FROM Client");
  $totalArticles = $totalQuery->fetchColumn();
  $totalPages = ceil($totalArticles / $limit);

  $sql = "SELECT * FROM Client WHERE actif = 1 ORDER BY id_client LIMIT $limit OFFSET $offset"; // Fetch only active suppliers
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
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
      <div class="one-line">
          <div class="search-container">
              <input type="text" class="search-bar" placeholder="🔍︎ Rechercher..." onkeyup="search()">
          </div>
          <a href="ajouterClient.php" class="add-user"><i class="fas fa-user-plus"></i></a>
      </div>  
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
                <a href="SortiesParClient.php?id=<?= $row['id_client'] ?>" class="history"><i class="fa-solid fa-history"></i></a>
                <a href="InfoClient.php?id=<?= $row['id_client'] ?>" class="edit"><i class="fas fa-edit"></i></a>
                <a href="../BackEnd/supprimerClient.php?id=<?= $row['id_client'] ?>" class="delete" onclick="return confirm('Voulez-vous vraiment supprimer ce client ?')"><i class="fa-solid fa-trash-can"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr><td colspan="6">Aucun client trouvé.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
    <!-- Pagination -->
    <?php include '../FrontEnd/Pagination.php'; ?>
  </div>
  <script src="../JS/Search.js"></script>
</body>

</html>
