<?php
require_once '../config/database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$search = $_GET['search'] ?? '';

$query = "SELECT * FROM products";
$params = [];

if ($search) {
    $query .= " WHERE code LIKE ? OR name LIKE ? OR description LIKE ? OR location LIKE ?";
    $like = "%$search%";
    $params = [$like, $like, $like, $like];
}
$query .= " ORDER BY name";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll();

include '../templates/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>Produtos</h2>
  <a href="add.php" class="btn btn-success">Novo Produto</a>
</div>

<form method="get" class="mb-3">
  <div class="input-group">
    <input type="text" name="search" class="form-control bg-dark text-light" placeholder="Buscar produtos..." value="<?= htmlspecialchars($search) ?>">
    <button class="btn btn-outline-light" type="submit">Buscar</button>
  </div>
</form>

<table class="table table-dark table-striped table-hover">
  <thead class="table-dark">
    <tr>
      <th>Código</th>
      <th>Nome</th>
      <th>Descrição</th>
      <th>Quantidade</th>
      <th>Preço Compra</th>
      <th>Preço Venda</th>
      <th>Localização</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($products) === 0): ?>
      <tr><td colspan="8" class="text-center">Nenhum produto encontrado.</td></tr>
    <?php else: ?>
      <?php foreach ($products as $p): ?>
        <tr>
          <td><?= htmlspecialchars($p['code']) ?></td>
          <td><?= htmlspecialchars($p['name']) ?></td>
          <td><?= htmlspecialchars($p['description']) ?></td>
          <td><?= (int)$p['quantity'] ?></td>
          <td>R$ <?= number_format($p['purchase_price'], 2, ',', '.') ?></td>
          <td>R$ <?= number_format($p['sale_price'], 2, ',', '.') ?></td>
          <td><?= htmlspecialchars($p['location']) ?></td>
          <td>
            <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="delete.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>

<?php include '../templates/footer.php'; ?>
