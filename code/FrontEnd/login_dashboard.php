<?php
session_start();
require_once '../DB/config.php'; // Assurez-vous que ce fichier contient la configuration de la base de données
$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

$stmt = $pdo->prepare("SELECT * FROM admin_access WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user["password_hash"])) {
    $_SESSION["acces_dashboard"] = true;
    echo "success";
} else {
    echo "fail";
}
?>
