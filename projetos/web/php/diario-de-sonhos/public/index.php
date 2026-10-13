<?php
// Simulação de usuário autenticado (no futuro implemente sessão/autenticação)
$usuario_id_simulado = 1;

require_once __DIR__ . '/../src/controllers/SonhoController.php';

$controller = new SonhoController();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($controller->store($_POST, $usuario_id_simulado)) {
        $message = "Sonho registrado com sucesso!";
    } else {
        $message = "Falha ao registrar sonho.";
    }
}

include __DIR__ . '/../src/includes/header.php';
include __DIR__ . '/../src/views/sonho_form.php';
include __DIR__ . '/../src/includes/footer.php';
