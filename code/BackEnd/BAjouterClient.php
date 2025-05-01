<?php
include '../DB/Config.php'; // Active si besoin

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $date_inscription = $_POST['date_inscription'];

    $sql = "INSERT INTO Client (nom_client, email, telephone, adresse, ville, date_inscription)
            VALUES (:nom, :email, :telephone, :adresse, :ville, :date_inscription)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':date_inscription', $date_inscription);

    if ($stmt->execute()) {
        $message = " Client ajouté avec succès.";
        echo "<script>setTimeout(function(){ window.location.href = '../FrontEnd/Clients.php'; }, 2000);</script>";
    } else {
        $message = " Erreur lors de l'ajout du client.";
    }
}
?>
