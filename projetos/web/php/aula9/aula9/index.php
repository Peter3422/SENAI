<?php
$file = fopen('example.txt', 'w');
if($file){
    fclose($file);
} else{
    echo 'Erro ao abrir o arquivo';
}
?>