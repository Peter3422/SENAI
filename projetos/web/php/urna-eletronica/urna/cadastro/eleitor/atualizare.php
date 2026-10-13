<?php
include "C:\wamp64\www\urna\conecta_banco.php"; // Inclui o arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf_antigo = $_POST["cpf_antigo"]; // CPF antigo
    $cpf_novo = $_POST["cpfe"]; // Novo CPF
    $nome = $_POST["nomee"];
    $idade = $_POST["idadee"];

    // Prepara a query para atualizar os dados no banco
    $query = "UPDATE eleitor SET cpf_eleitor='$cpf_novo', nome_eleitor='$nome', idade_eleitor='$idade' WHERE cpf_eleitor='$cpf_antigo'";

    if (mysqli_query($conexao, $query)) {
        echo "Eleitor atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar Eleitor: " . mysqli_error($conexao);
    }

} else {
    echo "Erro ao atualizar.";
}

mysqli_close($conexao);
?>

<form action="/urna/opcoes/index.php">
    <input type="submit" value="VOLTAR">
</form>