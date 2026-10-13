<?php
// conectarbanco.php

$servidor = "127.0.0.1";
$usuario = "root";
$senha = "";
$bancoDados = "sistemaEventos";

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$bancoDados", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

// ESTE CODIGO NÃO é SEGURO pois da para inserir coisas sem estar no codigo interno
// $conexao = mysqli_connect($servidor, $usuario, $senha, $bancoDados);

// dbname é o nome do bando de dados
// Estabelecendo a conexão com o banco de dados
//$conexao = new PDO("mysql:host=" . $servidor . ";dbname=" . $bancoDados, $usuario, $senha);
// Configurando o modo de erro do PDO para exceções
//deputador de erros
//$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//usando o bindvalue para impossibilitar com que consigam mudar informações pela url
//tambem utilizado para o codigo ficar menor doque outras estrategias
// $comandoSQL->bindValue(":vNome", $nomeEventos);
// $comandoSQL->bindValue(":vDataHora", $dhEvento);
// $comandoSQL->bindValue(":vInicioVendas", $inicioVendas);
// $comandoSQL->execute();
?>