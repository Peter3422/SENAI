<?php
require_once '../config/database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM products ORDER BY name");
$products = $stmt->fetchAll();

$stmt = $pdo->query("SELECT sm.*, p.code, p.name FROM stock_movements sm JOIN products p ON sm.product_id = p.id ORDER BY sm.movement_date DESC");
$movements = $stmt->fetchAll();

include '../templates/header.php';
?>

<h2>Relatório de Estoque</h2>

<h3>Status Atual do Estoque</h3>
<table class="table table-bordered table-striped mb-4">
  <thead class="table-primary">
    <tr>
      <th>Código</th>
      <th>Nome</th>
      <th>Quantidade em Estoque</th>
      <th>Localização</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($products) === 0): ?>
      <tr><td colspan="4" class="text-center">Nenhum produto cadastrado.</td></tr>
    <?php else: ?>
      <?php foreach ($products as $p): ?>
        <tr>
          <td><?= htmlspecialchars($p['code']) ?></td>
          <td><?= htmlspecialchars($p['name']) ?></td>
          <td><?= (int)$p['quantity'] ?></td>
          <td><?= htmlspecialchars($p['location']) ?></td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>

<h3>Histórico de Movimentações</h3>
<table class="table table-bordered table-striped">
  <thead class="table-secondary">
    <tr>
      <th>Data</th>
      <th>Produto</th>
      <th>Tipo</th>
      <th>Quantidade</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($movements) === 0): ?>
      <tr><td colspan="4" class="text-center">Nenhuma movimentação registrada.</td></tr>
    <?php else: ?>
      <?php foreach ($movements as $m): ?>
        <tr>
          <td><?= date('d/m/Y H:i', strtotime($m['movement_date'])) ?></td>
          <td><?= htmlspecialchars($m['code'] . ' - ' . $m['name']) ?></td>
          <td><?= $m['type'] === 'IN' ? 'Entrada' : 'Saída' ?></td>
          <td><?= (int)$m['quantity'] ?></td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>

<?php include '../templates/footer.php'; ?>
