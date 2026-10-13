<?php
include "conecta_banco.php";

$nome = $_POST["nomex"];
$idade = $_POST["idadex"];
$celular = $_POST["celularx"];
//query pode ser qualquer coisa, porem query significa script no banco de dados
$query = mysqli_query($conexao, "insert into cliente(cli_nome, cli_idade, cli_celular) values('$nome', '$idade', '$celular')");

echo "GRAVADO AO BANDO DE DADOS";

mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gravar</title>
</head>

<body>
    <form action="index.php">
        <br>
        <br>
        <br><input type="submit" value="VOLTAR">
    </form>
</body>

</html>