<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query("
  SELECT da.id_distribuicao, p.nome AS professor, d.nome AS disciplina, da.data_aula, da.horario_inicio, da.horario_fim
  FROM distribuicao_aulas da
  INNER JOIN professores p ON da.id_professor = p.id_professor
  INNER JOIN disciplinas d ON da.id_disciplina = d.id_disciplina
  ORDER BY da.data_aula, da.horario_inicio, p.nome
");
$distribuicoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Distribuição Geral</title>
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
  <h2>Distribuição de Aulas - Geral</h2>

  <?php if (!$distribuicoes): ?>
    <p>Nenhuma aula distribuída ainda. Use a função 'Distribuir Aulas' no Dashboard.</p>
  <?php else: ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Professor</th>
          <th>Disciplina</th>
          <th>Data</th>
          <th>Início</th>
          <th>Fim</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($distribuicoes as $dist): ?>
          <tr>
            <td><?= htmlspecialchars($dist['professor']) ?></td>
            <td><?= htmlspecialchars($dist['disciplina']) ?></td>
            <td><?= htmlspecialchars($dist['data_aula']) ?></td>
            <td><?= htmlspecialchars(substr($dist['horario_inicio'], 0, 5)) ?></td>
            <td><?= htmlspecialchars(substr($dist['horario_fim'], 0, 5)) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
