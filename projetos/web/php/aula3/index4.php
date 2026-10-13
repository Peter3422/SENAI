<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = "senai";
    $password = "123";

    if ($_POST['username'] == $username && $_POST['password'] == $password) {
        $_SESSION['logado'] = true;
        header('Location: welcome.php');
        exit;
    } else {
        $error = "Credenciais inválidas. Tente novamente";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>

    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>


    <form method="post">
        Nome de Usuário:
        <input type="text" name="username"><br><br>

        Senha:
        <input type="password" name="password"><br><br>

        <input type="submit" value="Login">
    </form>
</body>

</html>