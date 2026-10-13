<?php
require_once __DIR__ . '/../models/Sonho.php';
require_once __DIR__ . '/../config/database.php';

class SonhoController {
    private $db;
    private $sonho;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sonho = new Sonho($this->db);
    }

    public function store($postData, $usuario_id) {
        $this->sonho->usuario_id = $usuario_id;  // Usuário autenticado
        $this->sonho->titulo = $postData['titulo'] ?? '';
        $this->sonho->data = $postData['data'] ?? '';
        $this->sonho->hora = $postData['hora'] ?? null;
        $this->sonho->descricao = $postData['descricao'] ?? '';
        $this->sonho->emocao = $postData['emocao'] ?? '';
        $this->sonho->nivel_clareza = $postData['nivel_clareza'] ?? 1;
        $this->sonho->palavras_chave = $postData['palavras_chave'] ?? '';

        return $this->sonho->create();
    }
}
