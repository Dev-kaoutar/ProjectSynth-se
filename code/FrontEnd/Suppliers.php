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
          <th>Email</th>
          <th>Téléphone</th>
          <th>Adresse</th>
          <th>pays</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Exemple -->
        <tr>
          <td>Benali Ahmed</td>
          <td>TechPlus</td>
          <td>ahmed@techplus.com</td>
          <td>0600000000</td>
          <td>123 Rue Casablanca</td>
          <td>Maroc</td>
          <td>
            <!-- <a href="modifierSortie.php?ref=REF123" class="edit"><i class="fa-solid fa-pen-to-square"></i></a> -->
            <a href="InfoFornisseur.php" class="view"><i class="fa-solid fa-eye"></i></a>
            <a href="supprimerSortie.php?ref=REF123" class="delete"><i class="fa-solid fa-trash-can"></i></a>
          </td>


        </tr>
      </tbody>
    </table>
  </div>

</body>

</html>