<?php
session_start();
require_once __DIR__ . '/../../src/config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido, use POST"]);
    exit;
}

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Usuário não autenticado"]);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['inicio'], $data['fim'])) {
    http_response_code(400);
    echo json_encode(["error" => "Dados inválidos ou incompletos"]);
    exit;
}

try {
    $database = new Database();
    $conn = $database->getConnection();

    $stmt = $conn->prepare("INSERT INTO dados_sono (usuario_id, inicio, fim, duracao_minutos, fase, segmentos_json) VALUES (:usuario_id, :inicio, :fim, :duracao, :fase, :segmentos)");

    $inicio = $data['inicio'];
    $fim = $data['fim'];
    $duracao = isset($data['duracao_minutos']) ? (int)$data['duracao_minutos'] : null;
    $fase = $data['fase'] ?? null;
    $segmentos = isset($data['segmentos_json']) ? json_encode($data['segmentos_json']) : null;

    $stmt->bindParam(':usuario_id', $_SESSION['usuario_id']);
    $stmt->bindParam(':inicio', $inicio);
    $stmt->bindParam(':fim', $fim);
    $stmt->bindParam(':duracao', $duracao);
    $stmt->bindParam(':fase', $fase);
    $stmt->bindParam(':segmentos', $segmentos);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Dados de sono registrados"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Erro ao salvar dados no banco"]);
    }
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erro no banco de dados: " . $e->getMessage()]);
}
