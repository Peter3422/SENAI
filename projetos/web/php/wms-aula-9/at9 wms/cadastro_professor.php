<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';


$stmt = $pdo->query("SELECT id_disciplina, nome FROM disciplinas ORDER BY nome");
$disciplinas_disponiveis = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $especializacao = trim($_POST['especializacao'] ?? '');
    $disciplinas_selecionadas = $_POST['disciplinas'] ?? [];
    $disponibilidades_post = $_POST['disponibilidade'] ?? [];

    if ($nome && $email) {
        try {
            $pdo->beginTransaction();

            // Inserir professor
            $stmt = $pdo->prepare("INSERT INTO professores (nome, email, telefone, especializacao) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $email, $telefone, $especializacao]);
            $id_professor = $pdo->lastInsertId();


            $stmt_disciplinas = $pdo->prepare("INSERT INTO professor_disciplinas (id_professor, id_disciplina) VALUES (?, ?)");
            foreach ($disciplinas_selecionadas as $id_disciplina) {
                $stmt_disciplinas->execute([$id_professor, $id_disciplina]);
            }

            // Inserir disponibilidade
            $stmt_disponibilidade = $pdo->prepare("INSERT INTO disponibilidade (id_professor, dia_semana, horario_inicio, horario_fim) VALUES (?, ?, ?, ?)");
            foreach ($disponibilidades_post as $disp) {
                if (!empty($disp['dia']) && !empty($disp['inicio']) && !empty($disp['fim'])) {
                    $stmt_disponibilidade->execute([$id_professor, $disp['dia'], $disp['inicio'], $disp['fim']]);
                }
            }

            $pdo->commit();
            $success = "Professor cadastrado com sucesso!";
        } catch (PDOException $e) {
            $pdo->rollBack();
            $error = "Erro ao cadastrar professor: " . $e->getMessage();
            if ($e->getCode() == 23000) { 
                $error = "Email já cadastrado. Por favor, use outro.";
            }
        }
    } else {
        $error = "Nome e email são obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro de Professores</title>
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
  <h2>Cadastro de Professores</h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <form method="POST" class="mt-3">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome do Professor</label>
      <input type="text" class="form-control" id="nome" name="nome" required />
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required />
    </div>
    <div class="mb-3">
      <label for="telefone" class="form-label">Telefone</label>
      <input type="text" class="form-control" id="telefone" name="telefone" />
    </div>
    <div class="mb-3">
      <label for="especializacao" class="form-label">Área de Especialização</label>
      <input type="text" class="form-control" id="especializacao" name="especializacao" />
    </div>

    <div class="mb-3">
      <label class="form-label">Disciplinas que o professor pode ministrar</label>
      <select name="disciplinas[]" class="form-select" multiple size="5" required>
        <?php foreach ($disciplinas_disponiveis as $disciplina): ?>
          <option value="<?= $disciplina['id_disciplina'] ?>"><?= htmlspecialchars($disciplina['nome']) ?></option>
        <?php endforeach; ?>
      </select>
      <small class="form-text">Use Ctrl+Click ou Cmd+Click para selecionar múltiplas disciplinas.</small>
    </div>

    <div class="mb-3">
      <label class="form-label">Disponibilidade (dias e horários)</label>
      <div id="disponibilidade-container">
      </div>
      <button type="button" class="btn btn-secondary" onclick="adicionarDisponibilidade()">Adicionar Disponibilidade</button>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar Professor</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  let dispIndex = 0; 

  function adicionarDisponibilidade() {
    const container = document.getElementById('disponibilidade-container');
    const newRow = document.createElement('div');
    newRow.className = 'row mb-2';
    newRow.innerHTML = `
      <div class="col-4">
        <select name="disponibilidade[${dispIndex}][dia]" class="form-select" required>
          <option value="">Selecione o Dia</option>
          <option value="segunda">Segunda-feira</option>
          <option value="terça">Terça-feira</option>
          <option value="quarta">Quarta-feira</option>
          <option value="quinta">Quinta-feira</option>
          <option value="sexta">Sexta-feira</option>
        </select>
      </div>
      <div class="col-3">
        <input type="time" name="disponibilidade[${dispIndex}][inicio]" class="form-control" required />
      </div>
      <div class="col-3">
        <input type="time" name="disponibilidade[${dispIndex}][fim]" class="form-control" required />
      </div>
      <div class="col-2">
        <button type="button" class="btn btn-danger w-100" onclick="this.closest('.row').remove()">Remover</button>
      </div>
    `;
    container.appendChild(newRow);
    dispIndex++;
  }

  document.addEventListener('DOMContentLoaded', adicionarDisponibilidade);
</script>
</body>
</html>
