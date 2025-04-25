<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/code/css/styleListes.css">
  <!-- <link rel="stylesheet" href="/CSS/styleHeader.css"> -->
  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet" />
</head>

<body>
  <?php include 'header.php' ?>
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
        <!-- Exemple -->
        <tr>
          <td>El Amrani Sara</td>
          <td>sara@client.com</td>
          <td>0611111111</td>
          <td>456 Rue Rabat</td>
          <td>Rabat</td>
          <td>
            <!-- <a href="modifierSortie.php?ref=REF123" class="edit"><i class="fa-solid fa-pen-to-square"></i></a> -->
            <a href="detailsSortie.php?ref=REF123" class="view"><i class="fa-solid fa-eye"></i></a>
            <a href="supprimerSortie.php?ref=REF123" class="delete"><i class="fa-solid fa-trash-can"></i></a>

          </td>
        </tr>
      </tbody>
    </table>
  </div>

</body>

</html>