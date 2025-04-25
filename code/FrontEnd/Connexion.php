<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion - Gestion de Stock</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet" />
  <link rel="stylesheet" href="../css/ConnexionStyle.css">

</head>

<body>


  <div class="login-card">

    <img src="../pics/logo.png" alt="Logo" class="logo" title="Accueil" />
    <h2 title="Accuiel">Gestion de Stock</h2>
    <h3>Connexion</h3>

    <form action="connexion.php" method="POST">
      <div class="form-group">
        <i class="fas fa-envelope"></i>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="E-mail"
          required />
      </div>
      <div class="form-group">
        <i class="fas fa-lock"></i>
        <input
          type="password"
          id="motdepasse"
          name="motdepasse"
          placeholder="Mot de passe"
          required />
      </div>
      <button type="submit" class="btn-login">Se connecter</button>
    </form>

    <!-- Lien vers la page de création de compte -->
    <div class="create-account">
      <p>
        Vous n'avez pas de compte ?
        <a href="inscription.php">Créer un compte</a>
      </p>
    </div>
  </div>
</body>

</html>