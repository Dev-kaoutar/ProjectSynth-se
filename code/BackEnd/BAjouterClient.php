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

    // Check for duplicate email or phone number
    $checkSql = "SELECT COUNT(*) FROM Client WHERE email = :email OR telephone = :telephone";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->bindParam(':email', $email);
    $checkStmt->bindParam(':telephone', $telephone);
    $checkStmt->execute();
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        $messageE = "Erreur : Email ou numéro de téléphone déjà utilisé.";
    } else {
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
            $messageE = " Erreur lors de l'ajout du client.";
        }
    }
}
?>
