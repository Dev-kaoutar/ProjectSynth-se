<?php
include '../DB/Config.php';
include '../BackEnd/DetailesFournisseur.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Modifier le Fournisseur</title>
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
    <a href="../FrontEnd/Suppliers.php"><i class="fas fa-arrow-left" style="color: #1793d5;"></i> </a>
    <h2><i class="fas fa-pencil-alt"></i> Modifier les Informations du Fournisseur</h2>
    <form id="fournisseurForm" method="POST">
      <div class="form-grid">
        <div class="form-group">
          <label>ID du Fournisseur</label>
          <input type="text" name="id_fournisseur" value="<?= $fournisseur['id_fournisseur']; ?>" readonly />
        </div>
        <div class="form-group">
          <label>Nom du Fournisseur</label>
          <input type="text" name="nom_fournisseur" value="<?= $fournisseur['nom_fournisseur']; ?>" />
        </div>
        <div class="form-group">
          <label>Raison Sociale</label>
          <input type="text" name="raison_social" value="<?= $fournisseur['raison_social']; ?>" />
        </div>
        <div class="form-group">
          <label>Téléphone</label>
          <input type="tel" name="telephone" value="<?= $fournisseur['telephone']; ?>" />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" value="<?= $fournisseur['email']; ?>" />
        </div>
        <div class="form-group full-width">
          <label>Adresse</label>
          <textarea name="adresse" rows="3"><?= $fournisseur['adresse']; ?></textarea>
        </div>
        <div class="form-group">
          <label>Ville</label>
          <input type="text" name="ville" value="<?= $fournisseur['ville']; ?>" />
        </div>
        <div class="form-group">
          <label>Date d'Ajout</label>
          <input type="date" name="date_inscription" value="<?= $fournisseur['date_inscription']; ?>" readonly />
        </div>

      </div>

      <div class="button-row">
        <button type="submit"><i class="fas fa-save"></i> Enregistrer</button>
      </div>
    </form>
  </div>

</body>

</html>