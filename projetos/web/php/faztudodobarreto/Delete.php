<?php
// Configurações de conexão com o banco de dados
$servidor = "127.0.0.1";
$usuario = "root";
$senha = "";
$bancoDados = "sistemaEventos";

try {
    // Estabelecendo a conexão com o banco de dados
    $conexao = new PDO("mysql:host=" . $servidor . ";dbname=" . $bancoDados, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Comando para truncar a tabela 'setor'
    $comandoSQL = "TRUNCATE TABLE setor";
    $conexao->exec($comandoSQL);

    echo "Tabela 'setor' truncada com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
try {
    // Estabelecendo a conexão com o banco de dados
    $conexao = new PDO("mysql:host=" . $servidor . ";dbname=" . $bancoDados, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Comando para truncar a tabela 'setor'
    $comandoSQL = "TRUNCATE TABLE evento";
    $conexao->exec($comandoSQL);

    echo "Tabela 'evento' truncada com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Fechando a conexão
$conexao = null;
?>
<button onclick="history.back()">Voltar</button>