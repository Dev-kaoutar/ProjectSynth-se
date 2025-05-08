<?php
include '../DB/Config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM Fournisseur WHERE id_fournisseur = ?");
    $stmt->execute([$id]);

    // Redirection vers la liste après suppression
    header("Location: ../FrontEnd/Suppliers.php");
    exit;
}else {
    // Redirection vers la liste si l'ID n'est pas fourni
    header("Location: ../FrontEnd/Suppliers.php");
    exit;
}

