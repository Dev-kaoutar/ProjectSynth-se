<?php
include '../BackEnd/DetailsSortie.php' ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Détails de la Sortie</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleInfoEntreeEtSortie.css">
</head>

<body>
  <?php include '../FrontEnd/Header.php'; ?>
  <div class="form-container">
    <h2><i class="fas fa-sign-out-alt"></i> Détails de la Sortie</h2>
    <form>
      <div class="">
        <div class="form-group">
          <label>ID de la sortie : <span><?= htmlspecialchars($sortie['id_sortie']) ?></span></label>
        </div>
        <div class="form-group">
          <label>Client : <span><?= htmlspecialchars($sortie['nom_client']) ?></span></label>
        </div>
        <div class="form-group">
          <label>Date de Sortie : <span><?= htmlspecialchars($sortie['date_sortie']) ?></span></label>
        </div>
      </div>

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
            $total = $article['quantite'] * $article['prix_vente'];
            $total_general += $total;
          ?>
            <tr>
              <td><?= htmlspecialchars($article['designation']) ?></td>
              <td><?= $article['quantite'] ?></td>
              <td><?= number_format($article['prix_vente'], 2) ?> DH</td>
              <td><?= number_format($total, 2) ?> DH</td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="3" style="text-align:right;"><strong>Total général</strong></td>
            <td><strong><?= number_format($total_general, 2) ?> DH</strong></td>
          </tr>
        </tbody>
      </table>

      <div class="button-row">
        <button type="button" onclick="window.location.href='Exit.php'"><i class="fas fa-arrow-left"></i> Retour</button>
      </div>
    </form>
  </div>
</body>

</html>