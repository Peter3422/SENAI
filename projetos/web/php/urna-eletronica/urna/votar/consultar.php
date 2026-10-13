<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
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

        form {
            background-color: #2c2c2c; /* Fundo do formulário */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            max-width: 400px; /* Largura máxima do formulário */
            margin: auto; /* Centraliza o formulário */
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        td {
            padding: 12px;
        }

        input[type="text"],
        input[type="submit"] {
            width: calc(100% - 20px); /* Ajusta a largura para caber no espaço */
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #444; /* Borda mais escura */
            background-color: #444; /* Fundo dos inputs */
            color: #f4f4f4; /* Texto claro nos inputs */
            font-size: 16px;
        }

        input[type="text"]:focus {
            border-color: #007BFF; /* Borda azul ao focar */
            outline: none; /* Remove o contorno padrão */
        }

        input[type="submit"] {
            background-color: #007BFF; /* Azul padrão */
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Azul escuro ao passar o mouse */
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
    <h1>Consulta</h1>
    <form method="POST" action="consulta_tabela.php">
        <table>
            <tr>
                <td><label for="buscax">BUSCA</label></td>
            </tr>
            <tr>
                <td><input type="text" id="buscax" name="buscax"></td>
            </tr>
            <tr>
                <td><input type="submit" value="CONSULTAR"></td>
            </tr>
        </table>
    </form>

    <!-- Link para voltar ao menu principal -->
    <a href="/urna/opcoes/index.php">Voltar ao Menu Principal</a>

</body>

</html>