<?php
include "C:/wamp64/www/faztudodobarreto/conectarbanco.php";

$new_username = $new_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["new_username"]) && isset($_POST["new_password"])) {
        $new_username = strtolower(trim($_POST["new_username"])); // Converte o username para minúsculas e remove espaços extras
        $new_password = $_POST["new_password"];

        // se o nome do usuario contem 3 caracteres
        if (strlen($new_username) < 3) {
            $error_message = "O nome de usuário deve ter pelo menos 3 caracteres.";
        } else {
            // Criptografa a senha
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            // Verifica se o usuário já existe
            $stmt = $conexao->prepare("SELECT COUNT(*) FROM usuario WHERE username = :username");
            $stmt->bindParam(':username', $new_username);
            $stmt->execute();
            $userExists = $stmt->fetchColumn();

            if ($userExists > 0) {
                $error_message = "Este nome de usuário já está em uso.";
            } else {
                $stmt = $conexao->prepare("INSERT INTO usuario (username, senha) VALUES (:username, :password)");
                $stmt->bindParam(':username', $new_username);
                $stmt->bindParam(':password', $new_password_hash);
                $stmt->execute();
                header("Location: login.php");
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style2.css">
    <script>
        function validateForm() {
            const radioButtons = document.getElementsByName('pergunta_seguranca');
            let isHuman = false;
            for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    if (radioButton.value === "Sim") {
                        isHuman = true;
                    }
                }
            }
            if (!isHuman) {
                alert('Você deve ser um humano para se cadastrar!');
                return false;
            }
            return true; 
        }
    </script>
</head>

<body>
    <h1>Cadastro</h1>

    <div class="form-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
            <label>Username:</label>
            <input type="text" name="new_username" required>

            <label>Password:</label>
            <input type="password" name="new_password" required>

            <label>Você é um humano? </label>
            <input type="radio" name="pergunta_seguranca" value="Sim" required> <span style="color: black;">Sim</span><br>
            <input type="radio" name="pergunta_seguranca" value="Não"> <span style="color: black;">Não</span><br><br>

            <input type="submit" name="register" value="Cadastrar"> 
            <p>Já tem uma conta? <a href="login.php">Faça login</a></p>

            <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>
        </form>
    </div>
</body>

</html>
