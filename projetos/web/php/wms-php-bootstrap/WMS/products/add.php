<?php
require_once '../config/database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = trim($_POST['code'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $quantity = (int)($_POST['quantity'] ?? 0);
    $purchase_price = floatval(str_replace(',', '.', $_POST['purchase_price'] ?? 0));
    $sale_price = floatval(str_replace(',', '.', $_POST['sale_price'] ?? 0));
    $location = trim($_POST['location'] ?? '');

    if (!$code) $errors[] = 'Código é obrigatório.';
    if (!$name) $errors[] = 'Nome é obrigatório.';
    if ($quantity < 0) $errors[] = 'Quantidade não pode ser negativa.';
    if ($purchase_price < 0) $errors[] = 'Preço de compra inválido.';
    if ($sale_price < 0) $errors[] = 'Preço de venda inválido.';

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM products WHERE code = ?");
        $stmt->execute([$code]);
        if ($stmt->fetch()) {
            $errors[] = 'Código da peça já existe.';
        } else {
            $stmt = $pdo->prepare("INSERT INTO products (code, name, description, quantity, purchase_price, sale_price, location) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$code, $name, $description, $quantity, $purchase_price, $sale_price, $location]);
            header('Location: index.php');
            exit;
        }
    }
}

include '../templates/header.php';
?>

<h2>Novo Produto</h2>

<?php if ($errors): ?>
  <div class="alert alert-danger">
    <ul>
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="post" novalidate>
  <div class="mb-3">
    <label for="code" class="form-label">Código da Peça *</label>
    <input type="text" class="form-control" id="code" name="code" required value="<?= htmlspecialchars($_POST['code'] ?? '') ?>">
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Nome da Peça *</label>
    <input type="text" class="form-control" id="name" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Descrição</label>
    <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
  </div>
  <div class="mb-3">
    <label for="quantity" class="form-label">Quantidade em Estoque *</label>
    <input type="number" class="form-control" id="quantity" name="quantity" required min="0" value="<?= htmlspecialchars($_POST['quantity'] ?? '0') ?>">
  </div>
  <div class="mb-3">
    <label for="purchase_price" class="form-label">Preço de Compra *</label>
    <input type="text" class="form-control" id="purchase_price" name="purchase_price" required value="<?= htmlspecialchars($_POST['purchase_price'] ?? '') ?>" placeholder="Ex: 10,50">
  </div>
  <div class="mb-3">
    <label for="sale_price" class="form-label">Preço de Venda *</label>
    <input type="text" class="form-control" id="sale_price" name="sale_price" required value="<?= htmlspecialchars($_POST['sale_price'] ?? '') ?>" placeholder="Ex: 15,00">
  </div>
  <div class="mb-3">
    <label for="location" class="form-label">Local no Estoque</label>
    <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($_POST['location'] ?? '') ?>">
  </div>
  <button type="submit" class="btn btn-primary">Salvar</button>
  <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php include '../templates/footer.php'; ?>
