<?php
// include '../DB/Config.php'; // Inclure la configuration de la base de données
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $raison_sociale = $_POST['raison_sociale'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $date_inscription = $_POST['date_inscription'];

    // Requête d'insertion
    $sql = "INSERT INTO Fournisseur (nom_fournisseur, raison_social, telephone, email,  adresse, ville, date_inscription)
            VALUES (:nom, :raison_sociale, :telephone, :email,  :adresse, :ville, :date_inscription)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':raison_sociale', $raison_sociale);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':date_inscription', $date_inscription);

    if ($stmt->execute()) {
        $message = " Client ajouté avec succès.";
        echo "<script>setTimeout(function(){ window.location.href = '../FrontEnd/Suppliers.php'; }, 2000);</script>";
    } else {
        $message = " Erreur lors de l'ajout du client.";
    }
}
?>
