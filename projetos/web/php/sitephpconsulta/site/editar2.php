<?php
include "conecta_banco.php";

$codigo = $_GET['codigo'];
$nome = $_GET['nome'];
$idade = $_GET['idade'];
$celular = $_GET['celular'];

$query = mysqli_query($conexao, "update cliente set cli_nome = \"$nome\", cli_idade = \"$idade\", cli_celular = \"$celular\" where cli_cod='$codigo'") or die("Erro na edição");
echo "Sucesso";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmação</title>
</head>

<body>
    <form action="consulta.php">
        <input type="submit" value="VOLTAR">
    </form>
</body>

</html>