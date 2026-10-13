<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Eleitores</title>
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
            border-collapse: collapse; /* Remove espaços entre as células */
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

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #444; /* Borda mais escura */
            background-color: #444; /* Fundo dos inputs */
            color: #f4f4f4; /* Texto claro nos inputs */
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
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
    <script>
        function formatarCPF(cpf) {
            // Remove caracteres não numéricos
            cpf = cpf.replace(/\D/g, '');

            // Formata o CPF
            if (cpf.length <= 11) {
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            return cpf;
        }

        function aplicarFormato() {
            const cpfInput = document.getElementById('cpf');
            // Formata o CPF enquanto o usuário digita
            cpfInput.value = formatarCPF(cpfInput.value);
        }

        function validarCPF(cpf) {
           // Implementação da validação do CPF (não incluída aqui)
           return true; // Placeholder para validação
       }

       function validarEFormatarCPF() {
           const cpfInput = document.getElementById('cpf');
           
           // Remove a formatação para validação
           const cpfSemFormatacao = cpfInput.value.replace(/\D/g, '');

           if (!validarCPF(cpfSemFormatacao)) {
               alert('CPF inválido! Por favor, digite um CPF válido.');
               return false;
           }
           
           return true;
       }
    </script>
</head>

<body>
    <h1>Cadastro de Eleitores</h1>
    <form method="POST" action="gravare.php" onsubmit="return validarEFormatarCPF();">
        <table>
            <tr>
                <td><label for="cpf">CPF</label></td>
                <td><label for="nomee">Nome</label></td>
                <td><label for="idadee">Idade</label></td>
                <td><label>Gravar</label></td>
            </tr>
            <tr>
                <td><input type="text" id="cpf" name="cpfe" required maxlength="14" oninput="aplicarFormato()"></td>
                <td><input type="text" name="nomee" required></td>
                <td><input type="number" name="idadee" required min="16" max="99"></td>
                <td><input type="submit" value="Gravar     "></td>
            </tr>
        </table>
    </form>

    <a href="tabela_eleitor.php">Tabela de Eleitores</a><br />
    <a href="/urna/opcoes/index.php">Voltar ao Menu Principal</a>

</body>

</html>