<?php
include '../BackEnd/Ajouter_Article.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/styleListes.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

            th,
            td {
                padding: 0px 1px;
            }
        }

        .message {
            text-align: center;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .success {
            color: green;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }

        .error {
            color: red;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
    </style>
    <link rel="stylesheet" href="../CSS/selectWithSearch.css">
</head>

<body>
    <?php include 'header.php' ?>
    <div class="form-container">
        <?php if (!empty($message)): ?>
            <div class="message success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if (!empty($erreur)): ?>
            <div class="message error"><?php echo htmlspecialchars($erreur); ?></div>
        <?php endif; ?>
        <h2>Ajouter Article</h2>
        <form id="formArticles" action="" method="POST">
            <div class="form-grid">

                <div class="input-group input-group-full">
                    <i class="fas fa-list icon-left"></i>
                    <select name="categorie" id="categorie" required>
                        <option value="">-- Catégorie --</option>
                        <option>Ordinateur</option>
                        <option>Smartphone</option>
                        <option>Tablette</option>
                        <option>Accessoire</option>
                        <option>Imprimante</option>
                        <option>Écran</option>
                        <option>Périphérique</option>
                        <option>Stockage</option>
                        <option>Réseau</option>
                        <option>Composant</option>
                        <option>Audio</option>
                        <option>Scanner</option>
                        <option>Logiciel</option>
                        <option>Autre</option>
                    </select>
                </div>

                <div class="input-group input-group-full">
                    <i class="fas fa-barcode"></i>
                    <input type="text" name="reference" placeholder="Référence" required>
                </div>

                <div class="input-group input-group-full">
                    <i class="fas fa-tag"></i>
                    <input type="text" name="nom" placeholder="Nom de l'article" required>
                </div>

                <div class="input-group input-group-full">
                    <i class="fas fa-industry"></i>
                    <input type="text" name="marque" placeholder="Marque" required>
                </div>


                <div class="input-group input-group-full">
                    <i class="fas fa-dollar-sign"></i>
                    <input type="number" name="prix_unitaire" placeholder="Prix unitaire (DH)" step="0.01" min="0" required>
                </div>

                <div class="input-group input-group-full">
                    <i class="fas fa-exclamation-triangle"></i>
                    <input type="number" name="seuil_minimum" placeholder="Seuil minimum" step="0.01" min="0" required>
                </div>

            </div>

            <div class="input-group input-group-full">
                <i class="fas fa-align-left"></i>
                <textarea name="description" placeholder="Description" rows="3" ></textarea>
            </div>

            <button type="submit" class="button">Ajouter article</button>
        </form>
    </div>

</body>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categorie').select2({
            placeholder: " Catégorie "
        });
    });
</script>

</html>