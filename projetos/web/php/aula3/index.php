<?php
session_start();
$_SESSION['usuario'] = 'joao';
$_SESSION['logado'] = true;

if(!isset($_SESSION['visitas'])) {
    $_SESSION['visitas']=1;
}else{
    $_SESSION['visitas']+=2;
}
echo "Números de visitas: ".$_SESSION['visitas'];
?>