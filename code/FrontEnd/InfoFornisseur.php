<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Modifier le Fournisseur</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleInfoFornisseur.css">
</head>

<body>
  <?php include '../FrontEnd/Header.php'; ?>
  <div class="form-container">
    <h2>📝 Modifier les Informations du Fournisseur</h2>
    <form id="fournisseurForm" onsubmit="event.preventDefault(); alert('Modifications enregistrées ✅');">
      <div class="form-grid">
        <div class="form-group">
          <label>ID du Fournisseur</label>
          <input type="text" value="98765" readonly />
        </div>
        <div class="form-group">
          <label>Nom du Fournisseur</label>
          <input type="text" value="Fournisseur XYZ" />
        </div>
        <div class="form-group">
          <label>Raison Sociale</label>
          <input type="text" value="XYZ S.A." />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" value="contact@xyzfournisseur.com" />
        </div>
        <div class="form-group">
          <label>Téléphone</label>
          <input type="tel" value="0987654321" />
        </div>
        <div class="form-group full-width">
          <label>Adresse</label>
          <textarea rows="3">456 Rue des Fournisseurs, 75001 Paris</textarea>
        </div>
        <div class="form-group">
          <label>Pays</label>
          <input type="text" value="France" />
        </div>
        <div class="form-group">
          <label>Date d'Ajout</label>
          <input type="date" value="2019-08-20" readonly />
        </div>
      </div>

      <div class="button-row">
        <button type="submit">💾 Enregistrer</button>
      </div>
    </form>
  </div>

</body>

</html>