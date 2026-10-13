<!DOCTYPE html>
<html>
<head>
    <title>Jogo da Velha - Sem JS</title>
    <meta charset="utf-8" />
</head>
<body>
    <form method="get" action="#">
        <?php 
            // alterna entre jogador 0 e 1 (bolinha e xis)
            $jogador = -1;
            if (isset($_GET["jogador"])) {
                $jogador = $_GET["jogador"];
                if ($jogador == 0)
                    $jogador = 1;
                else
                    $jogador = 0;
            } else {
                $jogador = 0;
            }
        ?>
        <table width="515" height="487" border="0" align="center" cellspacing="0">
            <tr>
                <?php
                    // mostra a peça clicada
                    $jogada = -1;
                    if (isset($_GET["jogada"]))
                        $jogada = $_GET["jogada"];
                    
                    // cria o array
                    // pra saber as jogadas anteriores e guardar onde tem bola e xis
                    $listaJogadas = array();
                    for ($criaJog = 0; $criaJog < 9; $criaJog++)
                        array_push($listaJogadas, -1);
                    
                    if (isset($_GET["listaJogadas"])) {
                        // lista das posições do tabuleiro que foram clicadas
                        $listaJogadas = $_GET["listaJogadas"];
                        // pega o último clique e coloca na lista
                        $listaJogadas[$jogada] = $jogador;
                     }
                    
                    $listaURLJogadas = "";
                    for ($criaJogada = 0; $criaJogada < 9; $criaJogada++) {
                        $listaURLJogadas .= "&listaJogadas[]=" . $listaJogadas[$criaJogada];
                     }
                    
                     // Verifica se há um vencedor
                     $vitoria = -1; // -1 significa que não há vencedor
                     if (($listaJogadas[0] == $listaJogadas[1]) && 
                        ($listaJogadas[1] == $listaJogadas[2]) && 
                        ($listaJogadas[0] != -1)) {
                        $vitoria = $listaJogadas[0];
                     } elseif (($listaJogadas[3] == $listaJogadas[4]) && 
                              ($listaJogadas[4] == $listaJogadas[5]) && 
                              ($listaJogadas[3] != -1)) {
                        $vitoria = $listaJogadas[3];
                     } elseif (($listaJogadas[6] == $listaJogadas[7]) && 
                              ($listaJogadas[7] == $listaJogadas[8]) && 
                              ($listaJogadas[6] != -1)) {
                        $vitoria = $listaJogadas[6];
                     } elseif (($listaJogadas[0] == $listaJogadas[3]) && 
                              ($listaJogadas[3] == $listaJogadas[6]) && 
                              ($listaJogadas[0] != -1)) {
                        $vitoria = $listaJogadas[0];
                     } elseif (($listaJogadas[1] == $listaJogadas[4]) && 
                              ($listaJogadas[4] == $listaJogadas[7]) && 
                              ($listaJogadas[1] != -1)) {
                        $vitoria = $listaJogadas[1];
                     } elseif (($listaJogadas[2] == $listaJogadas[5]) && 
                              ($listaJogadas[5] == $listaJogadas[8]) && 
                              ($listaJogadas[2] != -1)) {
                        $vitoria = $listaJogadas[2];
                     } elseif (($listaJogadas[0] == $listaJogadas[4]) && 
                              ($listaJogadas[4] == $listaJogadas[8]) && 
                              ($listaJogadas[0] != -1)) {
                        $vitoria = $listaJogadas[0];
                     } elseif (($listaJogadas[2] == $listaJogadas[4]) && 
                              ($listaJogadas[4] == $listaJogadas[6]) && 
                              ($listaJogadas[2] != -1)) {
                        $vitoria = $listaJogadas[2];
                     }

                     // Verifica se há um vencedor
                     if ($vitoria != -1) {
                        // Adiciona o script para tocar o áudio
                        echo "<script>
                              var audio;
                              if ($vitoria == 0) {
                                    audio = new Audio('cachorro-chupetao.mp3');
                              } else {
                                    audio = new Audio('cachorro-cheirando.mp3');
                              }
                              audio.play();
                              </script>";
                     }

                     for ($ind = 0; $ind < 9; $ind++) {
                        if (($ind % 3) == 0)
                            print "</tr><tr>";
                        
                        print "<td>";

                        if (isset($_GET["jogador"])) {
                            if ($listaJogadas[$ind] == 0) {
                                print '<img src="imagens/xis.gif" width="120" height="120">';
                            } else if ($listaJogadas[$ind] == 1) {
                                print '<img src="imagens/zero.gif" width="120" height="120">';
                            } else {
                                print "<a href='" . $_SERVER["PHP_SELF"] . "?jogada=" . $ind . "&jogador=" . $jogador . $listaURLJogadas . "'>Jogar!</a>";
                            }
                        } else {
                            print "<a href='" . $_SERVER["PHP_SELF"] . "?jogada=" . $ind . "&jogador=" . $jogador . $listaURLJogadas . "'>Jogar!</a>";
                        }
                        print "</td>";
                    }
                ?>
            </tr>
        </table>
    </form>
</body>
</html>
