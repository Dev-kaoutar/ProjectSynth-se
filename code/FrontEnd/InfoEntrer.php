<?php
// infoEntrer.php
require_once '../DB/Config.php';
include '../BackEnd/DetailsEntree.php';
?>
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
    <h2><i class="fas fa-info-circle"></i> Détails de l'Entrée</h2>
    <form id="entryForm">
      <div class="form-grid">
        <div class="form-group">
          <label>ID de l'entrée</label>
          <input type="text" value="<?= htmlspecialchars($entree['id_entree']) ?>" readonly />
        </div>
        <div class="form-group">
          <label>Fournisseur</label>
          <input type="text" value="<?= htmlspecialchars($entree['nom_fournisseur']) ?>" readonly />
        </div>
        <div class="form-group">
          <label>Date d'Entrée</label>
          <input type="date" value="<?= htmlspecialchars($entree['date_entree']) ?>" readonly />
        </div>
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
          <?php
          $total_general = 0;
          foreach ($articles as $article):
            $total = $article['quantite'] * $article['prix_achat'];
            $total_general += $total;
          ?>
            <tr>
              <td><?= htmlspecialchars($article['designation']) ?></td>
              <td><input type="number" value="<?= $article['quantite'] ?>" readonly /></td>
              <td><?= number_format($article['prix_achat'], 2) ?> DH</td>
              <td><?= number_format($total, 2) ?> DH</td>
            </tr>
          <?php endforeach; ?>
          <!-- ligne du total général -->
          <tr style="padding: 10px;">
            <td colspan="3" style="text-align: right; padding: 10px;"><strong>Total général</strong></td>
            <td><strong><?= number_format($total_general, 2) ?> DH</strong></td>
          </tr>
        </tbody>
      </table>

      <div class="button-row">
        <button type="button" onclick="window.location.href='Entry.php'"><i class="fas fa-arrow-left"></i> Retour</button>
      </div>
    </form>
  </div>
</body>

</html>