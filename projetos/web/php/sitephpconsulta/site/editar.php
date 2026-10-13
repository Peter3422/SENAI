<?php
include "conecta_banco.php";

$id = $_GET['id'];

$query = mysqli_query($conexao, "select cli_cod, cli_nome, cli_idade, cli_celular from cliente where cli_cod='$id'") or die("Erro ao editar");

$saida = mysqli_fetch_array($query);

$codigo = $saida[0];
$nome = $saida[1];
$idade = $saida[2];
$celular = $saida[3];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar</title>
</head>

<body>
    <form method="GET" action="editar2.php">
        <table>
            <tr>
                <td>Código<input type="text" name="codigo_v" value="<?php echo htmlspecialchars($codigo); ?>" disabled></td>
                <input type=hidden name="codigo" value="<?php echo htmlspecialchars($codigo); ?>">
                <td>Nome<input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>"></td>
                <td>Idade<input type="text" name="idade" value="<?php echo htmlspecialchars($idade); ?>"></td>
                <td>Celular<input type="text" name="celular" value="<?php echo htmlspecialchars($celular); ?>"></td>
            </tr>
        </table>
        <input type="submit" value="CONFIRMAR">
    </form><br><br>
    <form action="consulta.php">
        <input type="submit" value="VOLTAR">
    </form>
</body>

</html>