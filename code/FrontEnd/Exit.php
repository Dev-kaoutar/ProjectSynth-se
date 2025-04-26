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
        <!-- Exemple -->
        <tr>
          <td>1</td>
          <td>Article A, Article B, Article C
          </td>
          <td>12</td>
          <td>Client X</td>
          <td>2025-04-09</td>
          <td>
            <!-- <a href="modifierSortie.php?ref=REF123" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>
            <a href="supprimerSortie.php?ref=REF123" class="delete"><i class="fa-solid fa-trash-can"></i></a> -->
            <a href="InfoSortie.php" class="view"><i class="fa-solid fa-eye"></i></a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>
            Article D, Article E
          </td>
          <td>10</td>
          <td>Client Y</td>
          <td>2025-04-10</td>
          <td>
            <!-- <a href="modifierSortie.php?ref=REF123" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>
            <a href="supprimerSortie.php?ref=REF123" class="delete"><i class="fa-solid fa-trash-can"></i></a> -->
            <a href="detailsSortie.php?ref=REF123" class="view"><i class="fa-solid fa-eye"></i></a>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>
            Article A
          </td>
          <td>5</td>
          <td>Client Z</td>
          <td>2025-04-11</td>
          <td>
            <a href="detailsSortie.php?ref=REF123" class="view"><i class="fa-solid fa-eye"></i></a>
            <!-- <a href="supprimerSortie.php?ref=REF123" class="delete"><i class="fa-solid fa-trash-can"></i></a> -->

          </td>
        </tr>
      </tbody>
    </table>
  </div>

</body>

</html>