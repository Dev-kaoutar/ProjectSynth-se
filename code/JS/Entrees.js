window.onload = function () {
  chargerFournisseurs();
  chargerArticlesDisponibles();
  chargerArticles();
};

function getFormData() {
  const form = document.forms["formArticles"];
  const referenceSelect = form.reference;
  const selectedOption = referenceSelect.options[referenceSelect.selectedIndex];

  return {
    id_fournisseur: form.fournisseur.options[
      form.fournisseur.selectedIndex
    ].getAttribute("data-id_fournisseur"),
    fournisseur: form.fournisseur.value.trim(),
    reference: referenceSelect.value.trim(),
    nom: selectedOption.getAttribute("data-nom") || "",
    quantite: parseInt(form.quantite.value),
    date: form.date_ajout.value,
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
    <td>${article.quantite}</td>
    <td>${article.date}</td>
    <td class="actions">
      <button onclick="if(confirm('Voulez-vous vraiment modifier cet article ?')) modifierArticle(this)" class="edit"><i class="fas fa-edit"></i></button>
      <button onclick="if(confirm('Voulez-vous vraiment supprimer cet article ?')) supprimerArticle(this)" class="delete"><i class="fas fa-trash-alt"></i></button>
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

    form.quantite.value = article.quantite;
    form.date_ajout.value = article.date;

    articles.splice(index, 1);
    localStorage.setItem("articles", JSON.stringify(articles));
    rechargerTable();
    afficherMessage("Article chargé pour modification.");
  }
}

function chargerFournisseurs() {
  fetch("../BackEnd/Ajouter_Entree.php?fournisseurs=1")
    .then((response) => response.json())
    .then((data) => {
      const select = document.getElementById("fournisseur");
      data.forEach((fournisseur) => {
        const option = document.createElement("option");
        option.value = fournisseur.nom_fournisseur;
        option.setAttribute("data-id_fournisseur", fournisseur.id_fournisseur);
        option.textContent = fournisseur.nom_fournisseur;
        select.appendChild(option);
      });
    })
    .catch(() => afficherMessage("Erreur chargement fournisseurs", "error"));
}

function chargerArticlesDisponibles() {
  fetch("../BackEnd/Ajouter_Entree.php?articles=1")
    .then((response) => response.json())
    .then((data) => {
      const select = document.getElementById("reference");
      data.forEach((article) => {
        const option = document.createElement("option");
        option.value = article.reference;
        option.textContent = `${article.reference} - ${article.designation}`;
        option.setAttribute("data-nom", article.designation);
        select.appendChild(option);
      });
    })
    .catch(() => afficherMessage("Erreur chargement articles", "error"));
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
