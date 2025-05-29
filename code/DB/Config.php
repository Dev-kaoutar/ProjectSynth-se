<?php
$host = '127.0.0.1';
$dbname = 'GDS';
$username = 'root';
$password = '';

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Afficher les erreurs SQL en mode Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur, afficher le message
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
