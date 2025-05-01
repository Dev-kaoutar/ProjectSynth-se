<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Détails de l'Entrée</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleInfoEntreeEtSortie.css">
</head>

<body>
  <?php include '../FrontEnd/Header.php'; ?>
  <div class="form-container">
    <h2><i class="fas fa-file-alt"></i> Détails de l'Entrée</h2>
    <form id="entryForm" onsubmit="event.preventDefault(); alert('Détails enregistrés ✅');">
      <div class="form-grid">
        <div class="form-group">
          <label>ID de l'entrée</label>
          <input type="text" value="1" readonly />
        </div>
        <div class="form-group">
          <label>Fournisseur</label>
          <input type="text" value="Fournisseur X" />
        </div>
        <div class="form-group">
          <label>Date d'Entrée</label>
          <input type="date" value="2025-04-09" readonly />
        </div>
        <!-- <div class="form-group">
          <label>Mode de Paiement</label>
          <input type="text" value="Virement bancaire" />
        </div>
        <div class="form-group">
          <label>Référence Facture</label>
          <input type="text" value="FAC-0001" />
        </div> -->
      </div>

      <!-- Tableau pour afficher les articles, quantités, prix et totaux -->
      <table>
        <thead>
          <tr>
            <th>Article</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Article A</td>
            <td><input type="number" value="10" readonly /></td>
            <td>200DH</td>
            <td>2000DH</td>
          </tr>
          <tr>
            <td>Article B</td>
            <td><input type="number" value="5" readonly /></td>
            <td>150DH</td>
            <td>750DH</td>
          </tr>
          <tr>
            <td>Article C</td>
            <td><input type="number" value="5" readonly /></td>
            <td>100DH</td>
            <td>500DH</td>
          </tr>
        </tbody>
      </table>

      <div class="button-row">
        <button type="submit"><i class="fas fa-save"></i> Enregistrer</button>
      </div>
    </form>
  </div>
</body>

</html>