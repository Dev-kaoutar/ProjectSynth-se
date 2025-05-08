let lignes = JSON.parse(localStorage.getItem("lignes")) || [];

document.getElementById("dateFacture").textContent =
  new Date().toLocaleDateString();

const corps = document.getElementById("corpsFacture");
const nomEntreprise = document.getElementById("nomEntreprise");
const nomClient = document.getElementById("nomClient");
const totalHT = document.getElementById("totalHT");
const totalTTC = document.getElementById("totalTTC");
const tva = document.getElementById("tva");
const modePaiementFacture = document.getElementById("modePaiementFacture");

const qr = new QRious({ element: document.getElementById("qr"), size: 100 });

let totalHtGeneral = 0;

function ajouterLigne() {
  const numFactureInput = document
    .getElementById("numFactureInput")
    .value.trim();
  const entreprise = document.getElementById("entreprise").value.trim();
  const clientSelect = document.getElementById("client");
  const articleSelect = document.getElementById("article");

  const client = clientSelect.value;
  const article =
    articleSelect.options[articleSelect.selectedIndex]?.textContent;
  const ref = articleSelect.value;
  const qte = parseInt(document.getElementById("quantite").value);
  const prix = parseFloat(document.getElementById("prix").value);
  const modePaiement = document.getElementById("modePaiement").value;

  if (
    !client ||
    !ref ||
    isNaN(qte) ||
    isNaN(prix) ||
    !numFactureInput ||
    !entreprise
  ) {
    afficherMessage("Veuillez remplir tous les champs !", "error");
    return;
  }

  document.getElementById("numFacture").textContent = numFactureInput;
  nomEntreprise.textContent = entreprise;
  nomClient.textContent =
    clientSelect.options[clientSelect.selectedIndex].textContent;
  modePaiementFacture.textContent = modePaiement;

  const total = prix * qte;
  totalHtGeneral += total;
  const montantTVA = totalHtGeneral * 0.2;
  const montantTTC = totalHtGeneral + montantTVA;

  const ligne = `
      <tr>
        <td>${ref}</td>
        <td>${article}</td>
        <td>${qte}</td>
        <td>${prix.toFixed(2)}</td>
        <td>${total.toFixed(2)}</td>
      </tr>
    `;
  corps.innerHTML += ligne;
  lignes.push({ ref, article, qte, prix, total });
  localStorage.setItem("lignes", JSON.stringify(lignes));

  totalHT.textContent = totalHtGeneral.toFixed(2) + " DH";
  tva.textContent = montantTVA.toFixed(2) + " DH";
  totalTTC.textContent = montantTTC.toFixed(2) + " DH";

  qr.value = `Facture #${numFactureInput}\nClient: ${
    nomClient.textContent
  }\nTotal TTC: ${montantTTC.toFixed(2)} DH`;

  articleSelect.selectedIndex = 0;
  document.getElementById("quantite").value = 1;
  document.getElementById("prix").value = 0;
}

function exporterPDF() {
  const facture = document.getElementById("facture");
  const numFacture = document.getElementById("numFacture").textContent;
  html2pdf().from(facture).save(`facture_${numFacture}.pdf`);
}

function enregistrerFacture() {
  const numero_facture = document.getElementById("numFacture").textContent;
  const date_facture = new Date().toISOString().split("T")[0];
  const total_ht = parseFloat(totalHT.textContent.replace(" DH", ""));
  const tvaValue = parseFloat(tva.textContent.replace(" DH", ""));
  const total_ttc = parseFloat(totalTTC.textContent.replace(" DH", ""));
  const mode_paiement = document.getElementById("modePaiement").value;
  const client = document.getElementById("client").value;

  if (!client || lignes.length === 0) {
    afficherMessage(
      "Veuillez sélectionner un client et ajouter des lignes.",
      "error"
    );
    return;
  }

  const data = {
    numero_facture,
    date_facture,
    total_ht,
    tva: tvaValue,
    total_ttc,
    mode_paiement,
    client,
    lignes,
  };

  fetch("../BackEnd/EnregistrerFacture.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((res) => res.json())
    .then((res) => {
      if (res.success) {
        afficherMessage("Facture enregistrée avec succès !", "success");
        localStorage.removeItem("lignes");
        location.reload();
      } else {
        afficherMessage("Erreur : " + res.message, "error");
      }
    })
    .catch((err) => {
      console.error("Erreur réseau :", err);
      afficherMessage("Erreur lors de l'enregistrement.", "error");
    });
}
