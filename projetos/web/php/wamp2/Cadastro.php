<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #f4f4f4;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 1);
        }

        form {
            background-color: #444;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 1);
            padding: 20px;
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #555;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #666;
            color: #f4f4f4;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #218838;
            color: #f4f4f4;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #f4f4f4;
        }
    </style>
</head>

<body>

    <h1>Cadastro</h1>

    <form method="post" action="Resultado.php">
        <div class="section">
            <div class="section-title">DADOS PESSOAIS</div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" required>

            <label for="datan">Data de Nascimento:</label>
            <input type="date" id="datan" name="datan" required>

            <label for="end">Endereço:</label>
            <input type="text" id="end" name="end" required>
        </div>

        <div class="section">
            <div class="section-title">EDUCAÇÃO</div>
            <label for="esc">Escola:</label>
            <input type="text" id="esc" name="esc" required>

            <label for="anoi">Ano de Início:</label>
            <input type="number" id="anoi" name="anoi" required>

            <label for="anof">Ano de Fim:</label>
            <input type="number" id="anof" name="anof" required>
        </div>

        <div class="section">
            <div class="section-title">DADOS PROFISSIONAIS</div>
            <label for="emp">Empresa:</label>
            <input type="text" id="emp" name="emp" required>

            <label for="anoie">Ano de Início:</label>
            <input type="number" id="anoie" name="anoie" required>

            <label for="anofe">Ano de Fim:</label>
            <input type="number" id="anofe" name="anofe" required>

            <label for="carg">Cargo:</label>
            <input type="text" id="carg" name="carg" required>
        </div>

        <input type="submit" value="Enviar">
    </form>

</body>

</html>