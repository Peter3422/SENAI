<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

function hasConflict($pdo, $id_professor, $data, $horario_inicio, $horario_fim) {
    $stmt = $pdo->prepare("
        SELECT COUNT(*) FROM distribuicao_aulas
        WHERE id_professor = ? AND data_aula = ?
        AND (
            (horario_inicio < ? AND horario_fim > ?) OR
            (horario_inicio < ? AND horario_fim > ?) OR
            (horario_inicio >= ? AND horario_fim <= ?)
        )
    ");
    $stmt->execute([$id_professor, $data, $horario_fim, $horario_fim, $horario_inicio, $horario_inicio, $horario_inicio, $horario_fim]);
    return $stmt->fetchColumn() > 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->exec("DELETE FROM distribuicao_aulas");

    // Obter todas as disciplinas
    $stmt_disciplinas = $pdo->query("SELECT * FROM disciplinas ORDER BY nome");
    $disciplinas = $stmt_disciplinas->fetchAll(PDO::FETCH_ASSOC);

    $dia_semana_map = [
        'segunda' => 0, 'terça' => 1, 'quarta' => 2, 'quinta' => 3, 'sexta' => 4
    ];

    $unallocated_aulas = []; 

    foreach ($disciplinas as $disciplina) {
        $aulas_restantes = $disciplina['aulas_semanais'];
        $duracao_aula_horas = $disciplina['duracao_aula'];

        $stmt_qualificados = $pdo->prepare("
            SELECT p.id_professor, p.nome
            FROM professores p
            INNER JOIN professor_disciplinas pd ON p.id_professor = pd.id_professor
            WHERE pd.id_disciplina = ?
        ");
        $stmt_qualificados->execute([$disciplina['id_disciplina']]);
        $professores_qualificados = $stmt_qualificados->fetchAll(PDO::FETCH_ASSOC);

        if (empty($professores_qualificados)) {
            $unallocated_aulas[] = "Disciplina '{$disciplina['nome']}': Nenhum professor qualificado encontrado.";
            continue;
        }

        while ($aulas_restantes > 0) {
            $aula_alocada_neste_ciclo = false;

            foreach ($professores_qualificados as $professor) {
                $stmt_disponibilidade = $pdo->prepare("
                    SELECT dia_semana, horario_inicio, horario_fim
                    FROM disponibilidade
                    WHERE id_professor = ? ORDER BY dia_semana_map, horario_inicio
                ");
                $stmt_disponibilidade->execute([$professor['id_professor']]);
                $disponibilidades = $stmt_disponibilidade->fetchAll(PDO::FETCH_ASSOC);

                foreach ($disponibilidades as $disp) {
                    $dia_data = new DateTime('monday this week');
                    $dia_data->modify('+' . $dia_semana_map[$disp['dia_semana']] . ' days');
                    $data_aula_str = $dia_data->format('Y-m-d');

                    $hora_inicio_aula = new DateTime($disp['horario_inicio']);
                    $hora_fim_aula = clone $hora_inicio_aula;
                    $hora_fim_aula->modify("+{$duracao_aula_horas} hours");


                    $disp_fim = new DateTime($disp['horario_fim']);
                    if ($hora_fim_aula > $disp_fim) {
                        continue; 
                    }

                    if (!hasConflict($pdo, $professor['id_professor'], $data_aula_str, $hora_inicio_aula->format('H:i:s'), $hora_fim_aula->format('H:i:s'))) {
                        $stmt_insert = $pdo->prepare("
                            INSERT INTO distribuicao_aulas (id_professor, id_disciplina, data_aula, horario_inicio, horario_fim)
                            VALUES (?, ?, ?, ?, ?)
                        ");
                        $stmt_insert->execute([
                            $professor['id_professor'],
                            $disciplina['id_disciplina'],
                            $data_aula_str,
                            $hora_inicio_aula->format('H:i:s'),
                            $hora_fim_aula->format('H:i:s')
                        ]);
                        $aulas_restantes--;
                        $aula_alocada_neste_ciclo = true;
                        break 3; 
                    }
                }
            }

            if (!$aula_alocada_neste_ciclo) {
                $unallocated_aulas[] = "Disciplina '{$disciplina['nome']}': Não foi possível alocar todas as aulas (restam {$aulas_restantes}).";
                break; 
            }
        }
    }

    if (empty($unallocated_aulas)) {
        $success = "Distribuição de aulas realizada com sucesso!";
    } else {
        $error = "Distribuição concluída com alertas:<br>" . implode("<br>", $unallocated_aulas);
        if (empty($success)) {
            $success = "Algumas aulas foram distribuídas.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Distribuição de Aulas</title>
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
  <h2>Distribuição Automática de Aulas</h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="alert alert-success"><?= $success ?></div>
  <?php endif; ?>

  <form method="POST">
    <button type="submit" class="btn btn-primary">Realizar Distribuição de Aulas</button>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
