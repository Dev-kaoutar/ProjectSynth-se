<?php
include '../DB/Config.php';
include '../BackEnd/DetailesClient.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Modifier le Client</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleInfoRH.css">
  <link rel="stylesheet" href="../css/AjouterSuccess.css">
</head>

<body>
  <?php include '../FrontEnd/Header.php'; ?>
  <div class="form-container">
    <?php if (!empty($message)): ?>
      <div class="message-box"><?= $message ?></div>
    <?php endif; ?>
    <br>
    <h2><i class="fas fa-pencil-alt"></i> Modifier les Informations du Client</h2>
    <form id="clientForm" method="POST">
      <div class="form-grid">
        <div class="form-group">
          <label>ID du client</label>
          <input type="text" name="id_client" value="<?= $client['id_client']; ?>" readonly />
        </div>
        <div class="form-group">
          <label>Nom du Client</label>
          <input type="text" name="nom_client" value="<?= $client['nom_client']; ?>" />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" value="<?= $client['email']; ?>" />
        </div>
        <div class="form-group">
          <label>Téléphone</label>
          <input type="tel" name="telephone" value="<?= $client['telephone']; ?>" />
        </div>
        <div class="form-group full-width">
          <label>Adresse</label>
          <textarea rows="3" name="adresse"><?= $client['adresse']; ?></textarea>
        </div>
        <div class="form-group">
          <label>Ville</label>
          <input type="text" name="ville" value="<?= $client['ville']; ?>" />
        </div>
        <div class="form-group">
          <label>Date d'Inscription</label>
          <input type="date" name="date_inscription" value="<?= date('Y-m-d'); ?>" readonly />
        </div>
      </div>

      <div class="button-row">
        <button type="submit"><i class="fas fa-save"></i> Enregistrer</button>
      </div>
    </form>
  </div>
</body>

</html>