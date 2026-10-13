<?php
session_start();

// Gerar um número aleatório se não existir na sessão
if (!isset($_SESSION['numeroAleatorio'])) {
    $_SESSION['numeroAleatorio'] = mt_rand(1, 100);
}

// Verificar se o formulário foi enviado
if (isset($_POST['palpite'])) {
    $palpite = intval($_POST['palpite']);
    $numeroAleatorio = $_SESSION['numeroAleatorio'];

    if ($palpite < $numeroAleatorio) {
        $mensagem = "Seu palpite é muito baixo!";
    } elseif ($palpite > $numeroAleatorio) {
        $mensagem = "Seu palpite é muito alto!";
    } else {
        $mensagem = "Parabéns! Você adivinhou o número!";
        // Reiniciar o jogo
        unset($_SESSION['numeroAleatorio']);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo de Adivinhação</title>
</head>
<body>
    <h1>Tente adivinhar o número entre 1 e 100</h1>
    
    <form method="post">
        <label for="palpite">Seu palpite:</label>
        <input type="number" id="palpite" name="palpite">
        <input type="submit" value="Enviar">
    </form>

    <?php
    echo "Número aleatório entre 0 e 100: " . $numeroAleatorio;
    // Exibir a mensagem se existir
    if (isset($mensagem)) {
        echo "<p>$mensagem</p>";
    }
    ?>
</body>
</html>