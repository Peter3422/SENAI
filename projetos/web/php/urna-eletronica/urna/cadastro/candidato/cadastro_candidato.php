<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Candidato</title>
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
            max-width: 600px;
            margin: auto;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        td {
            padding: 10px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #444; /* Borda mais escura */
            background-color: #444; /* Fundo dos inputs */
            color: #f4f4f4; /* Texto claro nos inputs */
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #007BFF; /* Borda azul ao focar */
            outline: none; /* Remove o contorno padrão */
        }

        input[type="submit"] {
            background-color: #007BFF; /* Azul padrão */
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
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
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Cadastro de Candidato</h1>
    <form method="POST" action="gravarc.php">
        <table>
            <tr>
                <td><label for="nomec">Nome</label></td>
                <td><label for="idadec">Idade</label></td>
                <td><label for="partidoc">Partido</label></td>
                <td><label>Gravar</label></td>
            </tr>
            <tr>
                <td><input type="text" id="nomec" name="nomec" required></td>
                <td><input type="number" id="idadec" name="idadec" required min="18" max="80"></td>
                <td>
                    <select id="partidoc" name="partidoc" required>
                        <option value="">Selecione um partido</option>
                        <option value="PT">PT</option>
                        <option value="PSDB">PSDB</option>
                        <option value="PSB">PSB</option>
                        <option value="PL">PL</option>
                        <option value="MDB">MDB</option>
                        <option value="DEM">DEM</option>
                        <option value="PDT">PDT</option>
                        <option value="REDE">REDE</option>
                        <option value="PPS">PPS</option>
                        <option value="PV">PV</option>
                        <option value="PSOL">PSOL</option>
                        <option value="PROS">PROS</option>
                        <option value="Agir">Agir</option>
                        <option value="Avante">Avante</option>
                        <option value="Cidadania">Cidadania</option>
                        <option value="DC">Democracia Cristã (DC)</option>
                        <option value="PCB">Partido Comunista Brasileiro (PCB)</option>
                        <option value="PCO">Partido da Causa Operária (PCO)</option>
                        <option value="PSTU">Partido Socialista dos Trabalhadores Unificado (PSTU)</option>
                        <option value="NOVO">Novo</option>
                        <option value="Republicanos">Republicanos</option>
                        <option value="Solidariedade">Solidariedade</option>
                        <option value="Podemos">Podemos</option>
                    </select>
                </td>
                <td><input type="submit" value="Gravar"></td>
            </tr>
        </table>
    </form>

    <!-- Links para navegação -->
    <a href="tabela_candidato.php">Tabela de Candidatos</a><br />
    <a href="/urna/opcoes/index.php">Voltar ao Menu Principal</a>

</body>

</html>