<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <!-- <link rel="stylesheet" href="/CSS/styleHeader.css"> -->
  <link rel="stylesheet" href="../CSS/styleListes.css">

  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet" />

  <style>
    .actions {
      display: flex;
      gap: 6px;
      align-items: center;
      /* margin-bottom: 10px; */
    }

    .add-icon {
      font-size: 45px;
      color: #1793d5;
      cursor: pointer;
      padding: 10px;
    }
  </style>
</head>

<body>
  <?php include 'header.php' ?>
  <div class="form-container">

    <h2>Ajouter Entrée</h2>

    <form action="ajouter_article.php" method="POST">
      <div class="input-group input-group-full">
        <i class="fas fa-user"></i>
        <select name="fournisseur" required>
          <option value="">-- Fournisseur --</option>
          <option value="Fournisseur 1">Fournisseur 1</option>
          <option value="Fournisseur 2">Fournisseur 2</option>
        </select>
      </div>
      <div class="form-grid">
        <div class="input-group input-group-full">
          <i class="fas fa-barcode"></i>
          <input type="text" name="reference" placeholder="Référence" required>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-tag"></i>
          <input type="text" name="nom" placeholder="Nom de l'article" required>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-list"></i>
          <select name="categorie" required>
            <option value="">-- Catégorie --</option>
            <option>Ordinateur</option>
            <option>Smartphone</option>
            <option>Tablette</option>
            <option>Accessoire</option>
            <option>Autre</option>
          </select>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-industry"></i>
          <input type="text" name="marque" placeholder="Marque" required>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-boxes"></i>
          <input type="number" name="quantite" placeholder="Quantité" min="0" required>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-dollar-sign"></i>
          <input type="number" name="prix_unitaire" placeholder="Prix unitaire (DH)" step="0.01" min="0" required>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-calendar-alt"></i>
          <input type="date" name="date_ajout" required>
        </div>

        <!-- <div class="input-group input-group-full">
              <i class="fas fa-align-left"></i>
              <textarea name="description" placeholder="Description" rows="3"></textarea>
            </div> -->
      </div>
      <div class="one-line">
        <div class="input-group input-group-full">
          <i class="fas fa-align-left"></i>
          <textarea name="description" placeholder="Description" rows="3"></textarea>
        </div>
        <i class="fas fa-plus-circle add-icon" onclick="ajouterArticle()" title="Ajouter un article"></i>
      </div>
      <table id="tableArticles" border="1" style="margin: 20px auto; width: 95%; border-collapse: collapse; display: none;">
        <thead>
          <tr>
            <th>Fournisseur</th>
            <th>Référence</th>
            <th>Nom d'article</th>
            <th>Catégorie</th>
            <th>Marque</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Date</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>



      <button type="submit" class="button">Ajouter l'article</button>

    </form>


  </div>
  <!-- <script src="../TableUnderForm.js"></script> -->
  <script>
    // Fonction pour ajouter un article
    function ajouterArticle() {
      const fournisseur = document.querySelector("select[name='fournisseur']").value;
      const reference = document.querySelector("input[name='reference']").value;
      const nom = document.querySelector("input[name='nom']").value;
      const categorie = document.querySelectorAll("select[name='categorie']").value;
      const marque = document.querySelector("input[name='marque']").value;
      const quantite = document.querySelector("input[name='quantite']").value;
      const prix = document.querySelector("input[name='prix_unitaire']").value;
      const date = document.querySelector("input[name='date_ajout']").value;
      const description = document.querySelector("textarea[name='description']").value;

      const article = {
        fournisseur,
        reference,
        nom,
        categorie,
        marque,
        quantite,
        prix,
        date,
        description
      };

      // Récupérer les anciens articles depuis localStorage
      let articles = JSON.parse(localStorage.getItem("articles")) || [];
      articles.push(article);
      localStorage.setItem("articles", JSON.stringify(articles));

      insererArticleDansTableau(article);
      document.getElementById("tableArticles").style.display = "table";
    }

    // Fonction pour insérer une ligne dans le tableau
    function insererArticleDansTableau(article) {
      const tbody = document.querySelector("#tableArticles tbody");

      const ligne = document.createElement("tr");
      ligne.innerHTML = `
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
        <button onclick="modifierArticle(this)" class="edit"><i class="fas fa-plus-circle edit-icon"></i></button>
        <button onclick="supprimerArticle(this)" class="delete"><i class="fas fa-trash-alt delete-icon"></i></button>
      </td>
    `;
      tbody.appendChild(ligne);
    }

    // Fonction pour charger les articles au démarrage
    function chargerArticles() {
      const articles = JSON.parse(localStorage.getItem("articles")) || [];
      if (articles.length > 0) {
        document.getElementById("tableArticles").style.display = "table";
        articles.forEach(insererArticleDansTableau);
      }
    }

    // Appeler la fonction au chargement de la page
    window.onload = chargerArticles;

    // Optionnel : supprimer un article
    function supprimerArticle(btn) {
      const ligne = btn.parentElement.parentElement;
      const index = ligne.rowIndex - 1; // -1 pour exclure l'en-tête
      ligne.remove();

      let articles = JSON.parse(localStorage.getItem("articles")) || [];
      articles.splice(index, 1);
      localStorage.setItem("articles", JSON.stringify(articles));
    }

    // Optionnel : modifier un article (à implémenter)
    function modifierArticle(btn) {
      const ligne = btn.closest("tr").children;
      document.querySelectorAll("select")[0].value = ligne[0].textContent;
      document.querySelector('input[name="reference"]').value = ligne[1].textContent;
      document.querySelector('input[name="nom"]').value = ligne[2].textContent;
      document.querySelectorAll("select")[1].value = ligne[3].textContent;
      document.querySelector('input[name="marque"]').value = ligne[4].textContent;
      document.querySelector('input[name="quantite"]').value = ligne[5].textContent;
      document.querySelector('input[name="prix_unitaire"]').value = ligne[6].textContent;
      document.querySelector('input[name="date_ajout"]').value = ligne[7].textContent;
      document.querySelector('textarea[name="description"]').value = ligne[8].textContent;

      btn.closest("tr").remove(); // Supprimer pour mettre à jour après modification
    }

    // Vider le tableau et localStorage après le submit
    document.querySelector("form").addEventListener("submit", function(e) {
      e.preventDefault(); // Empêcher rechargement
      localStorage.removeItem("articles");
      const tbody = document.querySelector("#tableArticles tbody");
      while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild); // Supprimer tous les éléments du tableau
      }
      document.getElementById("tableArticles").style.display = "none";
      this.reset(); // Réinitialiser les champs du formulaire
    });

    // // Vider le tableau et localStorage après le submit
    // document.querySelector("form").addEventListener("submit", function(e) {
    //   e.preventDefault(); // Empêcher rechargement
    //   localStorage.removeItem("articles");
    //   document.querySelector("#tableArticles tbody").innerHTML = "";
    //   document.getElementById("tableArticles").style.display = "none";
    //   this.reset(); // Réinitialiser les champs du formulaire
    // });
  </script>


</body>

</html>