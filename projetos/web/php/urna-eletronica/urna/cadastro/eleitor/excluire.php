<?php
include "C:\wamp64\www\urna\conecta_banco.php"; // Inclui o arquivo de conexão

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];

    // Prepara a query para excluir o eleitor
    $query = "DELETE FROM eleitor WHERE cpf_eleitor='$cpf'";

    if (mysqli_query($conexao, $query)) {
        echo "Eleitor excluído com sucesso!";
    } else {
        echo "Erro ao excluir Eleitor: " . mysqli_error($conexao);
    }
} else {
    echo "CPF não fornecido.";
}

mysqli_close($conexao);
?>

<form action="/urna/opcoes/index.php">
    <input type="submit" value="VOLTAR">
</form>