<?php
include '../DB/Config.php';
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
    <input type="text" id="numFactureInput" placeholder="Numéro de la facture" value="12345">
    <input type="text" id="entreprise" placeholder="Nom de l'entreprise" value="TechStore SARL">
    <input type="text" id="client" placeholder="Nom du client">
    <input type="text" id="produit" placeholder="Produit">
    <input type="text" id="ref" placeholder="Référence produit">
    <input type="number" id="quantite" placeholder="Quantité" min="1" value="1">
    <input type="number" id="prix" placeholder="Prix unitaire (DH)" min="0" value="0">
    <select id="modePaiement">
      <option value="Virement bancaire">Virement bancaire</option>
      <option value="Chèque">Chèque</option>
      <option value="Espèces">Espèces</option>
    </select>
    <button class="btn" onclick="ajouterLigne()"><i class="fas fa-plus"></i>Ajouter au tableau</button>
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
          <th>Produit</th>
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

  <script>
    const numFacture = Math.floor(Math.random() * 100000);
    document.getElementById("numFacture").textContent = numFacture;
    document.getElementById("dateFacture").textContent = new Date().toLocaleDateString();

    const corps = document.getElementById("corpsFacture");
    const nomEntreprise = document.getElementById("nomEntreprise");
    const nomClient = document.getElementById("nomClient");
    const totalHT = document.getElementById("totalHT");
    const totalTTC = document.getElementById("totalTTC");
    const tva = document.getElementById("tva");
    const modePaiementFacture = document.getElementById("modePaiementFacture");
    const qr = new QRious({
      element: document.getElementById("qr"),
      size: 100
    });

    let totalHtGeneral = 0;

    function ajouterLigne() {
      const numFactureInput = document.getElementById("numFactureInput").value;
      const entreprise = document.getElementById("entreprise").value;
      const client = document.getElementById("client").value;
      const produit = document.getElementById("produit").value;
      const ref = document.getElementById("ref").value;
      const qte = parseInt(document.getElementById("quantite").value);
      const prix = parseFloat(document.getElementById("prix").value);
      const modePaiement = document.getElementById("modePaiement").value;

      if (!client || !produit || isNaN(qte) || isNaN(prix)) {
        alert("Veuillez remplir tous les champs !");
        return;
      }

      document.getElementById("numFacture").textContent = numFactureInput;
      nomEntreprise.textContent = entreprise;
      nomClient.textContent = client;
      modePaiementFacture.textContent = modePaiement;

      const total = prix * qte;
      totalHtGeneral += total;

      const ligne = `
        <tr>
          <td>${ref}</td>
          <td>${produit}</td>
          <td>${qte}</td>
          <td>${prix.toFixed(2)}</td>
          <td>${total.toFixed(2)}</td>
        </tr>
      `;
      corps.innerHTML += ligne;

      const montantTVA = totalHtGeneral * 0.2;
      totalHT.textContent = totalHtGeneral.toFixed(2) + " DH";
      tva.textContent = montantTVA.toFixed(2) + " DH";
      totalTTC.textContent = (totalHtGeneral + montantTVA).toFixed(2) + " DH";

      qr.value = `Facture #${numFactureInput}\nClient: ${client}\nTotal TTC: ${(totalHtGeneral + montantTVA).toFixed(2)} DH`;

      // Réinitialisation des champs sauf client/entreprise
      document.getElementById("produit").value = '';
      document.getElementById("ref").value = '';
      document.getElementById("quantite").value = 1;
      document.getElementById("prix").value = 0;
    }

    function exporterPDF() {
      const facture = document.getElementById("facture");
      html2pdf().from(facture).save(`facture_${numFacture}.pdf`);
    }

    function imprimerFacture() {
      const facture = document.getElementById("facture");
      window.print();
    }
  </script>
</body>

</body>

</html>