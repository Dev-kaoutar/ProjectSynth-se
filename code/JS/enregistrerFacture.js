 let lignes = [];
    document.addEventListener("DOMContentLoaded", () => {
      const corps = document.getElementById("corpsFacture");
      const totalHT = document.getElementById("totalHT");
      const totalTTC = document.getElementById("totalTTC");
      const tva = document.getElementById("tva");
      const nomClient = document.getElementById("nomClient");
      const numFacture = document.getElementById("numFacture").textContent;

      const rows = document.querySelectorAll("#corpsFacture tr");
      let totalHtGeneral = 0;
      lignes = [];

      rows.forEach((row) => {
        const cells = row.querySelectorAll("td");
        const ref = cells[0].textContent.trim();
        const qte = parseInt(cells[2].textContent);
        const prix = parseFloat(cells[3].textContent.replace(" DH", ""));
        const total = parseFloat(cells[4].textContent.replace(" DH", ""));

        lignes.push({
          ref,
          qte,
          prix,
          total
        });
        totalHtGeneral += total;
      });

      const montantTVA = totalHtGeneral * 0.2;
      const montantTTC = totalHtGeneral + montantTVA;

      totalHT.textContent = totalHtGeneral.toFixed(2) + " DH";
      tva.textContent = montantTVA.toFixed(2) + " DH";
      totalTTC.textContent = montantTTC.toFixed(2) + " DH";

      new QRious({
        element: document.getElementById("qr"),
        size: 100,
        value: `Facture #${numFacture} \n Client: ${nomClient.textContent} \n Total TTC: ${montantTTC.toFixed(2)} DH`,
      });
    });

    function changerModePaiement() {
      const selected = document.getElementById("selectPaiement").value;
      document.getElementById("modePaiementFacture").textContent = selected;
    }

    function exporterPDF() {
      const facture = document.getElementById("facture");
      const numFacture = document.getElementById("numFacture").textContent;
      html2pdf().from(facture).save(`facture_${numFacture}.pdf`);
    }

    function enregistrerFacture() {
      const numero_facture = document.getElementById("numFacture").textContent;
      const date_facture = new Date().toISOString().split("T")[0];
      const total_ht = parseFloat(document.getElementById("totalHT").textContent.replace(" DH", ""));
      const tvaValue = parseFloat(document.getElementById("tva").textContent.replace(" DH", ""));
      const total_ttc = parseFloat(document.getElementById("totalTTC").textContent.replace(" DH", ""));
      const mode_paiement = document.getElementById("modePaiementFacture").textContent;
      const client = document.getElementById("client").value;

      if (!client || lignes.length === 0) {
        afficherMessage("Veuillez sélectionner un client et ajouter des lignes.", "error");
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
            afficherMessage("Facture enregistrée avec succès !");
            localStorage.removeItem("lignes");
            setTimeout(() => {
              window.location.href = "../FrontEnd/Exit.php";
            }, 2000);
          } else {
            afficherMessage("Erreur : " + res.message, "error");
          }
        })
        .catch((err) => {
          console.error("Erreur réseau :", err);
          afficherMessage("Erreur lors de l'enregistrement.", "error");
        });
    }