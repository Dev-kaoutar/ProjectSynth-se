let articles = JSON.parse(localStorage.getItem("articles")) || [];

function afficherMessage(message, type = "success") {
  const msgDiv = document.getElementById("message");
  msgDiv.style.display = "block";
  msgDiv.textContent = message;
  msgDiv.style.color = type === "success" ? "green" : "red";
  msgDiv.style.fontWeight = "bold";
  msgDiv.style.backgroundColor = type === "success" ? "#d4edda" : "#f8d7da";
  msgDiv.style.border =
    "1px solid " + (type === "success" ? "#c3e6cb" : "#f5c6cb");
  msgDiv.style.padding = "10px";
  msgDiv.style.borderRadius = "5px";

  setTimeout(() => {
    msgDiv.style.display = "none";
    msgDiv.textContent = "";
  }, 4000);
}

function ajouterArticle() {
  const destinataire = document.querySelector(
    "select[name='destinataire']"
  ).value;
  const date_sortie = document.getElementById("date_sortie").value;
  const nom = document.getElementById("nom").value;
  const quantite = document.getElementById("quantite_sortie").value;

  if (!destinataire || !date_sortie || !nom || !quantite) {
    afficherMessage("Veuillez remplir tous les champs.", "error");
    return;
  }

  const article = {
    destinataire,
    date_sortie,
    nom,
    quantite,
  };
  articles.push(article);
  localStorage.setItem("articles", JSON.stringify(articles));

  insererArticleDansTableau(article);
  document.getElementById("tableArticles").style.display = "table";

  // Réinitialiser les champs
  document.getElementById("nom").value = "";
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
          <button onclick="modifierArticle(this)" class="edit"><i class="fas fa-edit"></i></button>
          <button onclick="supprimerArticle(this)" class="delete"><i class="fas fa-trash-alt"></i></button>
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
  chargerArticles();
  afficherMessage("Article supprimé avec succès !");
}

function modifierArticle(btn) {
  const ligne = btn.closest("tr").children;
  document.getElementById("destinataire").value = ligne[0].textContent;
  document.getElementById("date_sortie").value = ligne[1].textContent;
  document.getElementById("nom").value = ligne[2].textContent;
  document.getElementById("quantite_sortie").value = ligne[3].textContent;
  supprimerArticle(btn);
  chargerArticles();
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
        option.textContent = `${a.designation} (stock: ${a.quantite_stock})`;
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
