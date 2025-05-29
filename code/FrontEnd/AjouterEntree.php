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
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="../CSS/selectWithSearch.css">
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
      padding: 8px;
    }

    @media (max-width: 530px) {

      .list-container {
        padding: 5px 0px;
      }

      table {
        font-size: 10px;
      }

      th,
      td {
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

      <div class="form-grid">
        <div class="input-group input-group-full">
          <i class="fas fa-user icon-left"></i>
          <select name="fournisseur" id="fournisseur">
            <option value="">-- Fournisseur --</option>
            <!-- Les options seront ajoutées d'après la base de données  -->
          </select>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-calendar-alt"></i>
          <input type="date" name="date_ajout" value="<?php echo date('Y-m-d'); ?>">
        </div>
      </div>
      <div class="one-line">
        <div class="input-group input-group-full">
          <i class="fas fa-barcode icon-left"></i>
          <select name="reference" id="reference">
            <option value="">-- Article --</option>
            <!-- Les options seront ajoutées d'après la base de données  -->
          </select>
        </div>

        <div class="input-group input-group-full">
          <i class="fas fa-boxes"></i>
          <input type="number" name="quantite" placeholder="Quantité" min="0">
        </div>

        <i class="fas fa-plus-circle add-icon" onclick="ajouterArticle()" title="Ajouter un article"></i>
      </div>
      <table id="tableArticles" style="margin-top: 20px;">
        <thead>
          <tr>
            <th>Fournisseur</th>
            <th>Référence</th>
            <th>Nom d'article</th>
            <th>Quantité</th>
            <th>Date</th>
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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      // Initialiser Select2 pour les sélecteurs
      $('#fournisseur').select2({
        placeholder: " Fournisseur ",
      });

      $('#reference').select2({
        placeholder: " Article ",
      });
    });
  </script>
</body>

</html>