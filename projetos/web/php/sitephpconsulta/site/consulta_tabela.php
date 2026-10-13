<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>consulta em tabela</title>
</head>

<body>
    <table border="1">
        <tr>
            <td>CODIGO</td>
            <td>NOME</td>
            <td>IDADE</td>
            <td>CELULAR</td>
            <td>DELETAR</td>
            <td>EDITAR</td>
        </tr>
        <?php
        include "conecta_banco.php";

        $busca = $_POST["buscax"];

        $query = mysqli_query($conexao, "select cli_cod, cli_nome, cli_idade, cli_celular from cliente where cli_nome like \"%$busca%\" group by 1");
        while ($saida = mysqli_fetch_array($query)) {
            $codigo = $saida[0];
            $nome = $saida[1];
            $idade = $saida[2];
            $celular = $saida[3];

            echo "<tr>";
            echo "<td>" . $codigo . "</td>";
            echo "<td>" . $nome . "</td>";
            echo "<td>" . $idade . "</td>";
            echo "<td>" . $celular . "</td>";
            echo "<td><a href=deletar.php?id=" . $codigo . ">OK</a></td>";
            echo "<td><a href=editar.php?id=" . $codigo . ">OK</a></td>";
            echo "<tr>";

        }
        mysqli_close($conexao);
        ?>
    </table>
    <form method="POST" action="consulta.php">
        <input type="submit" value="VOLTAR">
    </form>
</body>

</html>