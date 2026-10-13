<?php
$file = file_exists('example.txt');
if($file){
    echo 'O arquivo existe.';
} else{
    echo 'O arquivo não existe.';
}
?>