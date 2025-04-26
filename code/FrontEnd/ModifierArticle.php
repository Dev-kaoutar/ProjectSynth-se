<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier l'Article</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleModifierArticle.css">
</head>
<body>

  <div class="form-container">
    <h2>📝 Modifier l'Article</h2>
    <form id="modifierForm" class="form-grid" onsubmit="event.preventDefault(); alert('Modifications enregistrées ✅');">
      <div class="form-group">
        <label>ID</label>
        <input type="text" id="id" readonly>
      </div>
      <div class="form-group">
        <label>Nom</label>
        <input type="text" id="nom">
      </div>
      <div class="form-group">
        <label>Quantité</label>
        <input type="number" id="quantite">
      </div>
      <div class="form-group">
        <label>Prix</label>
        <input type="text" id="prix">
      </div>
      <div class="form-group full-width">
        <label>Catégorie</label>
        <input type="text" id="categorie">
      </div>

      <div class="button-row full-width">
        <button type="submit">💾 Enregistrer</button>
        <a href="stock.html">🔙 Annuler</a>
      </div>
    </form>
  </div>

  <script>
    const article = {
      id: "001",
      nom: "Stylo Bleu",
      quantite: 120,
      prix: "2.50 DH",
      categorie: "Papeterie"
    };

    document.getElementById('id').value = article.id;
    document.getElementById('nom').value = article.nom;
    document.getElementById('quantite').value = article.quantite;
    document.getElementById('prix').value = article.prix;
    document.getElementById('categorie').value = article.categorie;
  </script>

</body>
</html>
