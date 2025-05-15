<?php
include '../DB/Config.php'; 
include '../BackEnd/connexion.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion - Gestion de Stock</title>
    <link rel="stylesheet" href="../css/ConnexionStyle.css" />
    <style>
        .alert {
            padding: 15px;
            margin: 15px auto;
            width: 90%;
            border-left: 5px solid;
            border-radius: 5px;
            font-weight: bold;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #842029;
            border-left-color: #dc3545;
        }
    </style>
</head>
<body>

<div class="login-card">
    <img src="../pics/logo.png" alt="Logo" class="logo" title="Accueil" />
    <h2>Gestion de Stock</h2>
    <h3>Connexion</h3>

    <!-- Affichage des alertes -->
    <?php if (!empty($erreur)) : ?>
        <div class="alert alert-error"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>

    <form action="connexion.php" method="POST">
        <div class="form-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="E-mail" required />
        </div>
        <div class="form-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="motdepasse" placeholder="Mot de passe" required />
        </div>
        <button type="submit" class="btn-login">Se connecter</button>
    </form>
    
</div>

</body>
</html>
