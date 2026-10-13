<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ataques = [
        $_POST['ataque1'],
        $_POST['ataque2'],
        $_POST['ataque3']
    ];
    $defesas = [
        $_POST['defesa1'],
        $_POST['defesa2'],
        $_POST['defesa3']
    ];

    // Processar os dados conforme necessário
    $totalAtaque = array_sum($ataques);
    $totalDefesa = array_sum($defesas);
    $totalGeral = $totalAtaque + $totalDefesa;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Pokecard</title>
    <link rel="stylesheet" href="style2.css"> <!-- Certifique-se de que o caminho do CSS está correto -->
</head>
<body>
    <div class="resultado-container">
        <h1>Resultados da Pokecard</h1>
        <h2>Pokémon: Mega Tyranitar</h2>
        <div class="resultado">
            <h3>Valores de Ataque:</h3>
            <ul>
                <li>Ataque 1: <span class="resultado-valor"><?php echo htmlspecialchars($ataques[0]); ?></span></li>
                <li>Ataque 2: <span class="resultado-valor"><?php echo htmlspecialchars($ataques[1]); ?></span></li>
                <li>Ataque 3: <span class="resultado-valor"><?php echo htmlspecialchars($ataques[2]); ?></span></li>
            </ul>
            <h2>Total de Ataque: <span class="resultado-valor"><?php echo $totalAtaque; ?></span></h2>
            
            <h3>Valores de Defesa:</h3>
            <ul>
                <li>Defesa 1: <span class="resultado-valor"><?php echo htmlspecialchars($defesas[0]); ?></span></li>
                <li>Defesa 2: <span class="resultado-valor"><?php echo htmlspecialchars($defesas[1]); ?></span></li>
                <li>Defesa 3: <span class="resultado-valor"><?php echo htmlspecialchars($defesas[2]); ?></span></li>
            </ul>
            <h2>Total de Defesa: <span class="resultado-valor"><?php echo $totalDefesa; ?></span></h2>
            
            <h2>Total Geral: <span class="resultado-valor"><?php echo $totalGeral; ?></span></h2>
        </div>
        <!-- Botão para voltar para index.php -->
        <form action="index.php" method="POST">
            <button type="submit" class="back-button">Voltar para o Card</button>
        </form>
    </div>
</body>
</html>