<?php
session_start();
require_once __DIR__ . '/../src/config/database.php';
require_once __DIR__ . '/../src/models/Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmaSenha = $_POST['confirma_senha'] ?? '';

    if ($senha !== $confirmaSenha) {
        $message = 'As senhas não coincidem.';
    } else {
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        if ($usuario->criar()) {
            $message = 'Cadastro realizado com sucesso. <a href="login.php">Faça login aqui</a>.';
        } else {
            $message = 'Erro: Email já cadastrado.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Registrar - Dream Sleep Tracker</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
</head>
<body>
<div class="container">
    <h2>Registro de Usuário</h2>
    <?php if ($message): ?>
        <div class="alert"><?= $message ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <label for="confirma_senha">Confirme a senha:</label>
        <input type="password" id="confirma_senha" name="confirma_senha" required>

        <button type="submit">Registrar</button>
    </form>
    <p>Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
</div>
<footer><small>Dream Sleep Tracker &copy; <?= date('Y') ?></small></footer>
</body>
</html>
