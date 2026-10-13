<?php
include "conecta_banco.php";

$id = $_GET["id"];

$query = mysqli_query($conexao, "delete from cliente where cli_cod= '$id'") or die("Erro ao deletar");

echo ("Sucesso!");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>deletar</title>
</head>

<body>
    <form action="consulta.php">
        <input type="submit" value="VOLTAR">
    </form>
</body>

</html>