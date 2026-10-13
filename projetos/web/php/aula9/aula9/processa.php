<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $dados = "Nome: $nome, Email: $email, Telefone: $telefone\n";
    $arquivo = 'clientes.txt';

    $file = fopen($arquivo,'a');
    if($file){
        fwrite($file, $dados);
        fclose($file);
        header('Location: site.php?status=sucesso');
        exit();
    } else {
        header('Location: site.php?status=erro');
    }
}else{
    echo "Método de requisição inválido";
}
?>
