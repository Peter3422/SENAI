<?php
session_start();
require_once __DIR__ . '/../../src/config/database.php';
require_once __DIR__ . '/../../src/models/Sonho.php';
require_once __DIR__ . '/../../src/models/Reflexao.php';

header("Content-Type: application/json");

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Usuário não autenticado']);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$sonhoModel = new Sonho($db);
$reflexaoModel = new Reflexao($db);

$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null; // id do sonho para PUT, DELETE, GET especifico

// Função para pegar input JSON no corpo da requisição
function getInputData() {
    return json_decode(file_get_contents('php://input'), true);
}

switch ($method) {
    case 'GET':
        if ($id) {
            // Get one sonho
            $sonhoModel->id = $id;
            $query = "SELECT * FROM sonhos WHERE id = :id AND usuario_id = :usuario_id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':usuario_id', $_SESSION['usuario_id']);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $sonho = $stmt->fetch(PDO::FETCH_ASSOC);
                // Obtém reflexoes
                $reflexoes = $reflexaoModel->readBySonho($id);
                $sonho['reflexoes'] = $reflexoes;
                echo json_encode($sonho);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Sonho não encontrado']);
            }
        } else {
            // Get all sonhos do usuario
            $query = "SELECT * FROM sonhos WHERE usuario_id = :usuario_id ORDER BY criado_em DESC";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':usuario_id', $_SESSION['usuario_id']);
            $stmt->execute();
            $sonhos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($sonhos);
        }
        break;

    case 'POST':
        $data = getInputData();
        $sonhoModel->usuario_id = $_SESSION['usuario_id'];
        $sonhoModel->titulo = $data['titulo'] ?? '';
        $sonhoModel->data = $data['data'] ?? '';
        $sonhoModel->hora = $data['hora'] ?? null;
        $sonhoModel->descricao = $data['descricao'] ?? '';
        $sonhoModel->emocao = $data['emocao'] ?? '';
        $sonhoModel->nivel_clareza = $data['nivel_clareza'] ?? 1;
        $sonhoModel->palavras_chave = $data['palavras_chave'] ?? '';

        if ($sonhoModel->create()) {
            echo json_encode(['success' => true, 'message' => 'Sonho criado']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar sonho']);
        }
        break;

    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID do sonho é necessário para atualizar']);
            break;
        }
        $data = getInputData();
        $queryCheck = "SELECT usuario_id FROM sonhos WHERE id = :id";
        $stmtCheck = $db->prepare($queryCheck);
        $stmtCheck->bindParam(':id', $id);
        $stmtCheck->execute();
        if ($stmtCheck->rowCount() == 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Sonho não encontrado']);
            break;
        }
        $row = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        if ($row['usuario_id'] != $_SESSION['usuario_id']) {
            http_response_code(403);
            echo json_encode(['error' => 'Acesso negado']);
            break;
        }

        // Atualizar o sonho
        $query = "UPDATE sonhos SET titulo=:titulo, data=:data, hora=:hora, descricao=:descricao, emocao=:emocao, nivel_clareza=:nivel_clareza, palavras_chave=:palavras_chave WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':titulo', $data['titulo']);
        $stmt->bindParam(':data', $data['data']);
        $stmt->bindParam(':hora', $data['hora']);
        $stmt->bindParam(':descricao', $data['descricao']);
        $stmt->bindParam(':emocao', $data['emocao']);
        $stmt->bindParam(':nivel_clareza', $data['nivel_clareza']);
        $stmt->bindParam(':palavras_chave', $data['palavras_chave']);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Sonho atualizado']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao atualizar sonho']);
        }
        break;

    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID do sonho é necessário para excluir']);
            break;
        }
        // Verificar propriedade para segurança
        $queryCheck = "SELECT usuario_id FROM sonhos WHERE id = :id";
        $stmtCheck = $db->prepare($queryCheck);
        $stmtCheck->bindParam(':id', $id);
        $stmtCheck->execute();
        if ($stmtCheck->rowCount() == 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Sonho não encontrado']);
            break;
        }
        $row = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        if ($row['usuario_id'] != $_SESSION['usuario_id']) {
            http_response_code(403);
            echo json_encode(['error' => 'Acesso negado']);
            break;
        }
        $query = "DELETE FROM sonhos WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Sonho excluído']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao excluir sonho']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método HTTP não permitido']);
        break;
}
