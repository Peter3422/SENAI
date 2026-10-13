<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivinhe o Número</title>
</head>

<body>
    <h1>Adivinhe o Número</h1>
    <p>A CPU irá sortear um número e você terá 10 tentativas para acertá-lo</p>
    <p>A CPU te dará dicas de qual número é.</p>
    <form action="" method="POST">
        <label for="tentaNum">Tentativa: </label>
        <input type="text" name="tentaNum" >
        <input type="submit" value="Adivinhar!" name="adivinhar">
        <input type="submit" value="Restart" name="restart">
    </form>

    <?php
    session_start();
    if (isset($_POST["restart"])) {
        session_destroy(); 
        session_start();
        $_SESSION["numSort"] = rand(1, 99);
        $_SESSION["qtdTentativas"] = 10;
        $_SESSION["tentativas"] = array(); // Array 
    }
    if (!isset($_SESSION["numSort"])) {
        $_SESSION["numSort"] = rand(1, 99);
        $_SESSION["qtdTentativas"] = 10;
        $_SESSION["tentativas"] = array(); // Array 
    }

    if ($_SESSION["qtdTentativas"] <= 0) {
        print "<p>O número era " . $_SESSION["numSort"] . ". Você não tem mais tentativas.</p>";
    } else {
        // Tentativa
        if (isset($_POST["adivinhar"])) {
            $tentativa = (int) $_POST["tentaNum"];
            $_SESSION["tentativas"][] = $tentativa; // Armazena
            $_SESSION["qtdTentativas"]--;

            if ($_SESSION["numSort"] == $tentativa) {
                print "<p>Você acertou!</p>";
            } else if ($_SESSION["numSort"] < $tentativa && $_SESSION["numSort"] + 10 > $tentativa) {
                print "<p>Sua tentativa foi um pouco acima do número sorteado</p>";
            } else if ($_SESSION["numSort"] > $tentativa && $_SESSION["numSort"] - 10 < $tentativa) {
                print "<p>Sua tentativa foi um pouco abaixo do número sorteado</p>";
            } else if ($_SESSION["numSort"] < $tentativa) {
                print "<p>Sua tentativa foi acima</p>";
            } else {
                print "<p>Sua tentativa foi abaixo</p>";
            }
        }
    }

    print "<p>Você possui " . $_SESSION["qtdTentativas"] . " tentativas restantes.</p>";

    if (!empty($_SESSION["tentativas"])) {
        print "<p>Tentativas anteriores: " . implode(", ", $_SESSION["tentativas"]) . "</p>";
    }
    ?>
</body>

</html>