<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta em Tabela</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #181818; /* Cor de fundo escura */
            color: #f4f4f4; /* Cor do texto clara */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #ffffff; /* Cor do título */
        }

        table {
            width: 100%;
            border-collapse: collapse; /* Remove espaços entre as células */
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #444; /* Linha de separação entre as linhas */
        }

        th {
            background-color: #2c2c2c; /* Fundo das cabeçalhos da tabela */
            color: #ffffff; /* Cor do texto das cabeçalhos */
        }

        tr:nth-child(even) {
            background-color: #2c2c2c; /* Cor de fundo para linhas pares */
        }

        tr:hover {
            background-color: #333; /* Cor ao passar o mouse sobre a linha */
        }

        a {
            color: #007BFF; /* Azul padrão para links */
            text-decoration: none; /* Remove o sublinhado do link */
        }

        a:hover {
            text-decoration: underline; /* Sublinha ao passar o mouse */
        }

        form {
            margin-top: 20px;
            text-align: center; /* Centraliza o formulário */
        }

        input[type="submit"] {
            background-color: #007BFF; /* Azul padrão */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Azul escuro ao passar o mouse */
        }
    </style>
</head>

<body>
    <h1>Consulta em Tabela</h1>
    <table>
        <tr>
            <th>CÓDIGO</th>
            <th>CPF</th>
            <th>NOME</th>
            <th>IDADE</th>
            <th>VOTAR</th>
        </tr>
        
        <?php
        include "C:\wamp64\www\urna\conecta_banco.php";

        $busca = $_POST["buscax"];

        $query = mysqli_query($conexao, "SELECT id_eleitor, cpf_eleitor, nome_eleitor, idade_eleitor FROM eleitor WHERE cpf_eleitor LIKE '%$busca%' GROUP BY 1");
        
        while ($saida = mysqli_fetch_array($query)) {
            $codigo = $saida[0];
            $cpf = $saida[1];
            $nome = $saida[2];
            $idade = $saida[3];

            echo "<tr>";
            echo "<td>" . htmlspecialchars($codigo) . "</td>";
            echo "<td>" . htmlspecialchars($cpf) . "</td>";
            echo "<td>" . htmlspecialchars($nome) . "</td>";
            echo "<td>" . htmlspecialchars($idade) . "</td>";
            echo "<td><a href='votar.php?id=" . urlencode($codigo) . "'>OK</a></td>"; // Passa o código do eleitor via URL
            echo "</tr>";
        }
        
        mysqli_close($conexao);
        ?>
    </table>

    <form method="POST" action="consultar.php">
        <input type="submit" value="VOLTAR">
    </form>

</body>

</html>