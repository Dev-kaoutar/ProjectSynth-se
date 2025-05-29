<?php
require_once 'config.php'; // Assurez-vous que ce fichier contient la configuration de la base de données

// Remplace "admin123" par le mot de passe que tu veux utiliser
$hash = password_hash("admin", PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO admin_access (username, password_hash) VALUES (?, ?)");
$stmt->execute(["admin", $hash]);

echo "Admin ajouté avec succès.";
?>
