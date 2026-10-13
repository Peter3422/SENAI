<?php
$file = fopen('example.txt', 'w');
if($file){
    fwrite($file, 'Hello, file!');
    fclose($file);
} else{
    echo 'Erro ao abrir o arquivo';
}
?>