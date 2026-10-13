<?php
// Conexão com o banco de dados
include("C:\wamp64\www\urna\conecta_banco.php"); // Certifique-se de que este arquivo contém as credenciais corretas

// Consulta SQL para contar votos válidos e em branco
$sql = "
SELECT c.nome_cand AS candidato, COUNT(v.vot_voto) AS votos
FROM votos v
JOIN candidato c ON v.vot_voto = c.id_cand
GROUP BY c.nome_cand

UNION ALL

SELECT 'Votos em Branco' AS candidato, COUNT(*) AS votos
FROM votos v
WHERE v.vot_voto = -1
";

// Executa a consulta
$result = mysqli_query($conexao, $sql); // $conn é a variável da conexão

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conexao));
}

// Início do HTML
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Votação</title>
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
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF; /* Azul padrão para links */
        }

        a:hover {
            text-decoration: underline; /* Sublinha ao passar o mouse */
        }
    </style>
</head>
<body>
    <h1>Resultados da Votação</h1>
    <table border="1">
        <tr>
            <th>Candidato</th>
            <th>Votos</th>
        </tr>

        <?php
        // Loop para exibir cada linha de resultado
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['candidato']); ?></td>
                <td><?php echo htmlspecialchars($row['votos']); ?></td>
            </tr>
            <?php
        }
        ?>

    </table>
    <a href="/urna/opcoes/index.php">Voltar ao Menu Principal</a> <!-- Link 'Voltar' dentro do corpo -->
</body>
</html>

<?php
// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>