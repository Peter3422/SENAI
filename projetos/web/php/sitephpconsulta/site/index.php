<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        /* Estilo para o botão de consulta */
        .botao-consulta {
            width: 100%;
            /* Largura total */
            padding: 15px;
            /* Espaçamento interno */
            background-color: #007bff;
            /* Cor de fundo do botão */
            color: white;
            /* Cor do texto */
            border: none;
            /* Remove borda padrão */
            cursor: pointer;
            /* Muda o cursor ao passar sobre o botão */
            font-size: 16px;
            /* Tamanho da fonte */
            position: fixed;
            /* Fixa o botão no topo */
            top: 0;
            /* Posiciona no topo da página */
            left: 0;
            /* Posiciona à esquerda da página */
            z-index: 1000;
            /* Coloca em cima de outros elementos */
        }

        table {
            width: 100%;
            max-width: 600px;
            margin: 80px auto;
            /* Adiciona margem superior para não sobrepor o botão */
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        td {
            padding: 15px;
            text-align: left;
        }

        input[type="text"],
        input[type="number"],
        input[type="tel"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <form method="POST" action="consulta.php">
        <input type="submit" class="botao-consulta" value="Acessar banco de dados">
    </form>
    <form method="POST" action="gravar.php">
        <table>
            <tr>
                <td>Nome</td>
                <td>Idade</td>
                <td>Celular</td>
                <td>Gravar</td>
            </tr>
            <tr>
                <td><input type="text" name="nomex"></td>
                <td><input type="number" name="idadex"></td>
                <td><input type="tel" name="celularx" oninput="formatarTelefone(this)"></td>
                <td><input type="submit" value="#"></td>
            </tr>
        </table>
    </form>

    <script>
        function formatarTelefone(input) {
            // Remove todos os caracteres que não sejam dígitos
            let valor = input.value.replace(/\D/g, '');

            // Limita a entrada a no máximo 11 dígitos
            if (valor.length > 11) {
                valor = valor.substring(0, 11);
            }

            // Aplica a formatação
            if (valor.length > 6) {
                input.value = `(${valor.substring(0, 2)}) ${valor.substring(2, 7)}-${valor.substring(7)}`;
            } else if (valor.length > 2) {
                input.value = `(${valor.substring(0, 2)}) ${valor.substring(2)}`;
            } else if (valor.length > 0) {
                input.value = `(${valor}`;
            } else {
                input.value = '';
            }
        }
    </script>
</body>

</html>