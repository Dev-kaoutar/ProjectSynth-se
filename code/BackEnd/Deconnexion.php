<?php
session_start();

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

header("Location: ../FrontEnd/Connexion.php");
exit;

?>
