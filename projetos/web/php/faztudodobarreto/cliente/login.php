<?php
session_start();
include "C:/wamp64/www/faztudodobarreto/conectarbanco.php";

$username = $password = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = strtolower(trim($_POST["username"])); // Converte o username para minúsculas e remove espaços extras
        $password = $_POST["password"];

        // Verifica se o usuário existe no banco de dados
        $stmt = $conexao->prepare("SELECT id, senha FROM usuario WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        // Verifica se a senha bate com a do banco
        if ($user && password_verify($password, $user['senha'])) {
            // Salva o id do usuário e o nome de usuário na sessão
            $_SESSION['usuario_id'] = $user['id']; // Armazena o ID do usuário na sessão
            $_SESSION['username'] = $username; // Salva o nome de usuário na sessão

            // Redireciona para a página principal
            header("Location: index.php"); 
            exit();
        } else {
            $error_message = "Usuário ou senha inválidos."; // Exibe mensagem de erro
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style2.css"> <!-- Mantém seu CSS -->
</head>

<body>
    <h1>Login</h1>

    <div class="form-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label>Username:</label>
            <input type="text" name="username" required><br>

            <label>Password:</label>
            <input type="password" name="password" required><br>

            <input type="submit" name="submit" value="Login">

            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
            <br>

            <!-- Exibe mensagem de erro, se houver -->
            <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>
        </form>
    </div>
</body>

</html>
