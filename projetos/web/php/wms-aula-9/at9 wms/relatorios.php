<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Aulas por professor
$stmt_prof_aulas = $pdo->query("
  SELECT p.nome, COUNT(da.id_distribuicao) AS total_aulas, SUM(d.duracao_aula) AS carga_horaria
  FROM distribuicao_aulas da
  INNER JOIN professores p ON da.id_professor = p.id_professor
  INNER JOIN disciplinas d ON da.id_disciplina = d.id_disciplina
  GROUP BY p.id_professor
  ORDER BY p.nome
");
$aulas_por_professor = $stmt_prof_aulas->fetchAll(PDO::FETCH_ASSOC);

// Aulas por disciplina
$stmt_disp_aulas = $pdo->query("
  SELECT d.nome, COUNT(da.id_distribuicao) AS total_aulas
  FROM distribuicao_aulas da
  INNER JOIN disciplinas d ON da.id_disciplina = d.id_disciplina
  GROUP BY d.id_disciplina
  ORDER BY d.nome
");
$aulas_por_disciplina = $stmt_disp_aulas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Relatórios</title>
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
  <h2>Relatórios</h2>

  <h4>Aulas por Professor</h4>
  <?php if (!$aulas_por_professor): ?>
    <p>Nenhuma aula distribuída para gerar este relatório.</p>
  <?php else: ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Professor</th>
          <th>Total de Aulas</th>
          <th>Carga Horária (horas)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($aulas_por_professor as $row): ?>
          <tr>
            <td><?= htmlspecialchars($row['nome']) ?></td>
            <td><?= $row['total_aulas'] ?></td>
            <td><?= $row['carga_horaria'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <h4 class="mt-4">Aulas por Disciplina</h4>
  <?php if (!$aulas_por_disciplina): ?>
    <p>Nenhuma aula distribuída para gerar este relatório.</p>
  <?php else: ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Disciplina</th>
          <th>Total de Aulas</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($aulas_por_disciplina as $row): ?>
          <tr>
            <td><?= htmlspecialchars($row['nome']) ?></td>
            <td><?= $row['total_aulas'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
