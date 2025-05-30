<?php
require_once '../DB/Config.php';
if (!isset($_GET['articles'])) {
  header('Location: ../FrontEnd/AjouterSortie.php');
  exit();
}
$articlesFacturation = json_decode($_GET['articles'], true);
if (!is_array($articlesFacturation)) {
  header('Location: ../FrontEnd/AjouterSortie.php');
  exit();
}

$dernierNumero = $pdo->query("SELECT MAX(id_facture) AS max_id FROM Facture")->fetch(PDO::FETCH_ASSOC)['max_id'] ?? 0;
$nouveauNumero =  str_pad($dernierNumero + 1, 3, '0', STR_PAD_LEFT) . "/" . date('Y');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Facture Professionnelle</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <link rel="stylesheet" href="../CSS/styleFinances.css">
</head>

<body>
  <?php include '../FrontEnd/Header.php'; ?>

  <div class="formulaire">
    <h1>Génération de Facture</h1>
    <div id="message" style="text-align: center; margin-bottom: 10px;"></div>

    <select id="selectPaiement" onchange="changerModePaiement()">
      <option value="Virement bancaire">Virement bancaire</option>
      <option value="Espèces">Espèces</option>
      <option value="Chèque">Chèque</option>
    </select>
    <button class="btn" onclick="exporterPDF()"><i class="fas fa-file-pdf"></i> Exporter PDF</button>
    <button class="btn" onclick="enregistrerFacture()"><i class="fas fa-save"></i> Enregistrer dans la base</button>
  </div>

  <div class="facture" id="facture">
    <p class="logos"><img src="../pics/logo.png" alt="Logo"></p>
    <h2><i class="fas fa-file-invoice-dollar"></i> Facture <span id="numFacture"><?= $nouveauNumero ?></span></h2>
    <p><strong>Client :</strong> <span id="nomClient"><?= htmlspecialchars($articlesFacturation[0]['destinataire']) ?></span></p>
    <input type="hidden" id="client" value="<?= htmlspecialchars($articlesFacturation[0]['id_client']) ?>" />
    <p><strong>Date :</strong> <span id="dateFacture"><?= htmlspecialchars($articlesFacturation[0]['date_sortie']) ?></span></p>
    <table>
      <thead>
        <tr>
          <th>Réf</th>
          <th>Article</th>
          <th>Qté</th>
          <th>PU (DH)</th>
          <th>Total (DH)</th>
        </tr>
      </thead>
      <tbody id="corpsFacture">
        <?php foreach ($articlesFacturation as $article): ?>
          <?php
          $stmt = $pdo->query("SELECT reference, designation, prix_vente FROM Article WHERE id_article = " . intval($article['id_article']))->fetch(PDO::FETCH_ASSOC);
          ?>
          <tr>
            <td><?= htmlspecialchars($stmt['reference']) ?></td>
            <td><?= htmlspecialchars($stmt['designation']) ?></td>
            <td><?= htmlspecialchars($article['quantite']) ?></td>
            <td><?= htmlspecialchars($stmt['prix_vente']) ?> DH</td>
            <td><?= htmlspecialchars($article['quantite'] * $stmt['prix_vente']) ?> DH</td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <h3>Total HT : <span id="totalHT">0.00 DH</span></h3>
    <h3>TVA (20%) : <span id="tva">0.00 DH</span></h3>
    <h3>Total TTC : <span id="totalTTC">0.00 DH</span></h3>
    <p><strong>Méthode de paiement :</strong> <span id="modePaiementFacture">Virement bancaire</span></p>
    <canvas id="qr" width="100" height="100"></canvas>
    <p class="footer">Merci pour votre confiance. Facture générée automatiquement.</p>
  </div>
  <script src="../JS/messageError&success.js"></script>
  <script src="../JS/enregistrerFacture.js"></script>
</body>

</html>