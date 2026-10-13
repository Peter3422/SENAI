<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo da Memoria</title>
    <link rel="stylesheet" href="css7.css">
</head>
<body>
    <form action="#" method="post">
        <?php
        session_start();
        if((isset($_SESSION["cartas"])==false) || (isset($_POST["limpar"]))){
            $_SESSION["cartas"] = array();
            $_SESSION["cartas_viradas"] = array();


            $_SESSION["acertos"] = array();


            $_SESSION["jogadas"] = 0;


            $_SESSION["pares_formados"]=0;


            //array push põe um valor no array
            array_push($_SESSION["cartas_viradas"], -1);//cartas da jogada atual
            array_push($_SESSION["cartas_viradas"], -1);//vai ser responsavél por saber quais cartas foram viradas


            for($monta_carta = 1; $monta_carta <= 10; $monta_carta++){
                array_push($_SESSION["cartas"],"imagens/".$monta_carta.".png");
                array_push($_SESSION["cartas"],"imagens/".$monta_carta.".png");
               
                array_push($_SESSION["acertos"],0);
                array_push($_SESSION["acertos"],0);
            }
            //embaralha as cartas //embaralha o array
            shuffle($_SESSION["cartas"]);
        }
        //monta o tabuleiro
        for($numCarta =0; $numCarta < 20; $numCarta++){
            if(isset($_POST[$numCarta."_x"])){
                if($_SESSION["cartas_viradas"][0] == -1){
                    $_SESSION["cartas_viradas"][0] = $numCarta;
        }else{
            $_SESSION["cartas_viradas"][1] = $numCarta;
            // reset da pagina em 1 segundo
            print '<META HTTP-EQUIV="Refresh" CONTENT="1>';
        }
    }
    // a cada 5 cartas, pula uma linha
    if($numCarta % 5 == 0)
     print"<br>";

     //verifica se esta carta deve ser virada
     // ou é uma das 2 cartas da jogada ou esta carta ja formou par
     if(($_SESSION["cartas_viradas"][0] == $numCarta) || 
     ($_SESSION["cartas_viradas"][1] == $numCarta) || 
     ($_SESSION["acertos"][$numCarta] == 1)){
        print '<IMG NAME="' . $numCarta . '" SRC="' . $_SESSION["cartas"][$numCarta] . '"/>';
     }else{
        print '<IMG NAME="' . $numCarta . '" SRC="imagens/question.png"/>';
     }
}
for($numCarta = 0; $numCarta < 20; $numCarta++){
    if($_SESSION["cartas_viradas"][1] > -1){
        //se for par
        if($_SESSION["cartas"][$_SESSION["cartas_viradas"][0]] == 
        $_SESSION["cartas"][$_SESSION["cartas_viradas"][1]]){
            //marcando como acerto aquela posição
            $_SESSION["acertos"][$_SESSION["cartas_viradas"][0]] = 1;
            $_SESSION["acertos"][$_SESSION["cartas_viradas"][1]] = 1;
        }
        //zera o array de cartas viradas
        $_SESSION["cartas_viradas"] = array();
    
        //adiciona uma jogada
        $_SESSION["jogadas"]++;

        array_push($_SESSION["cartas_viradas"], -1);
        array_push($_SESSION["cartas_viradas"], -1);
    }
}
?>
    </form>
    </body>
</html>
