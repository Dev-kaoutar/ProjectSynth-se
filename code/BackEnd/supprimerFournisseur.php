<?php
include '../DB/Config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("UPDATE Fournisseur SET actif = 0 WHERE id_fournisseur = ?");
    $stmt->execute([$id]);

    // Redirection vers la liste après suppression
    header("Location: ../FrontEnd/Suppliers.php");
    exit;
}

