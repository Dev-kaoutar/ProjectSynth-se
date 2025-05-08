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
                    <i class="fas fa-user"></i>
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
                    <i class="fas fa-tag"></i>
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

            <button type="submit" class="button">Valider la sortie</button>
        </form>
    </div>
    <script src="../JS/messageError&success.js"></script>
    <script src="../JS/Sorties.js"></script>
</body>

</html>