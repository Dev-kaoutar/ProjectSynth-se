<?php
// Connexion à la base de données
require_once '../DB/Config.php';

$message = '';
$erreur = '';

// Vérification de la méthode de la requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categorie = trim($_POST['categorie']);
    $reference = trim($_POST['reference']);
    $nom = trim($_POST['nom']);
    $marque = trim($_POST['marque']);
    $prix_unitaire = floatval($_POST['prix_unitaire']);
    $description = trim($_POST['description']);
    $seuil_minimum = $_POST['seuil_minimum'];

    // Validation des champs
    if (empty($categorie) || empty($reference) || empty($nom) || empty($marque) || $prix_unitaire <= 0) {
        $erreur = "Veuillez remplir tous les champs obligatoires avec des valeurs valides.";
    } else {
        // Vérifier si la référence existe déjà
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Article WHERE reference = ?");
        $stmt->execute([$reference]);
        if ($stmt->fetchColumn() > 0) {
            $erreur = "La référence existe déjà. Veuillez en choisir une autre.";
        } else {
            try {
                $marge = 0.20;
                $prix_vente = round($prix_unitaire * (1 + $marge), 2);

                // Préparation de la requête pour insérer l'article
                $stmt = $pdo->prepare("INSERT INTO Article (categorie, reference, designation, marque, prix_achat, description, prix_vente, quantite_stock, seuil_minimum) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$categorie, $reference, $nom, $marque, $prix_unitaire, $description, $prix_vente, 0, $seuil_minimum ?? 10]);
                $message = "Article ajouté avec succès.";
            } catch (PDOException $e) {
                $erreur = "Erreur : " . $e->getMessage();
            }
        }
    }
}
