<?php
include "C:\wamp64\www\urna\conecta_banco.php"; // Inclui o arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_antigo = $_POST["id_antigo"]; // ID antigo do candidato
    $nome = $_POST["nomec"];
    $idade = $_POST["idadec"];
    $partido = $_POST["partidoc"];

    // Prepara a query para atualizar os dados no banco
    $query = "UPDATE candidato SET nome_cand='$nome', idade_cand='$idade', partido_cand='$partido' WHERE id_cand='$id_antigo'";

    if (mysqli_query($conexao, $query)) {
        echo "Candidato atualizado com sucesso!";
        header("Location: tabela_candidato.php");
        exit();
    } else {
        echo "Erro ao atualizar candidato: " . mysqli_error($conexao);
    }

} else {
    echo "Erro ao atualizar.";
}

mysqli_close($conexao);
?>

<form action="/urna/opcoes/index.php">
    <input type="submit" value="VOLTAR">
</form>