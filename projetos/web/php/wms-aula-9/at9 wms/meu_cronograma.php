<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'professor' || !isset($_SESSION['professor_id'])) {
    header('Location: login.php');
    exit;
}

$id_professor = $_SESSION['professor_id'];


if (empty($id_professor)) {
    $aulas = []; // Nenhuma aula para mostrar se o professor não está vinculado
    $warning = "Seu usuário não está vinculado a um professor específico. Entre em contato com o administrador.";
} else {
    $stmt = $pdo->prepare("
      SELECT da.data_aula, da.horario_inicio, da.horario_fim, d.nome AS disciplina, p.nome as professor_nome
      FROM distribuicao_aulas da
      INNER JOIN disciplinas d ON da.id_disciplina = d.id_disciplina
      INNER JOIN professores p ON da.id_professor = p.id_professor
      WHERE da.id_professor = ?
      ORDER BY da.data_aula, da.horario_inicio
    ");
    $stmt->execute([$id_professor]);
    $aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Meu Cronograma</title>
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
  <h2>Meu Cronograma de Aulas</h2>

  <?php if (isset($warning)): ?>
    <div class="alert alert-warning"><?= htmlspecialchars($warning) ?></div>
  <?php endif; ?>

  <?php if (!$aulas): ?>
    <p>Nenhuma aula atribuída a você.</p>
  <?php else: ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Data</th>
          <th>Início</th>
          <th>Fim</th>
          <th>Disciplina</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($aulas as $aula): ?>
          <tr>
            <td><?= htmlspecialchars($aula['data_aula']) ?></td>
            <td><?= htmlspecialchars(substr($aula['horario_inicio'], 0, 5)) ?></td>
            <td><?= htmlspecialchars(substr($aula['horario_fim'], 0, 5)) ?></td>
            <td><?= htmlspecialchars($aula['disciplina']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
