<?php
include "C:\wamp64\www\urna\conecta_banco.php"; // Inclui o arquivo de conexão

// Consulta para obter os eleitores cadastrados
$query = "SELECT * FROM eleitor";
$result = mysqli_query($conexao, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eleitores</title>
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

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007BFF; /* Azul padrão para o link voltar */
        }
    </style>
</head>

<body>
    <h1>Lista de Eleitores</h1>
    <table>
        <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Ações</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['cpf_eleitor']); ?></td>
            <td><?php echo htmlspecialchars($row['nome_eleitor']); ?></td>
            <td><?php echo htmlspecialchars($row['idade_eleitor']); ?></td>
            <td>
                <!-- Botão para editar -->
                <a href="editare.php?cpf=<?php echo urlencode($row['cpf_eleitor']); ?>">Editar</a> |
                <!-- Botão para excluir -->
                <a href="excluire.php?cpf=<?php echo urlencode($row['cpf_eleitor']); ?>" onclick="return confirm('Tem certeza que deseja excluir este eleitor?');">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="/urna/opcoes/index.php" class="back-link">Voltar ao Menu Principal</a>

    <?php mysqli_close($conexao); ?>
</body>

</html>