<?php
$file = fopen('example.txt', 'r');
if($file){
    while($line = fgets($file) !== false){
        echo $line;
    }
    fclose($file);
}else{
    echo 'Erro ao abrir o arquivo';
}
?>