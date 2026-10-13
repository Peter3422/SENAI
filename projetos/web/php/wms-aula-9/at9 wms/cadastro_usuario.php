<?php
session_start();
require 'db.php';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $tipo = $_POST['tipo'] ?? 'professor';

    if ($username && $senha && in_array($tipo, ['admin', 'professor'])) {
        $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = "Usuário já existe.";
        } else {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (username, senha_hash, tipo) VALUES (?, ?, ?)");
            $stmt->execute([$username, $senha_hash, $tipo]);
            $success = "Cadastro realizado com sucesso! Você pode fazer login.";
        }
    } else {
        $error = "Preencha todos os campos corretamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro de Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
  <form method="POST" class="p-4 bg-body-tertiary rounded" style="width: 320px;">
    <h3 class="mb-3 text-center">Cadastro de Usuário</h3>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <div class="mb-3">
      <label for="username" class="form-label">Usuário</label>
      <input type="text" class="form-control" id="username" name="username" required autofocus />
    </div>
    <div class="mb-3">
      <label for="senha" class="form-label">Senha</label>
      <input type="password" class="form-control" id="senha" name="senha" required />
    </div>
    <div class="mb-3">
      <label for="tipo" class="form-label">Tipo de Usuário</label>
      <select class="form-select" id="tipo" name="tipo" required>
        <option value="professor" selected>Professor</option>
        <option value="admin">Administrador</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
    <p class="mt-3 text-center">
      Já tem conta? <a href="login.php" class="text-info">Entrar</a>
    </p>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
