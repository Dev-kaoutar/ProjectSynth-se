<?php
include '../DB/Config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

        $stmt = $pdo->prepare("DELETE FROM Client WHERE id_client = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirection avec succès
        header("Location: ../FrontEnd/Clients.php");
        exit();
 
} else {
    // Redirection vers la liste si l'ID n'est pas fourni
    header("Location: ../FrontEnd/Clients.php");
    exit();
}
