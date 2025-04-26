<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier le Fournisseur</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleInfoFornisseur.css">
</head>
<body>

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

  <div class="form-container">
      <h3>📦 Entrées du Fournisseur</h3>
      <table class="produits-table">
        <thead>
          <tr>
            <th>Date d'entrée</th>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix d'achat unitaire (MAD)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td rowspan="2">24/04/2025</td>
            <td>Ordinateur Portable</td>
            <td>15</td>
            <td>7500 MAD</td>
          </tr>
          <tr>
            <td>Clavier mécanique</td>
            <td>10</td>
            <td>350 MAD</td>
          </tr>
          <tr>
            <td>25/04/2025</td>
            <td>Souris sans fil</td>
            <td>30</td>
            <td>120 MAD</td>
          </tr>
        </tbody>
      </table>
  </div>

</body>
</html>
