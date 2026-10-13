<?php
require_once '../config/database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = (int)($_POST['product_id'] ?? 0);
    $type = $_POST['type'] ?? '';
    $quantity = (int)($_POST['quantity'] ?? 0);

    if (!$product_id) $errors[] = 'Produto é obrigatório.';
    if (!in_array($type, ['IN', 'OUT'])) $errors[] = 'Tipo inválido.';
    if ($quantity <= 0) $errors[] = 'Quantidade deve ser maior que zero.';

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT quantity FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        if (!$product) {
            $errors[] = 'Produto não encontrado.';
        } else {
            $new_quantity = $type === 'IN' ? $product['quantity'] + $quantity : $product['quantity'] - $quantity;
            if ($new_quantity < 0) {
                $errors[] = 'Quantidade insuficiente no estoque para saída.';
            } else {
                $pdo->beginTransaction();
                try {
                    $stmt = $pdo->prepare("UPDATE products SET quantity = ? WHERE id = ?");
                    $stmt->execute([$new_quantity, $product_id]);

                    $stmt = $pdo->prepare("INSERT INTO stock_movements (product_id, type, quantity) VALUES (?, ?, ?)");
                    $stmt->execute([$product_id, $type, $quantity]);

                    $pdo->commit();
                    header('Location: movements.php');
                    exit;
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $errors[] = 'Erro ao registrar movimentação: ' . $e->getMessage();
                }
            }
        }
    }
}

$stmt = $pdo->query("SELECT id, code, name FROM products ORDER BY name");
$products = $stmt->fetchAll();

$stmt = $pdo->query("SELECT sm.*, p.code, p.name FROM stock_movements sm JOIN products p ON sm.product_id = p.id ORDER BY sm.movement_date DESC LIMIT 20");
$movements = $stmt->fetchAll();

include '../templates/header.php';
?>

<h2>Movimentações de Estoque</h2>

<?php if ($errors): ?>
  <div class="alert alert-danger">
    <ul>
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="post" class="row g-3 mb-4">
  <div class="col-md-4">
    <label for="product_id" class="form-label">Produto</label>
    <select name="product_id" id="product_id" class="form-select" required>
      <option value="">Selecione...</option>
      <?php foreach ($products as $p): ?>
        <option value="<?= $p['id'] ?>" <?= (isset($_POST['product_id']) && $_POST['product_id'] == $p['id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($p['code'] . ' - ' . $p['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-2">
    <label for="type" class="form-label">Tipo</label>
    <select name="type" id="type" class="form-select" required>
      <option value="IN" <?= (isset($_POST['type']) && $_POST['type'] == 'IN') ? 'selected' : '' ?>>Entrada</option>
      <option value="OUT" <?= (isset($_POST['type']) && $_POST['type'] == 'OUT') ? 'selected' : '' ?>>Saída</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="quantity" class="form-label">Quantidade</label>
    <input type="number" name="quantity" id="quantity" class="form-control" min="1" required value="<?= htmlspecialchars($_POST['quantity'] ?? '') ?>">
  </div>
  <div class="col-md-4 d-flex align-items-end">
    <button type="submit" class="btn btn-primary w-100">Registrar Movimentação</button>
  </div>
</form>

<h3>Últimas Movimentações</h3>
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
