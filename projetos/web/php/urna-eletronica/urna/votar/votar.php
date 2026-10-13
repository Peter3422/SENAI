<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Urna Eletrônica</title>
</head>
<body>
    <div class="urna">
        <div class="tela" id="display">
            <div class="divisao1"></div>
            <div class="divisao2">Confirme seu voto</div>
        </div>

        <form method="POST" action="posvoto.php" class="teclado-form">
            <input type="hidden" id="voto" name="voto" value="">
            <input type="hidden" name="codigo" value="<?php echo isset($_GET['id']) ? intval($_GET['id']) : ''; ?>">
            
            <div class="teclado">
                <div class="linha">
                    <button type="button" onclick="playSound('click'); digitar(7)" class="btn teclado-botao">7</button>
                    <button type="button" onclick="playSound('click'); digitar(8)" class="btn teclado-botao">8</button>
                    <button type="button" onclick="playSound('click'); digitar(9)" class="btn teclado-botao">9</button>
                </div>
                <div class="linha">
                    <button type="button" onclick="playSound('click'); digitar(4)" class="btn teclado-botao">4</button>
                    <button type="button" onclick="playSound('click'); digitar(5)" class="btn teclado-botao">5</button>
                    <button type="button" onclick="playSound('click'); digitar(6)" class="btn teclado-botao">6</button>
                </div>
                <div class="linha">
                    <button type="button" onclick="playSound('click'); digitar(1)" class="btn teclado-botao">1</button>
                    <button type="button" onclick="playSound('click'); digitar(2)" class="btn teclado-botao">2</button>
                    <button type="button" onclick="playSound('click'); digitar(3)" class="btn teclado-botao">3</button>
                </div>
                <div class="linha">
                    <button type='button' onclick='playSound("click"); digitar(0)' class='btn teclado-botao btn-zero'>0</button> <!-- Botão 0 -->
                </div>

                <br>
                <div class='linha'>
                    <button type='button' onclick='corrigir()' class='btn teclado-botao teclado-botao-corrige'>Corrigir</button>
                    <!-- Botão para confirmar o voto -->
                    <button type='button' class='btn teclado-botao teclado-botao-confirma' onclick='confirmarVoto()'>CONFIRMAR</button>
                    <!-- Botão para votar em branco -->
                    <button type='button' onclick='votarBranco()' class='btn teclado-botaob'>Branco</button>
                </div>
            </div> <!-- Fim do contêiner do teclado -->
        </form>

        <!-- Elementos de áudio -->
        <audio id="click-sound" src="spacebar-click-keyboard-199448.mp3"></audio> <!-- Substitua pelo caminho correto -->
        <audio id="confirm-sound" src="confirma-urna.mp3"></audio> <!-- Substitua pelo caminho correto -->

        <a href="/urna/votar/consultar.php" class='voltar'>Voltar ao Menu Principal</a>

        <!-- Inclusão do script JavaScript -->
        <script src='script.js'></script> 
    </body>
</html>