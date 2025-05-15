<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/styleListes.css">
  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet" />

  <style>
    .actions {
      display: flex;
      justify-self: center;
      align-items: center;
      gap: 7px;

    }

    .add-icon {
      font-size: 45px;
      color: #1793d5;
      cursor: pointer;
      padding: 10px;
    }
    
    @media (max-width: 530px) {
    
      .list-container {
        padding: 5px 0px;
      }
      table {
        font-size: 10px;
      }
      th, td {
        padding: 0px 1px;
      }
    } 
  </style>
</head>

<body>
  <?php include 'header.php' ?>
  <div class="form-container">
    <div id="message" style="text-align: center; margin-bottom: 10px;"></div>
    <h2>Ajouter Entrée</h2>
    <form id="formArticles">
      <div class="input-group input-group-full">
        <i class="fas fa-user"></i>
        <select name="fournisseur" id="fournisseur">
          <option value="">-- Fournisseur --</option>
          <!-- Les options seront ajoutées d'après la base de données  -->
        </select>
      </div>
      <div class="form-grid">
        <div class="input-group input-group-full">
          <i class="fas fa-barcode"></i>
          <input type="text" name="reference" placeholder="Référence">
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-tag"></i>
          <input type="text" name="nom" placeholder="Nom de l'article">
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-list"></i>
          <select name="categorie">
            <option value="">-- Catégorie --</option>
            <option>Ordinateur</option>
            <option>Smartphone</option>
            <option>Tablette</option>
            <option>Accessoire</option>
            <option>Imprimante</option>
            <option>Autre</option>
          </select>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-industry"></i>
          <input type="text" name="marque" placeholder="Marque">
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-boxes"></i>
          <input type="number" name="quantite" placeholder="Quantité" min="0">
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-dollar-sign"></i>
          <input type="number" name="prix_unitaire" placeholder="Prix unitaire (DH)" step="0.01" min="0">
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-calendar-alt"></i>
          <input type="date" name="date_ajout" value="<?php echo date('Y-m-d'); ?>">
        </div>

      </div>
      <div class="one-line">
        <div class="input-group input-group-full">
          <i class="fas fa-align-left"></i>
          <textarea name="description" placeholder="Description" rows="3"></textarea>
        </div>
        <i class="fas fa-plus-circle add-icon" onclick="ajouterArticle()" title="Ajouter un article"></i>
      </div>
      <table id="tableArticles" style="margin-top: 20px;">
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
      <button type="submit" class="button">Valider l'entrée</button>
    </form>
  </div>
  <script src="../JS/messageError&success.js"></script>
  <script src="../JS/Entrees.js"></script>

</body>

</html>