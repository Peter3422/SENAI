<?php
// Incluir o arquivo de conexão com o banco de dados
include 'C:\wamp64\www\urna\conecta_banco.php';

// Comandos para truncar as tabelas
$sql1 = "TRUNCATE TABLE candidato";
$sql2 = "TRUNCATE TABLE eleitor";
$sql3 = "TRUNCATE TABLE votos";

// Executar os comandos
if ($conexao->query($sql1) === TRUE) {
    echo "Tabela 'candidato' truncada com sucesso.<br>";
} else {
    echo "Erro ao truncar tabela 'candidato': " . $conexao->error . "<br>";
}

if ($conexao->query($sql2) === TRUE) {
    echo "Tabela 'eleitor' truncada com sucesso.<br>";
} else {
    echo "Erro ao truncar tabela 'eleitor': " . $conexao->error . "<br>";
}

if ($conexao->query($sql3) === TRUE) {
    echo "Tabela 'votos' truncada com sucesso.<br>";
} else {
    echo "Erro ao truncar tabela 'votos': " . $conexao->error . "<br>";
}

// Fechar a conexão
$conexao->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset</title>
</head>
<body>
<a href="/urna/opcoes/index.php">Voltar</a> 
</body>
</html>