<?php
session_start(); // Inicia a sessão

// Verifica se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = strtolower($_POST["username"]); // Converte o nome de usuário para minúsculas
    $password = $_POST["password"];

    // Verifica se o arquivo de usuários existe
    $file = "users.txt";
    if (file_exists($file)) {
        // Lê o conteúdo do arquivo
        $data = file_get_contents($file);

        // Decodifica os dados do arquivo
        $users = json_decode($data, true);

        // Verifica se o usuário existe e se a senha está correta
        if (array_key_exists($username, $users) && $users[$username]['password'] == $password) {
            $_SESSION['username'] = $username; // Armazena o nome de usuário na sessão
            header("Location: enigma.php"); // Redireciona para a página do enigma
            exit();
        } else {
            echo "<p style='color:red;'>Usuário ou senha inválidos.</p>";
        }
    } else {
        echo "<p style='color:red;'>Nenhum usuário cadastrado ainda.</p>";
    }
}
// Formata a data e hora no fuso horário de Brasília
date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('d/m/Y H:i:s');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h1>Login</h1>
    <div class="form-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="login-form">
            <label>Username:</label>
            <input type="text" name="username" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <input type="submit" name="submit" value="Login">
            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
            <p>Deseja voltar a tela inicial? <a href="index.php">Voltar</a></p>
        </form>
        <div class="mask"></div>
    </div>
    <div style="position: fixed; bottom: 10px; right: 10px; font-size: 17px; color: #f0f0f0;"><?php echo $dateTime; ?></div>
</body>
</html>