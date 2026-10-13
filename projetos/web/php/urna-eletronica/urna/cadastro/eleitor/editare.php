<?php
include "C:\wamp64\www\urna\conecta_banco.php"; // Inclui o arquivo de conexão

// Verifica se o CPF foi passado na URL
if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];

    // Consulta para obter os dados do eleitor
    $query = "SELECT * FROM eleitor WHERE cpf_eleitor = '$cpf'";
    $result = mysqli_query($conexao, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $nome = $row['nome_eleitor'];
        $idade = $row['idade_eleitor'];
    } else {
        echo "Eleitor não encontrado.";
        exit;
    }
} else {
    echo "CPF não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Eleitor</title>
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

        label {
            display: block; /* Faz o label ocupar toda a largura */
            margin-bottom: 5px; /* Espaço entre o label e o input */
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: calc(100% - 20px); /* Ajusta a largura para caber no espaço */
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #444; /* Borda mais escura */
            background-color: #444; /* Fundo dos inputs */
            color: #f4f4f4; /* Texto claro nos inputs */
            font-size: 16px;
            margin-bottom: 15px; /* Espaço entre os campos */
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
            // Função para formatar o CPF
            cpf = cpf.replace(/\D/g, '');
            if (cpf.length <= 11) {
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            return cpf;
        }

        function aplicarFormato() {
            const cpfInput = document.getElementById('cpf');
            cpfInput.value = formatarCPF(cpfInput.value);
        }
    </script>
</head>

<body>
    <h1>Editar Eleitor</h1>
    <form method="POST" action="atualizare.php">
        <input type="hidden" name="cpf_antigo" value="<?php echo htmlspecialchars($cpf); ?>">
        
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpfe" value="<?php echo htmlspecialchars($cpf); ?>" required maxlength="14" oninput="aplicarFormato()">

        <label for="nomee">Nome:</label>
        <input type="text" name="nomee" value="<?php echo htmlspecialchars($nome); ?>" required>

        <label for="idadee">Idade:</label>
        <input type="number" name="idadee" value="<?php echo htmlspecialchars($idade); ?>" required min="16" max="99">

        <input type="submit" value="Atualizar">
    </form>

    <a href="/urna/opcoes/index.php">Voltar ao Menu Principal</a>

</body>

</html>

<?php mysqli_close($conexao); ?>