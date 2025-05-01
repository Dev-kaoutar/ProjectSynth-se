<?php
include '../DB/Config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées par le formulaire
    $id_client = $_POST['id_client'];
    $nom_client = $_POST['nom_client'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $date_inscription = $_POST['date_inscription']; // Added date_inscription

    try {
        // Préparer la requête SQL pour mettre à jour les informations du client
        $sql = "UPDATE Client SET nom_client = :nom_client, email = :email, telephone = :telephone, adresse = :adresse, ville = :ville, date_inscription = :date_inscription WHERE id_client = :id_client";
        $stmt = $pdo->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(':id_client', $id_client);
        $stmt->bindParam(':nom_client', $nom_client);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':date_inscription', $date_inscription); // Added binding for date_inscription

        // Exécuter la requête
        $stmt->execute();

        // Retourner un message de succès
        if ($stmt->execute()) {
            $message = " Client ajouté avec succès.";
            echo "<script>setTimeout(function(){ window.location.href = '../FrontEnd/Clients.php'; }, 2000);</script>";
        } else {
            $message = " Erreur lors de la mise à jour du client.";
        }    } catch (PDOException $e) {
        // Gérer les erreurs
        echo "<script>alert('Erreur : " . $e->getMessage() . "');</script>";
    }
}

// Récupérer les données du client existant pour afficher dans le formulaire
$id_client = $_GET['id']; // Utiliser l'ID du client dynamique si nécessaire
$sql = "SELECT * FROM Client WHERE id_client = :id_client";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_client', $id_client);
$stmt->execute();
$client = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$client) {
    echo "<script>alert('Aucun client trouvé.');</script>";
    exit;
}
