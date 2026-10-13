<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}

// Definindo os enigmas e as respostas corretas
$enigmas = [
    "Qual a arma que o protagonista do jogo utiliza como arma principal durante o jogo?" => "Ferrão",
    "Qual a cor da máscara do nosso protagonista?" => "Branca",
    "Hollow Knight é um jogo de movimento/plataforma, então qual a mecânica mais comum de jogos de movimento/plataforma?" => "Dash",
];

// Inicializando variáveis
$enigmasRespondidos = [];
$acertos = 0; // Variável para contar os acertos
$erros = 0;   // Variável para contar os erros

// Contador de visitas
$contadorArquivo = 'contador.txt';

// Verifica se o arquivo existe
if (!file_exists($contadorArquivo)) {
    file_put_contents($contadorArquivo, 0);
}

// Lê o valor atual do contador
$contador = (int)file_get_contents($contadorArquivo);

// Incrementa o contador
$contador++;

// Salva o novo valor no arquivo
file_put_contents($contadorArquivo, $contador);

// Define o fuso horário para Brasília
date_default_timezone_set('America/Sao_Paulo');

// Obtém a data e hora atual
$dataHoraAtual = date('d/m/Y H:i:s');

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Usando foreach para percorrer os enigmas
    foreach ($enigmas as $enigma => $resposta) {
        // Verificando se a resposta do usuário foi enviada
        if (isset($_POST[$enigma])) {
            // Obtendo a resposta do usuário
            $respostaUsuario = strtolower(trim($_POST[$enigma]));
            
            // Verificando se a resposta está correta
            if ($respostaUsuario === strtolower($resposta)) {
                $enigmasRespondidos[$enigma] = "Parabéns! Você acertou a resposta: " . $resposta . "!";
                $acertos++; // Incrementa o contador de acertos
            } else {
                $enigmasRespondidos[$enigma] = "Tente novamente! A resposta correta é: " . $resposta . ".";
                $erros++; // Incrementa o contador de erros
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo de Enigmas</title>
    <link rel="stylesheet" href="styles copy.css">
</head>
<body>
        <div id="user-info" style="display: none;">
    <h1><?php echo $_SESSION['username']; ?></h1> <!-- Nome do usuário em h1 -->
    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
</div>
    <div class="container">
        <h1>Resolva os Enigmas de Hollow Knight!</h1>



<script>
    // Exibir a div se o usuário estiver logado
    document.getElementById('user-info').style.display = 'block';
</script>

        <form method="POST">
            <?php
            // Usando um laço for para exibir os enigmas
            $numeroDeEnigmas = count($enigmas);
            for ($i = 0; $i < $numeroDeEnigmas; $i++): 
                $enigma = array_keys($enigmas)[$i]; // Obtendo a chave do enigma
            ?>
                <p><?php echo $enigma; ?></p>
                <input type="text" name="<?php echo htmlspecialchars($enigma); ?>" placeholder="Sua resposta" required>
            <?php endfor; ?>
            <button type="submit">Enviar</button>
            <a href="enigma2.php" style="display: block; margin-top: 10px;">
        <button type="button">Ir para Enigmas Difíceis</button>
        </form>

        <?php if (!empty($enigmasRespondidos)): ?>
            <div class="resultado">
                <?php
                // Usando um laço while para exibir os resultados
                $i = 0;
                while ($i < count($enigmasRespondidos)):
                    $enigma = array_keys($enigmasRespondidos)[$i];
                    $resultado = $enigmasRespondidos[$enigma];
                ?>
                    <p><?php echo htmlspecialchars($enigma) . " - " . $resultado; ?></p>
                <?php
                    $i++;
                endwhile; 
                ?>
                <p><strong>Você acertou <?php echo $acertos; ?> de <?php echo count($enigmas); ?> enigmas!</strong></p>
                <p><strong>Você errou <?php echo $erros; ?> de <?php echo count($enigmas); ?> enigmas!</strong></p>
            </div>
        <?php endif; ?>
    </div>
    <div style="position: fixed; bottom: 10px; right: 10px; font-size: 17px; color: #f0f0f0;">
    <?php echo 'Visitas: ' . $contador; ?>
    </div>
    <div style="position: fixed; bottom: 30px; right: 10px; font-size: 17px; color: #f0f0f0;">
    <?php echo $dataHoraAtual; ?>
</div>
</body>
</html>