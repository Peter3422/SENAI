<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nome;
    public $email;
    public $senha_hash;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Cadastro de usuário
    public function criar() {
        // Verificar se email já existe
        $queryCheck = "SELECT id FROM {$this->table_name} WHERE email = :email";
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(":email", $this->email);
        $stmtCheck->execute();
        if ($stmtCheck->rowCount() > 0) {
            return false; // Usuário já existe
        }

        // Inserir novo usuário
        $query = "INSERT INTO {$this->table_name} (nome, email, senha_hash) VALUES (:nome, :email, :senha_hash)";
        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha_hash', $this->senha_hash);

        return $stmt->execute();
    }

    // Login - valida email e senha
    public function login($email, $senha) {
        $query = "SELECT * FROM {$this->table_name} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $row['senha_hash'])) {
                return $row;
            }
        }
        return false;
    }
}
