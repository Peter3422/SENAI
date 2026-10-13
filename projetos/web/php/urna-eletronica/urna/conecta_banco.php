<?php
$servidor = "127.0.0.1";
$usuario = "root";
$senha = "";
$bancoDados = "senai";

// Criar a conexão com o banco de dados
$conexao = mysqli_connect($servidor, $usuario, $senha, $bancoDados);

// Verificar se a conexão foi bem-sucedida
if (!$conexao) {
    die("Problemas ao conectar: " . mysqli_connect_error());
}
?>