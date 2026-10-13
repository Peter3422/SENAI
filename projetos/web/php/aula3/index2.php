<?php
session_start();
echo '<br>Bem vindo, ' . $_SESSION['usuario'];
if ($_SESSION['logado']) {
    echo ' você está logado!<br>';
}
echo "Números de visitas: ".$_SESSION['visitas'];
?>