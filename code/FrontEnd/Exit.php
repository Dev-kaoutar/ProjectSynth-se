<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../CSS/styleListes.css">
</head>

<body>
  <?php include 'header.php' ?>

  <div class="list-container">
    <div class="one-line">
      <h2>Liste des Sorties d'Articles</h2>
      <a href="ajouterSortie.php" class="add"><i class="fas fa-plus-circle add-icon"></i></a>
    </div>
    <table>
      <thead>
        <tr>
          <th>ID de sortie</th>
          <th>Articles Sorties</th>
          <th>Quantité Sortie</th>
          <th>Destinataire</th>
          <th>Date de Sortie</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php include '../BackEnd/ListeSorties.php'; ?>
      </tbody>
    </table>
  </div>

</body>

</html>