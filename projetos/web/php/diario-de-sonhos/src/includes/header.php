<?php
session_start();

// Defina aqui o caminho base correto, por exemplo:
// Se você acessa o site em 'http://localhost/dream-sleep-tracker/public/index.php', use:
$base_url = '/dream-sleep-tracker/public/';
// Se o projeto estiver na raiz do servidor (ex: 'http://localhost/index.php'), use:
// $base_url = '/';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dream Sleep Tracker</title>
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/style.css" />
</head>
<body>
<nav class="navbar">
    <div class="navbar-brand">Dream Sleep Tracker</div>
    <ul class="navbar-menu">
        <li><a href="<?= $base_url ?>index.php">Diário</a></li>
        <li><a href="<?= $base_url ?>calendario.php">Calendário</a></li>
        <li><a href="<?= $base_url ?>dicas.php">Dicas</a></li>
        <li><a href="<?= $base_url ?>estatisticas.php">Estatísticas</a></li>
        <li><a href="<?= $base_url ?>configuracoes.php">Configurações</a></li>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <li><a href="<?= $base_url ?>logout.php">Sair (<?= htmlspecialchars($_SESSION['usuario_nome']) ?>)</a></li>
        <?php else: ?>
            <li><a href="<?= $base_url ?>login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
