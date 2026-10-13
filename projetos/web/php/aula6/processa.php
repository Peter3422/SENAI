<?php
    $numero = $_POST['numero'];

    echo"Numero: ".$numero.'<br><br>';
    for ($i = 1; $i <= 10; $i++) {
        echo''.$numero.' * '.$i.': '.$numero * $i.'<br>';
    }
    ?>
<html>
    <br>
<a href="index2.php">Voltar</a>
</html>