<?php
include '../DB/Config.php'; // Include the database configuration file
include '../BackEnd/BAjouterFournisseur.php'; // Include the backend logic for adding a supplier
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/AjouterSuccess.css">
  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet" />
</head>

<body>
  <?php include 'header.php' ?>
  <div class="form-container">
  <?php if (!empty($message)): ?>
      <div class="message-box"><?= $message ?></div>
      <?php endif; ?>
    <?php if (!empty($messageE)): ?>
      <div class="message-box-Error"><?= $messageE ?></div>
    <?php endif; ?>
    <br>
    <a href="../FrontEnd/Suppliers.php"><i class="fas fa-arrow-left" style="color: #1793d5;"></i></a>
    <h2>Ajouter un Fournisseur</h2>
    <form action="AjouterFournisseur.php" method="POST">
      <div class="form-grid">

        <div class="input-group input-group-full">
          <i class="fas fa-user"></i>
          <input type="text" name="nom" placeholder="Nom complet" required>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-building"></i>
          <input type="text" name="raison_sociale" placeholder="Raison sociale">
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-phone"></i>
          <input type="tel" name="telephone" placeholder="Téléphone" required>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-map-marker-alt"></i>
          <input type="text" name="adresse" placeholder="Adresse" required>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-city"></i>
          <input type="text" name="ville" placeholder="Ville" required>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-calendar-alt"></i>
          <input type="Date" name="date_inscription" placeholder="Date d'inscription" value="<?= date('Y-m-d'); ?>" readonly>
        </div>
      </div>
      <button type="submit" class="button">Ajouter le Fournisseur</button>
    </form>
  </div>

</body>

</html>