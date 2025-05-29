<?php
include '../DB/Config.php';

if (!isset($_GET['id'])) {
    echo "ID d'entrée non spécifié.";
    exit;
}

$id = $_GET['id'];

// Récupérer les détails selon l'ID
$sql = "SELECT 
            es.date_entree, 
            a.designation, 
            les.quantite, 
            a.prix_achat
        FROM EntreeStock es
        JOIN LigneEntreeStock les ON es.id_entree = les.id_entree
        JOIN Article a ON les.id_article = a.id_article
        WHERE es.id_entree = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$details = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'entrée n°<?= htmlspecialchars($id) ?></title>
    <link rel="stylesheet" href="../css/styleInfoRH.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include '../FrontEnd/Header.php'; ?>
    <div class="form-container">
        <a href="javascript:history.back()"><i class="fas fa-arrow-left" style="color: #1793d5;"></i></a>
        <h3><i class="fas fa-info-circle"></i> Détails de l'entrée n°<?= htmlspecialchars($id) ?></h3>

        <table class="produits-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix d'achat (DH)</th>
                    <th>Total (DH)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $somme = 0;
                if (!empty($details)) :
                    $date = $details[0]['date_entree'];
                    foreach ($details as $item) :
                        $total = $item['prix_achat'] * $item['quantite'];
                        $somme += $total;
                ?>
                        <tr>
                            <td><?= htmlspecialchars($item['designation']) ?></td>
                            <td><?= htmlspecialchars($item['quantite']) ?></td>
                            <td><?= number_format($item['prix_achat'], 2) ?> DH</td>
                            <td><?= number_format($total, 2) ?> DH</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" style="text-align:right;"><strong>Total Général :</strong></td>
                        <td><strong><?= number_format($somme, 2) ?> DH</strong></td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Aucun détail disponible.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
