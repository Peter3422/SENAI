<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit; 
}

$userType = $_SESSION['user_type'];
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - Sistema WMS</title>
  <!-- Bootstrap CSS via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sistema WMS</a>
    <div>
      <span class="me-3">Usuário: <?= htmlspecialchars($userType) ?></span>
      <a href="logout.php" class="btn btn-outline-primary btn-sm">Sair</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h1>Bem-vindo ao Dashboard</h1>

  <?php if ($userType === 'admin'): ?>
    <h3>Menu do Administrador</h3>
    <ul class="list-group">
      <li class="list-group-item bg-body-tertiary"><a href="cadastro_professor.php" class="text-info">Cadastrar Professores</a></li>
      <li class="list-group-item bg-body-tertiary"><a href="cadastro_disciplina.php" class="text-info">Cadastrar Disciplinas</a></li>
      <li class="list-group-item bg-body-tertiary"><a href="distribuicao_aulas.php" class="text-info">Distribuir Aulas</a></li>
      <li class="list-group-item bg-body-tertiary"><a href="visualizar_distribuicao.php" class="text-info">Visualizar Distribuição Geral</a></li>
      <li class="list-group-item bg-body-tertiary"><a href="relatorios.php" class="text-info">Relatórios</a></li>
    </ul>
  <?php elseif ($userType === 'professor'): ?>
    <h3>Seu Cronograma de Aulas</h3>
    <ul class="list-group">
      <li class="list-group-item bg-body-tertiary"><a href="meu_cronograma.php" class="text-info">Visualizar meu cronograma</a></li>
    </ul>
  <?php else: ?>
    <p>Tipo de usuário desconhecido.</p>
  <?php endif; ?>
</div>

<!-- Bootstrap JS Bundle via CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
