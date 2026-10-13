<?php
include "C:\wamp64\www\urna\conecta_banco.php"; // Inclui o arquivo de conexão

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara a query para excluir o candidato
    $query = "DELETE FROM candidato WHERE id_cand='$id'";

    if (mysqli_query($conexao, $query)) {
        echo "Candidato excluído com sucesso!";
        header("Location: tabela_candidato.php");
        exit();
    } else {
        echo "Erro ao excluir candidato: " . mysqli_error($conexao);
    }
} else {
    echo "ID não fornecido.";
}

mysqli_close($conexao);
?>

<form action="/urna/opcoes/index.php">
    <input type="submit" value="VOLTAR">
</form>