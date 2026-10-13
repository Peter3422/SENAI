<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Jogo Par/Impar</title>
</head>

<body>
    <form action="#">
        <input type="hidden" id="numero" name="numero" value="0">
        <input type="hidden" id="parImpar" name="parImpar" value="par">
        <table>
            <tr>
                <td><button type="button" onclick="marcaNum(0)"><img src="imagem/0.png" id="0"></button></td>
                <td><button type="button" onclick="marcaNum(1)"><img src="imagem/1.png" id="1"></button></td>
                <td><button type="button" onclick="marcaNum(2)"><img src="imagem/2.png" id="2"></button></td>
            </tr>
            <tr>
                <td><button type="button" onclick="marcaNum(3)"><img src="imagem/3.png" id="3"></button></td>
                <td><button type="button" onclick="marcaNum(4)"><img src="imagem/4.png" id="4"></button></td>
                <td><button type="button" onclick="marcaNum(5)"><img src="imagem/5.png" id="5"></button></td>
            </tr>
            <tr>
                <td><input type="button" id="par" onclick="marcaPI(this.id)" value="Par" class="button"></input></td>

                <td><input type="button" id="impar" onclick="marcaPI(this.id)" value="Impar" class="button"></input>
                </td>

            </tr>
            <tr>
                <td colspan="3">
                    <center><input type="submit" value="Jogar"></center>
                </td>
            </tr>
        </table>
        <?php
        if (isset($_GET["parImpar"])) {
            $numeroGPU = rand(0, 5);
            $numeroFinal = ($_GET["numero"] + $numeroGPU) % 2;
            echo "<center><br>CPU Jogou: " . $numeroGPU;
            if (
                ($numeroFinal == 0 && $_GET["parImpar"] == "par") ||
                ($numeroFinal == 1 && $_GET["parImpar"] == "impar")
            ) {
                echo "<br>Voce ganhou!</center>";
            } else {
                echo "<br>CPU ganhou!</center>";
            }
        }
        ?>
    </form>
</body>

</html>
<script>
    function marcaNum(id) {
        document.getElementById("numero").value = id;
        // Tira as outras bordas
        for (let i = 0; i <= 5; i++) {
            document.getElementById(i).style.border = "0px";
        }
        // O número que eu clicar, coloca borda vermelha
        document.getElementById(id).style.border = "1px solid #FF0000";
    }

    function marcaPI(id) {
        document.getElementById("parImpar").value = id;

        if (id === "par") {
            document.getElementById("par").style.backgroundColor = "#FF0000";
            document.getElementById("impar").style.backgroundColor = "none";
        } else {
            document.getElementById("par").style.backgroundColor = "none";
            document.getElementById("impar").style.backgroundColor = "#FF0000";
        }
    }
</script>