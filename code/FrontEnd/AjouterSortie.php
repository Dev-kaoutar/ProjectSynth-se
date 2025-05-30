<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sortie d'Article</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="../CSS/style.css" />
    <link rel="stylesheet" href="../CSS/styleListes.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/selectWithSearch.css" />
    <style>
        .article-row {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        .actions {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .add-icon {
            font-size: 35px;
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
        <h2>Sortie d'Article</h2>
        <div id="message" style="display:none;"></div>
        <form id="sortieForm">
            <div class="form-grid">
                <div class="input-group">
                    <i class="fas fa-user icon-left"></i>
                    <select name="destinataire" id="destinataire">
                        <option value="">-- destinataire --</option>
                    </select>
                </div>
                <div class="input-group">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="date_sortie" id="date_sortie" value="<?php echo date('Y-m-d'); ?>" />
                </div>
            </div>

            <div class="article-row">
                <div class="input-group input-group-full">
                    <i class="fas fa-tag icon-left"></i>
                    <select name="nom" id="nom">
                        <option value="">-- Nom d'article --</option>
                    </select>
                </div>
                <div class="input-group input-group-full">
                    <i class="fas fa-box-open"></i>
                    <input type="number" name="quantite_sortie" id="quantite_sortie" placeholder="Quantité sortie" min="1" />
                </div>
                <i class="fas fa-plus-circle add-icon" onclick="ajouterArticle()" title="Ajouter une sortie"></i>
            </div>

            <table id="tableArticles" style="display:none;">
                <thead>
                    <tr>
                        <th>Destinataire</th>
                        <th>Date</th>
                        <th>Nom d'article</th>
                        <th>Quantité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <button type="submit" class="button">Valider sortie et générer facture</button>
        </form>
    </div>
    <script src="../JS/messageError&success.js"></script>
    <script src="../JS/Sorties.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialiser Select2 pour les champs de sélection
            $('#destinataire').select2({
                placeholder: " destinataire ",
            });
            $('#nom').select2({
                placeholder: " Nom d'article ",
            });
        });
    </script>
</body>

</html>