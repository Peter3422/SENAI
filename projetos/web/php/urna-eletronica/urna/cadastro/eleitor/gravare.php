<?php
include "C:\wamp64\www\urna\conecta_banco.php"; // Inclui o arquivo de conexão

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário e escapa caracteres especiais
    $cpf = $_POST["cpfe"];
    $nome = $_POST["nomee"];
    $idade = $_POST["idadee"];

    // Prepara a query para inserir os dados no banco
    $query = "INSERT INTO eleitor (cpf_eleitor, nome_eleitor, idade_eleitor) VALUES ('$cpf', '$nome', '$idade')";

    // Executa a query e verifica se foi bem-sucedida
    if (mysqli_query($conexao, $query)) {
        echo "Eleitor gravado com sucesso!";
    } else {
        echo "Erro ao gravar Eleitor: " . mysqli_error($conexao);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    echo "Erro ao gravar.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gravar Eleitores</title>
</head>

<body>
    <form action="/urna/opcoes/index.php">
        <input type="submit" value="VOLTAR">
    </form>
</body>

</html>