<?php
include "C:\wamp64\www\urna\conecta_banco.php"; // Inclui o arquivo de conexão

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário e escapa caracteres especiais
    $codigoEleitor = $_POST["codigo"]; // Código do eleitor (id_eleitor)
    $votoRegistrado = $_POST["voto"]; // Voto registrado (número do candidato)

    // Verifica se o candidato existe
    $verificaCandidato = "SELECT COUNT(*) as total FROM candidato WHERE id_cand = '$votoRegistrado'";
    $resultadoVerificacao = mysqli_query($conexao, $verificaCandidato);
    $row = mysqli_fetch_assoc($resultadoVerificacao);

    if ($row['total'] > 0) {
        // Candidato existe, registra o voto normalmente
        $query = "INSERT INTO votos (vot_ele_cod, vot_voto) VALUES ('$codigoEleitor', '$votoRegistrado')";
        echo "Voto gravado com sucesso!";
    } else {
        // Candidato não existe, registra como voto em branco usando um valor específico
        $query = "INSERT INTO votos (vot_ele_cod, vot_voto) VALUES ('$codigoEleitor', -1)"; // -1 representa voto em branco
        echo "Você votou em branco!";
    }

    // Executa a query e verifica se foi bem-sucedida
    if (!mysqli_query($conexao, $query)) {
        echo "Erro ao gravar voto: " . mysqli_error($conexao);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    echo "Erro ao gravar.";
}
?>
<a href="/urna/opcoes/index.php">Voltar</a>