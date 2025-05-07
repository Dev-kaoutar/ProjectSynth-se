<?php
require_once '../DB/Config.php';

// Récupération des articles
$articles = $pdo->query("SELECT reference, designation FROM Article")->fetchAll(PDO::FETCH_ASSOC);

// Récupération des clients
$clients = $pdo->query("SELECT id_client, nom_client FROM Client")->fetchAll(PDO::FETCH_ASSOC);
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
    <h2>Créer une facture</h2>
    <input type="text" id="numFactureInput" placeholder="Numéro de la facture">
    <input type="text" id="entreprise" placeholder="Nom de l'entreprise (TechStore SARL)">

    <select id="client">
      <option value="" disabled selected>Nom du client</option>
      <?php foreach ($clients as $client): ?>
        <option value="<?= htmlspecialchars($client['id_client']) ?>">
          <?= htmlspecialchars($client['nom_client']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <select id="article">
      <option value="" disabled selected>désignation de l'article</option>
      <?php foreach ($articles as $article): ?>
        <option value="<?= htmlspecialchars($article['reference']) ?>">
          <?= htmlspecialchars($article['designation']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <input type="number" id="quantite" placeholder="Quantité" min="1">
    <input type="number" id="prix" placeholder="Prix unitaire (DH)" min="0">
    <select id="modePaiement">
      <option value="Virement bancaire">Virement bancaire</option>
      <option value="Chèque">Chèque</option>
      <option value="Espèces">Espèces</option>
    </select>
    <button class="btn" onclick="ajouterLigne()"><i class="fas fa-plus"></i> Ajouter au tableau</button>
    <button class="btn" onclick="exporterPDF()"><i class="fas fa-file-pdf"></i> Exporter PDF</button>
    <button class="btn" onclick="enregistrerFacture()"><i class="fas fa-save"></i> Enregistrer dans la base</button>
  </div>

  <div class="facture" id="facture">
    <p class="logos"><img src="../pics/logo.png" alt="Logo"></p>
    <h2><i class="fas fa-file-invoice-dollar"></i> Facture <span id="numFacture"></span></h2>
    <p><strong>Entreprise :</strong> <span id="nomEntreprise">-</span></p>
    <p><strong>Client :</strong> <span id="nomClient">-</span></p>
    <p><strong>Date :</strong> <span id="dateFacture"></span></p>
    <table>
      <thead>
        <tr>
          <th>Réf</th>
          <th>article</th>
          <th>Qté</th>
          <th>PU (DH)</th>
          <th>Total (DH)</th>
        </tr>
      </thead>
      <tbody id="corpsFacture"></tbody>
    </table>
    <h3>Total HT : <span id="totalHT">0.00 DH</span></h3>
    <h3>TVA (20%) : <span id="tva">0.00 DH</span></h3>
    <h3>Total TTC : <span id="totalTTC">0.00 DH</span></h3>
    <p><strong>Méthode de paiement :</strong> <span id="modePaiementFacture">Virement bancaire</span></p>
    <p><strong>Échéance :</strong> Paiement sous 30 jours</p>
    <canvas id="qr" width="100" height="100"></canvas>
    <p class="footer">Merci pour votre confiance. Facture générée automatiquement.</p>
  </div>

  <script src="../JS/enregistrerFacture.js"></script>
</body>

</html>