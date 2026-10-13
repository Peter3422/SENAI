<?php
session_start();
require_once __DIR__ . '/../src/config/database.php';
require_once __DIR__ . '/../src/models/Usuario.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $userData = $usuario->login($email, $senha);
    if ($userData) {
        $_SESSION['usuario_id'] = $userData['id'];
        $_SESSION['usuario_nome'] = $userData['nome'];
        header('Location: index.php');
        exit;
    } else {
        $message = 'Email ou senha incorretos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Login - Dream Sleep Tracker</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if ($message): ?>
        <div class="alert"><?= $message ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <button type="submit">Entrar</button>
    </form>
    <p>Não possui uma conta? <a href="register.php">Registre-se aqui</a>.</p>
</div>
<footer><small>Dream Sleep Tracker &copy; <?= date('Y') ?></small></footer>
</body>
</html>
