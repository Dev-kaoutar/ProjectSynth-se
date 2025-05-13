<?php
session_start();
include('../DB/config.php');

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $motdepasse = $_POST["motdepasse"];

    try {
        if (!isset($pdo)) {
            throw new Exception("Erreur de connexion à la base de données.");
        }

        // Recherche l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM User WHERE email = :email");
        $stmt->execute(["email" => $email]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur && password_verify($motdepasse, $utilisateur["mot_de_passe"])) {
            // Connexion réussie
            $_SESSION["id_user"] = $utilisateur["id_user"];
            $_SESSION["nom_complet"] = $utilisateur["nom_complet"];
            header("Location: ../FrontEnd/Home.php");
            exit;
        } else {
            $erreur = "Email ou mot de passe incorrect.";
        }
    } catch (Exception $e) {
        $erreur = "Erreur : " . $e->getMessage();
    }
}
?>