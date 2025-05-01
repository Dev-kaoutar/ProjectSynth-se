<?php
include '../DB/Config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées par le formulaire
    $id_fournisseur = $_POST['id_fournisseur'];
    $nom_fournisseur = $_POST['nom_fournisseur'];
    $raison_social = $_POST['raison_social'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $date_inscription = $_POST['date_inscription']; // Added date_inscription

    try {
        // Préparer la requête SQL pour mettre à jour les informations du fournisseur
        $sql = "UPDATE Fournisseur SET nom_fournisseur = :nom_fournisseur, raison_social = :raison_social, telephone = :telephone, email = :email, adresse = :adresse, ville = :ville, date_inscription = :date_inscription WHERE id_fournisseur = :id_fournisseur";
        $stmt = $pdo->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(':id_fournisseur', $id_fournisseur);
        $stmt->bindParam(':nom_fournisseur', $nom_fournisseur);
        $stmt->bindParam(':raison_social', $raison_social);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':date_inscription', $date_inscription); // Added binding for date_inscription
        
        // Exécuter la requête
        $stmt->execute();

        if ($stmt->execute()) {
            $message = " Fournisseur mis à jour avec succès.";
            echo "<script>setTimeout(function(){ window.location.href = '../FrontEnd/Suppliers.php'; }, 2000);</script>";
        } else {
            $message = " Erreur lors de la mise à jour du fournisseur.";
        }
    } catch (PDOException $e) {
        // Gérer les erreurs
        echo "<script>alert('Erreur : " . $e->getMessage() . "');</script>";
    }
}

// Récupérer les données du fournisseur existant pour afficher dans le formulaire
$id_fournisseur = $_GET['id']; // Utiliser l'ID du fournisseur dynamique si nécessaire
$sql = "SELECT * FROM Fournisseur WHERE id_fournisseur = :id_fournisseur";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_fournisseur', $id_fournisseur);
$stmt->execute();
$fournisseur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$fournisseur) {
    echo "<script>alert('Aucun fournisseur trouvé.');</script>";
    exit;
}
?>
