<?php
include '../DB/Config.php';

// Statistiques générales
$nb_articles = $pdo->query("SELECT COUNT(*) FROM Article")->fetchColumn();
$quantite_totale = $pdo->query("SELECT SUM(quantite_stock) FROM Article")->fetchColumn();
$nb_clients = $pdo->query("SELECT COUNT(*) FROM Client")->fetchColumn();
$nb_fournisseurs = $pdo->query("SELECT COUNT(*) FROM Fournisseur")->fetchColumn();

// Articles en stock faible
$articles_alertes = $pdo->query("
    SELECT designation, quantite_stock, seuil_minimum
    FROM Article
    WHERE quantite_stock <= seuil_minimum
")->fetchAll();

// Dernières entrées
$dernieres_entrees = $pdo->query("
    SELECT e.date_entree, f.nom_fournisseur AS fournisseur
    FROM EntreeStock e
    JOIN Fournisseur f ON e.id_fournisseur = f.id_fournisseur
    ORDER BY e.date_entree DESC
    LIMIT 4
")->fetchAll();

// Dernières sorties
$dernieres_sorties = $pdo->query("
    SELECT s.date_sortie, c.nom_client AS client
    FROM SortieStock s
    JOIN Client c ON s.id_client = c.id_client
    ORDER BY s.date_sortie DESC
    LIMIT 4
")->fetchAll();

// Articles les plus sortis
$articles_sortis = $pdo->query("
    SELECT a.designation, SUM(ls.quantite) AS total_sortie
    FROM LigneSortieStock ls
    JOIN Article a ON ls.id_article = a.id_article
    GROUP BY ls.id_article
    ORDER BY total_sortie DESC
    LIMIT 5
")->fetchAll();

$labels = [];
$valeurs = [];
foreach ($articles_sortis as $article) {
    $labels[] = $article['designation'];
    $valeurs[] = $article['total_sortie'];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: #f4f6f9;
        }

        header {
            background: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            padding: 30px;
            max-width: 1200px;
            margin: 50px auto;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .stats {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .stat-box {
            flex: 1;
            min-width: 220px;
            background: #e9f0fa;
            border-left: 6px solid #007bff;
            padding: 15px;
            border-radius: 10px;
        }

        .grid-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .item-card {
            background: #fafafa;
            border-left: 5px solid #007bff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
        }

        .alert .item-card {
            border-left-color: #dc3545;
            background-color: #fff0f0;
        }

        h2,
        h3 {
            margin-top: 0;
        }

        canvas {
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .stats {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>



    <?php include '../FrontEnd/Header.php'; ?>

    <div class="container">
        <h2>📊 Tableau de Bord - Gestion de Stock</h2>

        <!-- Articles en stock faible -->
        <?php if (count($articles_alertes) > 0): ?>
            <div class="card alert">
                <h3>⚠️ Articles en stock faible</h3>
                <div class="grid-cards">
                    <?php foreach ($articles_alertes as $a): ?>
                        <div class="item-card">
                            <strong><?= htmlspecialchars($a['designation']) ?></strong><br>
                            Stock : <span style="color: red;"><?= $a['quantite_stock'] ?></span><br>
                            Seuil minimum : <?= $a['seuil_minimum'] ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Statistiques -->
        <div class="stats">
            <div class="stat-box">🧾 <strong><?= $nb_articles ?></strong> articles</div>
            <div class="stat-box">📦 <strong><?= $quantite_totale ?></strong> en stock</div>
            <div class="stat-box">👥 <strong><?= $nb_clients ?></strong> clients</div>
            <div class="stat-box">🏢 <strong><?= $nb_fournisseurs ?></strong> fournisseurs</div>
        </div>

        <!-- Dernières entrées -->
        <div class="card">
            <h3>🛒 Dernières entrées</h3>
            <div class="grid-cards">
                <?php foreach ($dernieres_entrees as $e): ?>
                    <div class="item-card">
                        <strong>Date :</strong> <?= $e['date_entree'] ?><br>
                        <strong>Fournisseur :</strong> <?= htmlspecialchars($e['fournisseur']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Dernières sorties -->
        <div class="card">
            <h3>🚚 Dernières sorties</h3>
            <div class="grid-cards">
                <?php foreach ($dernieres_sorties as $s): ?>
                    <div class="item-card">
                        <strong>Date :</strong> <?= $s['date_sortie'] ?><br>
                        <strong>Client :</strong> <?= htmlspecialchars($s['client']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Graphique -->
        <div class="card">
            <h3>📊 Top 5 des articles les plus sortis</h3>
            <canvas id="barChart"></canvas>
        </div>

    </div>

    <script>
        const ctx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Quantité sortie',
                    data: <?= json_encode($valeurs) ?>,
                    backgroundColor: 'rgba(0, 123, 255, 0.6)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1,
                    borderRadius: 8
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantité'
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>