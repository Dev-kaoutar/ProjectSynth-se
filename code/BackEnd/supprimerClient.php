<?php
include '../DB/Config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM Client WHERE id_client = ?");
    $stmt->execute([$id]);

    // Redirection vers la liste après suppression
    header("Location: ../FrontEnd/Clients.php");
    exit;
}
?>
