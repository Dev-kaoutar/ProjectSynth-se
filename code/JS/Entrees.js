let articles = [];

function getFormData() {
  const form = document.forms["formArticles"];
  return {
    fournisseur: form.fournisseur.value.trim(),
    reference: form.reference.value.trim(),
    nom: form.nom.value.trim(),
    categorie: form.categorie.value.trim(),
    marque: form.marque.value.trim(),
    quantite: parseInt(form.quantite.value),
    prix: parseFloat(form.prix_unitaire.value),
    date: form.date_ajout.value,
    description: form.description.value.trim(),
  };
}

function validerChamps(article) {
  for (let key in article) {
    if (
      key !== "description" &&
      (article[key] === "" ||
        article[key] === null ||
        (typeof article[key] === "number" && isNaN(article[key])))
    ) {
      return false;
    }
  }
  return true;
}

function viderFormulaire() {
  const champs = document.querySelectorAll(
    "#formArticles input, #formArticles textarea, #formArticles select"
  );
  champs.forEach((input) => {
    if (input.name !== "fournisseur" && input.name !== "date_ajout")
      input.value = "";
  });
}

function afficherMessage(message, type = "success") {
  const msgDiv = document.getElementById("message");
  msgDiv.style.display = "block";
  msgDiv.textContent = message;
  msgDiv.style.color = type === "success" ? "green" : "red";
  msgDiv.style.fontWeight = "bold";
  msgDiv.style.backgroundColor = type === "success" ? "#d4edda" : "#f8d7da";
  msgDiv.style.border =
    "1px solid" + type === "success" ? "#c3e6cb" : "#f5c6cb";
  msgDiv.style.padding = "10px";
  msgDiv.style.borderRadius = "5px";

  setTimeout(() => {
    msgDiv.style.display = "none";
    msgDiv.textContent = "";
  }, 5000);
}

function ajouterArticle() {
  const article = getFormData();

  if (!validerChamps(article)) {
    afficherMessage("Veuillez remplir tous les champs obligatoires !", "error");
    return;
  }

  articles.push(article);
  localStorage.setItem("articles", JSON.stringify(articles));
  rechargerTable();
  viderFormulaire();
  afficherMessage("Article ajouté temporairement.");
}

function afficherArticleDansTable(article, index) {
  const tbody = document.querySelector("#tableArticles tbody");
  const tr = document.createElement("tr");
  tr.setAttribute("data-index", index);

  tr.innerHTML = `
    <td>${article.fournisseur}</td>
    <td>${article.reference}</td>
    <td>${article.nom}</td>
    <td>${article.categorie}</td>
    <td>${article.marque}</td>
    <td>${article.quantite}</td>
    <td>${article.prix}</td>
    <td>${article.date}</td>
    <td>${article.description}</td>
    <td class="actions">
      <button onclick="modifierArticle(this)" class="edit"><i class="fas fa-edit"></i></button>
      <button onclick="supprimerArticle(this)" class="delete"><i class="fas fa-trash-alt"></i></button>
    </td>
  `;

  tbody.appendChild(tr);
}

function rechargerTable() {
  const tbody = document.querySelector("#tableArticles tbody");
  tbody.innerHTML = "";
  articles.forEach((article, index) =>
    afficherArticleDansTable(article, index)
  );
  document.getElementById("tableArticles").style.display =
    articles.length > 0 ? "table" : "none";
}

function chargerArticles() {
  articles = JSON.parse(localStorage.getItem("articles")) || [];
  rechargerTable();
}

function supprimerArticle(button) {
  const row = button.closest("tr");
  const index = parseInt(row.getAttribute("data-index"));
  if (!isNaN(index)) {
    articles.splice(index, 1);
    localStorage.setItem("articles", JSON.stringify(articles));
    rechargerTable();
    afficherMessage("Article supprimé.");
  }
}

function modifierArticle(button) {
  const row = button.closest("tr");
  const index = parseInt(row.getAttribute("data-index"));
  const article = articles[index];

  if (article) {
    const form = document.forms["formArticles"];
    form.fournisseur.value = article.fournisseur;
    form.reference.value = article.reference;
    form.nom.value = article.nom;
    form.categorie.value = article.categorie;
    form.marque.value = article.marque;
    form.quantite.value = article.quantite;
    form.prix_unitaire.value = article.prix;
    form.date_ajout.value = article.date;
    form.description.value = article.description;

    articles.splice(index, 1);
    localStorage.setItem("articles", JSON.stringify(articles));
    rechargerTable();
    afficherMessage("Article chargé pour modification.");
  }
}

function chargerFournisseurs() {
  fetch("../BackEnd/Ajouter_Entree.php")
    .then((response) => response.json())
    .then((data) => {
      const select = document.getElementById("fournisseur");
      data.forEach((f) => {
        const opt = document.createElement("option");
        opt.value = f.nom_fournisseur;
        opt.textContent = f.nom_fournisseur;
        select.appendChild(opt);
      });
    })
    .catch((err) => afficherMessage("Erreur chargement fournisseurs", "error"));
}

function soumettreFormulaire(event) {
  event.preventDefault();

  if (articles.length === 0) {
    afficherMessage("Aucun article à soumettre !", "error");
    return;
  }

  fetch("../BackEnd/Ajouter_Entree.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ articles }),
  })
    .then((res) => res.json())
    .then((res) => {
      if (res.success) {
        afficherMessage("Articles ajoutés avec succès !");
        localStorage.removeItem("articles");
        articles = [];
        rechargerTable();
        setTimeout(() => {
          window.location.href = "../FrontEnd/Entry.php";
        }, 2000);
      } else {
        afficherMessage("Erreur : " + res.message, "error");
      }
    })
    .catch((err) => {
      console.error("Erreur :", err);
      afficherMessage("Erreur d'envoi ou problème réseau.", "error");
    });
}

document
  .getElementById("formArticles")
  .addEventListener("submit", soumettreFormulaire);

window.onload = function () {
  chargerFournisseurs();
  chargerArticles();
};
