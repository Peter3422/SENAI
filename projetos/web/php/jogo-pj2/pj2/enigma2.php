<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}
// Contador de visitas
$contadorArquivo = 'contador.txt';
if (!file_exists($contadorArquivo)) {
    file_put_contents($contadorArquivo, 0);
}
$contador = (int) file_get_contents($contadorArquivo);
$contador++;
file_put_contents($contadorArquivo, $contador);

// Define o fuso horário para Brasília
date_default_timezone_set('America/Sao_Paulo');
$dataHoraAtual = date('d/m/Y H:i:s');

// Resposta correta para o enigma
$respostaCorreta = "radiance"; // Exemplo de resposta correta
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enigma</title>
    <style>
        body {
            background-image: url('bkg.png');
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
        }

        img {
            max-width: 100%;
            /* Ajusta a imagem ao tamanho da tela */
            height: auto;
            /* Mantém a proporção da imagem */
            margin-bottom: 20px;
            /* Espaço abaixo da imagem */
        }

        input[type="text"] {
            padding: 10px;
            width: 300px;
            /* Largura da caixa de texto */
            border: 1px solid #ccc;
            /* Borda da caixa de texto */
            border-radius: 4px;
            /* Bordas arredondadas */
        }

        button {
            padding: 10px 20px;
            margin-top: 10px;
            /* Espaço acima do botão */
            background-color: #4CAF50;
            /* Cor do botão */
            color: white;
            /* Cor do texto do botão */
            border: none;
            /* Sem borda padrão */
            border-radius: 4px;
            /* Bordas arredondadas no botão */
            cursor: pointer;
            /* Cursor de ponteiro ao passar o mouse */
        }

        button:hover {
            background-color: #45a049;
            /* Cor do botão ao passar o mouse */
        }

        .resultado {
            margin-top: 20px;
            /* Espaço acima da mensagem de resultado */
        }

        #user-info button {
            width: 100%;
            /* Largura total do botão */
            padding: 10px;
            /* Padding interno do botão */
            background-color: transparent;
            /* Torna o fundo do botão transparente */
            color: white;
            /* Texto branco no botão */
            border: 2px solid white;
            /* Borda branca para o botão */
            border-radius: 4px;
            /* Bordas arredondadas no botão */
            cursor: pointer;
            /* Cursor de ponteiro ao passar o mouse */
            font-size: 1em;
            /* Tamanho da fonte do botão */
            transition: background-color 0.3s, color 0.3s;
            /* Transição suave para hover */
        }

        #user-info button:hover {
            background-color: rgba(255, 255, 255, 0.2);
            /* Fundo levemente branco ao passar o mouse */
        }

        /* Estilo para o nome do usuário em h1 dentro da div user-info */
        #user-info h1 {
            color: white;
            /* Cor branca para o nome do usuário */
            margin: 0;
            /* Remove margens padrão do h1 */
            font-size: 1.5em;
            /* Tamanho da fonte do h1 ajustado para destaque */
        }

        /* Estilo específico para a div user-info */
        #user-info {
            position: fixed;
            top: 0;
            right: 0;
            display: none;
            /* Inicialmente invisível */
            /* Fundo escuro e semi-transparente */
            padding: 10px;
            /* Padding interno da div */
        }
    </style>
</head>

<body>
    <div id="user-info" style="display: none;">
        <h1><?php echo $_SESSION['username']; ?></h1> <!-- Nome do usuário em h1 -->
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    </div>
    <div class="container">
        <h1>Qual é a arma que o protagonista do jogo utiliza como arma principal?</h1>
        <img src="png-transparent-hollow-knight-light-radiance-wiki-knight-thumbnail.png" alt="Imagem do Enigma"> <!-- Substitua pelo caminho da sua imagem -->

        <input type="text" id="resposta" placeholder="Sua resposta">
        <button onclick="verificarResposta()">Enviar</button>

        <div class="resultado" id="resultado"></div>
    </div>
    <div style="position: fixed; bottom: 10px; right: 10px; font-size: 17px; color: #f0f0f0;">
        <?php echo 'Visitas: ' . $contador; ?>
    </div>
    <div style="position: fixed; bottom: 30px; right: 10px; font-size: 17px; color: #f0f0f0;">
        <?php echo $dataHoraAtual; ?>

        <script>
            function verificarResposta() {
                var respostaUsuario = document.getElementById("resposta").value.trim().toLowerCase();
                var respostaCorreta = "<?php echo strtolower($respostaCorreta); ?>"; // Resposta correta em minúsculas

                var resultadoDiv = document.getElementById("resultado");

                if (respostaUsuario === respostaCorreta) {
                    resultadoDiv.innerHTML = "<p style='color: green;'>Parabéns! Você acertou a resposta!</p>";
                    resultadoDiv.style.color = "green";
                    // Aqui você pode redirecionar ou fazer outra ação após a resposta correta
                    // window.location.href = "proxima_pagina.php"; // Exemplo de redirecionamento
                } else {
                    resultadoDiv.innerHTML = "<p style='color: red;'>Tente novamente! A resposta correta é 'Ferrão'.</p>";
                    resultadoDiv.style.color = "red";
                }
            }

            // Exibir a div se o usuário estiver logado
            document.getElementById('user-info').style.display = 'block';

        </script>
</body>

</html>