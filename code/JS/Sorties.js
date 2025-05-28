let articles = JSON.parse(localStorage.getItem("articles")) || [];

function ajouterArticle() {
  const destinataire = document.querySelector(
    "select[name='destinataire']"
  ).value;

  const id_client = document
    .querySelector("select[name='destinataire'] option:checked")
    .getAttribute("data-id_Client"); // Récupérer l'ID du client sélectionné

  const date_sortie = document.getElementById("date_sortie").value;

  const nom = document.getElementById("nom").value; // Récupérer la valeur de l'option sélectionnée

  const selectNom = document.getElementById("nom");
  const selectedOption = selectNom.options[selectNom.selectedIndex];
  const id_article = selectedOption.getAttribute("data-id_Article"); // Récupérer l'ID de l'article sélectionné
  const quantiteStock = parseInt(selectedOption.getAttribute("data-stock"));

  const quantite = parseInt(document.getElementById("quantite_sortie").value);

  if (!destinataire || !date_sortie || !nom || isNaN(quantite)) {
    afficherMessage("Veuillez remplir tous les champs.", "error");
    return;
  }

  if (quantite <= 0) {
    afficherMessage("Veuillez entrer une quantité supérieure à 0.", "error");
    return;
  }

  if (quantite > quantiteStock) {
    afficherMessage(
      `La quantité demandée (${quantite}) dépasse le stock disponible (${quantiteStock}).`,
      "error"
    );
    return;
  }

  const article = {
    id_client,
    destinataire,
    date_sortie,
    nom,
    quantite,
    id_article,
  };
  articles.push(article);
  localStorage.setItem("articles", JSON.stringify(articles));

  insererArticleDansTableau(article);
  document.getElementById("tableArticles").style.display = "table";

  // Réinitialiser les champs
  selectNom.value = "";
  document.getElementById("quantite_sortie").value = "";
}

function insererArticleDansTableau(article) {
  const tbody = document.querySelector("#tableArticles tbody");
  const ligne = document.createElement("tr");
  ligne.innerHTML = `
        <td>${article.destinataire}</td>
        <td>${article.date_sortie}</td>
        <td>${article.nom}</td>
        <td>${article.quantite}</td>
        <td class="actions">
          <button onclick="if(confirm('Voulez-vous vraiment modifier cet article ?')) modifierArticle(this)" class="edit"><i class="fas fa-edit"></i></button>
          <button onclick="if(confirm('Voulez-vous vraiment supprimer cet article ?')) supprimerArticle(this)" class="delete"><i class="fas fa-trash-alt"></i></button>
        </td>
      `;
  tbody.appendChild(ligne);
}

function chargerArticles() {
  if (articles.length > 0) {
    document.getElementById("tableArticles").style.display = "table";
    articles.forEach(insererArticleDansTableau);
  } else {
    document.getElementById("tableArticles").style.display = "none";
  }
}

function supprimerArticle(btn) {
  const ligne = btn.parentElement.parentElement;
  const index = ligne.rowIndex - 1;
  ligne.remove();
  articles.splice(index, 1);
  localStorage.setItem("articles", JSON.stringify(articles));
  if (articles.length === 0) {
    document.getElementById("tableArticles").style.display = "none";
  }
  afficherMessage("Article supprimé avec succès !");
}

function modifierArticle(btn) {
  const ligne = btn.closest("tr").children;
  document.getElementById("destinataire").value = ligne[0].textContent;
  document.getElementById("date_sortie").value = ligne[1].textContent;
  document.getElementById("nom").value = ligne[2].textContent;
  document.getElementById("quantite_sortie").value = ligne[3].textContent;
  supprimerArticle(btn);
  if (articles.length === 0) {
    document.getElementById("tableArticles").style.display = "none";
  }
  afficherMessage("Article chargé pour modification.");
}

function chargerClients() {
  fetch("../BackEnd/Ajouter_Sortie.php?type=clients")
    .then((response) => response.json())
    .then((data) => {
      const select = document.getElementById("destinataire");
      data.forEach((C) => {
        const option = document.createElement("option");
        option.value = C.nom_client;
        option.textContent = C.nom_client;
        option.setAttribute("data-id_Client", C.id_client); // Ajouter l'attribut data-id
        select.appendChild(option);
      });
    })
    .catch(() => afficherMessage("Erreur chargement clients", "error"));
}

function chargerArticlesSelect() {
  fetch("../BackEnd/Ajouter_Sortie.php?type=articles")
    .then((res) => res.json())
    .then((data) => {
      const select = document.querySelector("select[name='nom']");
      data.forEach((a) => {
        const option = document.createElement("option");
        option.value = a.designation;
        option.textContent = `${a.designation} (${a.quantite_stock})`; // Afficher le stock entre parenthèses
        option.setAttribute("data-stock", a.quantite_stock); // Ajouter l'attribut data-stock
        option.setAttribute("data-id_Article", a.id_article); // Ajouter l'attribut data-id
        select.appendChild(option);
      });
    })
    .catch((err) => afficherMessage("Erreur chargement articles", "error"));
}

document.getElementById("sortieForm").addEventListener("submit", function (e) {
  e.preventDefault();

  if (articles.length === 0) {
    afficherMessage("Aucun article à soumettre !", "error");
    return;
  }

  fetch("../BackEnd/Ajouter_Sortie.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      articles,
    }),
  })
    .then((res) => res.json())
    .then((res) => {
      if (res.success) {
        afficherMessage("Articles ajoutés avec succès !");
        localStorage.removeItem("articles");
        articles = [];
        chargerArticles();
        setTimeout(() => {
          window.location.href = "../FrontEnd/Exit.php";
        }, 2000);
      } else {
        afficherMessage("Erreur : " + res.message, "error");
      }
    })
    .catch(() => {
      afficherMessage("Erreur d'envoi ou problème réseau.", "error");
    });
});

window.onload = function () {
  chargerClients();
  chargerArticles();
  chargerArticlesSelect();
};
