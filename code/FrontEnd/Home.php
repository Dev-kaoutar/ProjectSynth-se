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
  <link rel="stylesheet" href="../css/mainStyle.css" />
  <link rel="stylesheet" href="../css/HomeStyle.css">
</head>

<body>
  <header>
    <div class="logo-container">
      <a href="../FrontEnd/Home.html" class="logo-container">
        <img src="../pics/logo.png" alt="Logo" class="logo" title="Accueil" />
        <h3 title="Accueil ">Gestion de Stock</h3>
      </a>
    </div>
    <div id="signOut" title="Déconnexion">
      <span class="material-icons icon">power_settings_new</span>
    </div>
  </header>

  <main>
    <div class="grid-container">
      <a href="../FrontEnd/Stock.html" title="Stock">
        <div class="card" id="inventory" title="Stock">
          <i class="fas fa-list"></i>
        </div>
      </a>
      <a href="../FrontEnd/Entry.html" title="Entrées">
        <div class="card" id="entry" title="Entrées">
          <i class="fas fa-download"></i>
        </div>
      </a>
      <a href="../FrontEnd/Exit.html" title="Sorties">
        <div class="card" id="exit" title="Sorties">
          <i class="fas fa-upload"></i>
        </div>
      </a>
      <a href="../FrontEnd/Clients.html" title="Clients">
        <div class="card" id="clients" title="Clients">
          <i class="fas fa-user-friends"></i>
        </div>
      </a>
      <a href="../FrontEnd/Suppliers.html" title="Fournisseurs">
        <div class="card" id="suppliers" title="Fournisseurs">
          <i class="fas fa-user-tie"></i>
        </div>
      </a>
      <a href="../FrontEnd/Finance.html" title="Finances">
        <div class="card" id="finance" title="Finances">
          <i class="fas fa-dollar-sign"></i>
        </div>
      </a>
    </div>
    </div>
  </main>
</body>

</html>