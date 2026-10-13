<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>aula 3 php</title>
    <style>
        body {
            background-color: black;
        }

        p {
            color: white;
        }
    </style>
</head>

<body>

    <?php

    echo "<span style='color:red;'>Olá <br></span>";
    for ($i = 1; $i <= 5; $i++) {
        echo "<p>Numero: " . $i . "<br></p>";
    }
    echo "<br>";

    $o = 2;
    while ($o <= 5) {
        echo "<p>Numero: " . $o . "<br></p>";
        $o++;
    }
    echo "<br>";

    // //ele verifica uma vez se a variavel é verdadeira ou falsa
    // //ou seja, ele imprime uma vez o numero
    
    // $il = 10;
    // do {
    //     echo "<p>Numero: " . $il . "<br></p>";
    //     $il++;
    // } while ($il <= 5);
    $is = 3;
    do {
        echo "<p>Numero: " . $is . "<br></p>";
        $is++;
    } while ($is <= 5);
    echo "<br>";

    $frutas = array("maçã", "banana", "laranja", "kiwi", "romã");
    foreach ($frutas as $fruta) {
        echo "<p>Fruta: " . $fruta . "<br></p>";
    }
    echo "<br>";


    ?>

</body>

</html>