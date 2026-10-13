<?php
class Database {
    private $host = "localhost";
    private $db_name = "dream_sleep_tracker";
    private $username = "root";  // Ajuste conforme seu usuário do MySQL
    private $password = "";      // Ajuste conforme sua senha do MySQL
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
            exit;
        }

        return $this->conn;
    }
}
