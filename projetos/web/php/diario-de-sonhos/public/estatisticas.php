<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../src/config/database.php';

$database = new Database();
$db = $database->getConnection();

// Exemplo simples: Conta sonhos por dia para o gráfico
$stmt = $db->prepare("SELECT data, COUNT(*) as total FROM sonhos WHERE usuario_id = :usuario_id GROUP BY data ORDER BY data ASC");
$stmt->bindParam(':usuario_id', $_SESSION['usuario_id']);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Preparar dados para gráfico
$labels = [];
$totals = [];
foreach ($result as $row) {
    $labels[] = $row['data'];
    $totals[] = (int)$row['total'];
}

include __DIR__ . '/../src/includes/header.php';
?>

<section class="estatisticas-box">
    <h2>Estatísticas de Sonhos</h2>
    <canvas id="chartSonhos" style="max-width: 700px; margin: 0 auto; display: block;"></canvas>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartSonhos').getContext('2d');
    const chartSonhos = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Número de Sonhos por Dia',
                data: <?= json_encode($totals) ?>,
                borderColor: 'rgba(0, 102, 204, 0.8)',
                backgroundColor: 'rgba(0, 102, 204, 0.3)',
                fill: true,
                tension: 0.3,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { 
                    title: { display: true, text: 'Data' } 
                },
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Quantidade' },
                    ticks: { precision:0 }
                }
            }
        }
    });
</script>

<?php include __DIR__ . '/../src/includes/footer.php'; ?>
