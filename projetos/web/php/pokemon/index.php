<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokecard</title>
    <link rel="stylesheet" href="style.css">
    <script src="style.js"></script>
</head>
<body>
    <div class="carta">
        <div class="imagem-container">
            <img src="OIP.jpg" class="imagem-circular" alt="Mega Tyranitar">
            <p>Mega Tyranitar</p><br>
        </div>
        <form action="result.php" method="POST" onsubmit="validarPontos(event)">
            <div class="atributos">
                <div class="ataque">
                    <h3>Ataque</h3>
                    <input type="number" name="ataque1" placeholder="Ataque 1" required>
                    <input type="number" name="ataque2" placeholder="Ataque 2" required>
                    <input type="number" name="ataque3" placeholder="Ataque 3" required>
                </div>
                <div class="defesa">
                    <h3>Defesa</h3>
                    <input type="number" name="defesa1" placeholder="Defesa 1" required>
                    <input type="number" name="defesa2" placeholder="Defesa 2" required>
                    <input type="number" name="defesa3" placeholder="Defesa 3" required>
                </div>
            </div>
            <button type="submit" class="submit-button">Enviar</button>
        </form>
    </div>
</body>
</html>