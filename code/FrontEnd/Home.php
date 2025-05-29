<?php
session_start();
if (!isset($_SESSION['id_user'])) {
  header('location: Connexion.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestion de Stock</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet" />
  <link rel="stylesheet" href="../css/HomeStyle.css">
  <style>
    .modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 999;
    }

    .modal-content {
      background: white;
      padding: 50px;
      border-radius: 12px;
      width: 300px;
      text-align: center;
    }
  </style>
</head>

<body>
  <header>
    <div class="logo-container">
      <a href="../FrontEnd/Home.php" class="logo-container">
        <img src="../pics/logo.png" alt="Logo" class="logo" title="Accueil" />
        <h3 title="Accueil ">Gestion de Stock</h3>
      </a>
    </div>
    <div id="signOut" title="Déconnexion" onclick="window.location.href='../BackEnd/Deconnexion.php'">
      <span class="material-icons icon">power_settings_new</span>
    </div>
  </header>

  <main>
    <div class="grid-container">
      <a href="../FrontEnd/Stock.php" title="Stock">
        <div class="card" id="inventory" title="Stock">
          <i class="fas fa-list"></i>
        </div>
      </a>
      <a href="../FrontEnd/Entry.php" title="Entrées">
        <div class="card" id="entry" title="Entrées">
          <i class="fas fa-download"></i>
        </div>
      </a>
      <a href="../FrontEnd/Exit.php" title="Sorties">
        <div class="card" id="exit" title="Sorties">
          <i class="fas fa-upload"></i>
        </div>
      </a>
      <a href="../FrontEnd/Clients.php" title="Clients">
        <div class="card" id="clients" title="Clients">
          <i class="fas fa-user-friends"></i>
        </div>
      </a>
      <a href="../FrontEnd/Suppliers.php" title="Fournisseurs">
        <div class="card" id="suppliers" title="Fournisseurs">
          <i class="fas fa-user-tie"></i>
        </div>
      </a>
      <a href="../FrontEnd/Finance.php" title="Finances">
        <div class="card" id="finance" title="Finances">
          <i class="fas fa-dollar-sign"></i>
        </div>
      </a>
      <a href="#" id="btn-dashboard" title="Tableau de Bord">
        <div class="card" id="dashboard" title="Tableau de Bord">
          <i class="fas fa-chart-line"></i>
        </div>
      </a>
    </div>
    <!-- Modale cachée par défaut -->
    <div id="modal-login" class="form-group modal">
      <div class="modal-content">
        <input type="text" id="username" placeholder="Nom d'utilisateur" style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 6px; border: 1px solid #ccc; font-size: 16px;">
        <input type="password" id="password" placeholder="Mot de passe" style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 6px; border: 1px solid #ccc; font-size: 16px;">
        <button id="btn-login" style="width: 100%; padding: 10px; background: #1793d5; color: #fff; border: none; border-radius: 6px; font-size: 16px; cursor: pointer;">Se connecter</button>
        <p id="error-msg" style="color:red; margin-top: 10px;"></p>
      </div>
    </div>
    <script>
      document.getElementById("btn-dashboard").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("modal-login").style.display = "flex";
      });

      document.getElementById("btn-login").addEventListener("click", function() {
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "login_dashboard.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
          if (xhr.status == 200) {
            if (xhr.responseText === "success") {
              window.location.href = "dashboard.php";
            } else {
              document.getElementById("error-msg").innerText = "Identifiants incorrects.";
            }
          }
        };

        xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
      });
    </script>
  </main>
</body>

</html>