<?php
$file = fopen('example.txt', 'a');
if($file){
    fwrite($file, "\nNew content!"); //\n vai para linha de baixo
    fclose($file);
} else{
    echo 'Erro ao abrir o arquivo';
}

$content = file_get_contents('example.txt');
echo $content;
?>