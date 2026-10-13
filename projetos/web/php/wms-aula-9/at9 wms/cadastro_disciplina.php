<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $codigo = trim($_POST['codigo'] ?? '');
    $duracao_aula = intval($_POST['duracao_aula'] ?? 0);
    $descricao = trim($_POST['descricao'] ?? '');
    $aulas_semanais = intval($_POST['aulas_semanais'] ?? 0);

    if ($nome && $codigo && $duracao_aula > 0 && $aulas_semanais > 0) {
        $stmt = $pdo->prepare("SELECT id_disciplina FROM disciplinas WHERE codigo = ?");
        $stmt->execute([$codigo]);
        if ($stmt->fetch()) {
            $error = "Código da disciplina já existe.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO disciplinas (nome, codigo, duracao_aula, descricao, aulas_semanais) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $codigo, $duracao_aula, $descricao, $aulas_semanais]);
            $success = "Disciplina cadastrada com sucesso!";
        }
    } else {
        $error = "Preencha todos os campos obrigatórios corretamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro de Disciplinas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">Sistema WMS</a>
    <a href="logout.php" class="btn btn-outline-primary btn-sm">Sair</a>
  </div>
</nav>

<div class="container mt-4">
  <h2>Cadastro de Disciplinas</h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <form method="POST" class="mt-3">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome da Disciplina</label>
      <input type="text" class="form-control" id="nome" name="nome" required />
    </div>
    <div class="mb-3">
      <label for="codigo" class="form-label">Código da Disciplina</label>
      <input type="text" class="form-control" id="codigo" name="codigo" required />
    </div>
    <div class="mb-3">
      <label for="duracao_aula" class="form-label">Duração da Aula (horas)</label>
      <input type="number" class="form-control" id="duracao_aula" name="duracao_aula" min="1" required />
    </div>
    <div class="mb-3">
      <label for="aulas_semanais" class="form-label">Número de Aulas Semanais</label>
      <input type="number" class="form-control" id="aulas_semanais" name="aulas_semanais" min="1" required />
    </div>
    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição (opcional)</label>
      <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar Disciplina</button>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
