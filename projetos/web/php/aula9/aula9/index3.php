<?php
// metodo1
$file = fopen('example.txt', 'r');
if($file){
    $content = fread($file, filesize('example.txt'));
    echo $content;
    fclose($file);
} else{
    echo 'Erro ao abrir o arquivo';
}

// metodo2
// $content = file_get_contents('example.txt');
// echo $content;
?>