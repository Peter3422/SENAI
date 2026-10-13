<?php
require_once 'config/database.php';

$username = 'admin';
$password = 'admin123'; // Altere para senha segura
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->fetch()) {
    echo "Usuário admin já existe.";
} else {
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hash]);
    echo "Usuário admin criado com sucesso.";
}
?>
