<?php
include '../DB/Config.php';

if (!isset($_GET['id'])) {
    echo "ID de la sortie non spécifié.";
    exit;
}

$id = $_GET['id'];

$sql = "SELECT ss.date_sortie, a.designation, lss.quantite, a.prix_vente 
        FROM SortieStock ss
        JOIN LigneSortieStock lss ON ss.id_sortie = lss.id_sortie
        JOIN Article a ON lss.id_article = a.id_article
        WHERE ss.id_sortie = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$details = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détails de la sortie</title>
    <link rel="stylesheet" href="../css/styleInfoRH.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include '../FrontEnd/Header.php'; ?>
    <div class="form-container">
        <a href="../FrontEnd/SortiesParClient.php"><i class="fas fa-arrow-left" style="color: #1793d5;"></i></a>
        <h3><i class="fas fa-info-circle"></i> Détails de la sortie n°<?= htmlspecialchars($id) ?></h3>

        <table class="produits-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire (DH)</th>
                    <th>Prix total (DH)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $somme = 0;
                if (!empty($details)) :
                    foreach ($details as $item) :
                        $total = $item['prix_vente'] * $item['quantite'];
                        $somme += $total;
                ?>
                        <tr>
                            <td><?= htmlspecialchars($item['designation']) ?></td>
                            <td><?= $item['quantite'] ?></td>
                            <td><?= number_format($item['prix_vente'], 2) ?> DH</td>
                            <td><?= number_format($total, 2) ?> DH</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" style="text-align:right;"><strong>Total Général :</strong></td>
                        <td><strong><?= number_format($somme, 2) ?> DH</strong></td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Aucun détail trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
