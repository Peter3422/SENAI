<?php
$servidor = "127.0.0.1";
$usuario = "root";
$senha = "";
$bancoDados = "senai";
//mais util criar o login ao banco com variaveis, caso troque é mais facil de mudar
$conexao = mysqli_connect($servidor, $usuario, $senha, $bancoDados) or die("Problemas ao conectar");
//outra opção de nao conectar ao banco de dados
// if($conexao){
//     echo "Problemas ao conectar";
// }
?>