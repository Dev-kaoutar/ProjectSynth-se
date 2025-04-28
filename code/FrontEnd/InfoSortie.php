<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Détails de la Sortie</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleInfoSortie.css">
</head>

<body>
  <?php include '../FrontEnd/Header.php'; ?>
  <div class="form-container">
    <h2>📝 Détails de la Sortie</h2>
    <form id="entryForm" onsubmit="event.preventDefault(); alert('Détails enregistrés ✅');">
      <div class="form-grid">
        <div class="form-group">
          <label>ID de Sortie</label>
          <input type="text" value="1" readonly />
        </div>
        <div class="form-group">
          <label>Destinataire</label>
          <input type="text" value="Destinataire X" />
        </div>
        <div class="form-group">
          <label>Date de Sortie</label>
          <input type="date" value="2025-04-09" readonly />
        </div>
      </div>

      <table>
        <thead>
          <tr>
            <th>Article</th>
            <th>Quantité Sortie</th>
            <th>Prix Unitaire</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Article A</td>
            <td><input type="number" value="10" readonly /></td>
            <td>20DH</td>
            <td>200DH</td>
          </tr>
          <tr>
            <td>Article B</td>
            <td><input type="number" value="5" readonly /></td>
            <td>15DH</td>
            <td>75DH</td>
          </tr>
          <tr>
            <td>Article C</td>
            <td><input type="number" value="3" readonly /></td>
            <td>10DH</td>
            <td>30DH</td>
          </tr>
        </tbody>
      </table>

      <div class="button-row">
        <button type="submit">💾 Enregistrer</button>
      </div>
    </form>
  </div>
</body>

</html>