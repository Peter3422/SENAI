<?php
include "C:\wamp64\www\urna\conecta_banco.php"; // Inclui o arquivo de conexão

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário e escapa caracteres especiais
    $nome = $_POST["nomec"];
    $idade = $_POST["idadec"];
    $partido = $_POST["partidoc"];

    // Prepara a query para inserir os dados no banco
    $query = "INSERT INTO candidato (nome_cand, idade_cand, partido_cand) VALUES ('$nome', '$idade', '$partido')";

    // Executa a query e verifica se foi bem-sucedida
    if (mysqli_query($conexao, $query)) {
        // Obtém o ID do candidato inserido
        $idCandidato = mysqli_insert_id($conexao);
        echo "Candidato gravado com sucesso!<br>";
        echo "ID do Candidato: " . htmlspecialchars($idCandidato);
    } else {
        echo "Erro ao gravar candidato: " . mysqli_error($conexao);
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
    <title>Gravar Candidato</title>
</head>

<body>
    <form action="/urna/opcoes/index.php">
        <input type="submit" value="VOLTAR">
    </form>
</body>

</html>