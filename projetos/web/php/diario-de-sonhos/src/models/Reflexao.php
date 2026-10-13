<?php
class Reflexao {
    private $conn;
    private $table_name = "reflexoes";

    public $id;
    public $sonho_id;
    public $texto;
    public $audio_path;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO {$this->table_name} (sonho_id, texto, audio_path) VALUES (:sonho_id, :texto, :audio_path)";
        $stmt = $this->conn->prepare($query);

        $this->texto = htmlspecialchars(strip_tags($this->texto));
        $this->audio_path = htmlspecialchars(strip_tags($this->audio_path));

        $stmt->bindParam(':sonho_id', $this->sonho_id);
        $stmt->bindParam(':texto', $this->texto);
        $stmt->bindParam(':audio_path', $this->audio_path);

        return $stmt->execute();
    }

    public function readBySonho($sonho_id) {
        $query = "SELECT * FROM {$this->table_name} WHERE sonho_id = :sonho_id ORDER BY criado_em DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sonho_id', $sonho_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE {$this->table_name} SET texto = :texto, audio_path = :audio_path WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->texto = htmlspecialchars(strip_tags($this->texto));
        $this->audio_path = htmlspecialchars(strip_tags($this->audio_path));

        $stmt->bindParam(':texto', $this->texto);
        $stmt->bindParam(':audio_path', $this->audio_path);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
