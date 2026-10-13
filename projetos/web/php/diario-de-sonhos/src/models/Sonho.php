<?php
class Sonho {
    private $conn;
    private $table_name = "sonhos";

    public $id;
    public $usuario_id;
    public $titulo;
    public $data;
    public $hora;
    public $descricao;
    public $emocao;
    public $nivel_clareza;
    public $palavras_chave;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO {$this->table_name} 
            (usuario_id, titulo, data, hora, descricao, emocao, nivel_clareza, palavras_chave)
            VALUES (:usuario_id, :titulo, :data, :hora, :descricao, :emocao, :nivel_clareza, :palavras_chave)";

        $stmt = $this->conn->prepare($query);

        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->data = htmlspecialchars(strip_tags($this->data));
        $this->hora = htmlspecialchars(strip_tags($this->hora));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->emocao = htmlspecialchars(strip_tags($this->emocao));
        $this->palavras_chave = htmlspecialchars(strip_tags($this->palavras_chave));

        $stmt->bindParam(':usuario_id', $this->usuario_id);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':data', $this->data);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':emocao', $this->emocao);
        $stmt->bindParam(':nivel_clareza', $this->nivel_clareza);
        $stmt->bindParam(':palavras_chave', $this->palavras_chave);

        return $stmt->execute();
    }
}
