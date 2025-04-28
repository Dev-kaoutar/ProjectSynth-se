<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Modifier le Client</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleInfoFornisseur.css">
</head>

<body>
  <?php include '../FrontEnd/Header.php'; ?>
  <div class="form-container">
    <h2>📝 Modifier les Informations du Client</h2>
    <form id="clientForm" onsubmit="event.preventDefault(); alert('Modifications enregistrées ✅');">
      <div class="form-grid">
        <div class="form-group">
          <label>ID du client</label>
          <input type="text" value="12345" readonly />
        </div>
        <div class="form-group">
          <label>Nom du Client</label>
          <input type="text" value="Jean Dupont" />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" value="jean.dupont@example.com" />
        </div>
        <div class="form-group">
          <label>Téléphone</label>
          <input type="tel" value="0123456789" />
        </div>
        <div class="form-group full-width">
          <label>Adresse</label>
          <textarea rows="3">123 Rue Exemple, 75001 Paris</textarea>
        </div>
        <div class="form-group">
          <label>Ville</label>
          <input type="text" value="Paris" />
        </div>
        <div class="form-group">
          <label>Date d'Inscription</label>
          <input type="date" value="2020-05-15" readonly />
        </div>
      </div>

      <div class="button-row">
        <button type="submit">💾 Enregistrer</button>
      </div>
    </form>
  </div>
</body>

</html>