<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Détails de l'Article</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/styleDetailleArticle.css">

</head>

<body>
  <?php include '../FrontEnd/Header.php'; ?>
  <div class="form-container">
    <h2>🔎 Détails de l'Article</h2>
    <form id="detailsForm" class="form-grid">
      <div class="form-group">
        <label>ID</label>
        <input type="text" id="id" readonly>
      </div>
      <div class="form-group">
        <label>Nom</label>
        <input type="text" id="nom" readonly>
      </div>
      <div class="form-group">
        <label>Quantité</label>
        <input type="number" id="quantite" readonly>
      </div>
      <div class="form-group">
        <label>Prix</label>
        <input type="text" id="prix" readonly>
      </div>
      <div class="form-group">
        <label>Catégorie</label>
        <input type="text" id="categorie" readonly>
      </div>
      <div class="form-group">
        <label>Statut</label>
        <input type="text" id="statut" readonly>
      </div>
      <div class="form-group">
        <label>Fournisseur</label>
        <input type="text" id="fournisseur" readonly>
      </div>
      <div class="form-group">
        <label>Date d'Ajout</label>
        <input type="date" id="dateAjout" readonly>
      </div>
      <div class="form-group full-width">
        <label>Description</label>
        <textarea id="description" rows="3" readonly></textarea>
      </div>

      <div class="button-row full-width">
        <a href="stock.php">🔙 Retour</a>
      </div>
    </form>
  </div>

  <script>
    const article = {
      id: "002",
      nom: "ordinateur portable",
      quantite: 30,
      prix: "8000 DH",
      categorie: "ordinateurs",
      statut: "Disponible",
      fournisseur: "Fournitures ABC",
      dateAjout: "2024-04-01",
      description: "un ordinateur portable de 15 pouces avec 8 Go de RAM et 256 Go de SSD."
    };

    document.getElementById('id').value = article.id;
    document.getElementById('nom').value = article.nom;
    document.getElementById('quantite').value = article.quantite;
    document.getElementById('prix').value = article.prix;
    document.getElementById('categorie').value = article.categorie;
    document.getElementById('statut').value = article.statut;
    document.getElementById('fournisseur').value = article.fournisseur;
    document.getElementById('dateAjout').value = article.dateAjout;
    document.getElementById('description').value = article.description;
  </script>

</body>

</html>