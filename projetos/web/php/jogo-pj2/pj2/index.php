<?php
date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('d/m/Y H:i:s');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enigma</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<body>
    
    <div class="container">
        <h1>Você está preparado para resolver este enigma?</h1>
        <form action="login.php" method="get">
            <button type="submit">SIM</button>
        </form>
        <button id="noButton" onclick="alert('Você disse NÃO!')">NÃO</button>
    </div>
    <div style="position: fixed; bottom: 10px; right: 10px; font-size: 17px; color: #f0f0f0;"><?php echo $dateTime; ?></div>
</body>
</html>