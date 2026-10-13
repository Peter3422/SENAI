<?php
// Verifica se o formulário de cadastro foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = strtolower($_POST["new_username"]); // Converte o nome de usuário para minúsculas
    $new_password = $_POST["new_password"];
    $security_question = $_POST["pergunta_seguranca"];

    // Verifica se o arquivo de usuários existe
    $file = "users.txt";
    if (file_exists($file)) {
        // Lê o conteúdo do arquivo
        $data = file_get_contents($file);

        // Decodifica os dados do arquivo
        $users = json_decode($data, true);
    } else {
        $users = array();
    }

    // Adiciona o novo usuário ao array
    $users[$new_username] = array(
        'password' => $new_password,
        'security_question' => $security_question
    );

    // Codifica os dados do array
    $data = json_encode($users);

    // Grava os dados no arquivo
    file_put_contents($file, $data);

    // Redireciona para a página do enigma após o cadastro
    header("Location: enigma.php");
    exit();
}
date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('d/m/Y H:i:s');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <link rel="stylesheet" href="style2.1.css">
    <script src="script2.js"></script>
</head>
<body>
    <h1>Cadastro</h1>
    
    <div class="form-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateForm();">
            <label>Username:</label>
            <input type="text" name="new_username" required>

            <label>Password:</label>
            <input type="password" name="new_password" required>

            <label>Você é um humano? </label>
            <input type="radio" name="pergunta_seguranca" value="Sim" required> <span style="color: black;">Sim</span><br>
            <input type="radio" name="pergunta_seguranca" value="Não"> <span style="color: black;">Não</span><br><br>

            <input type="submit" name="register" value="Cadastrar"> <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
        </form>
        
            <div class="mask"></div>
    </div>
    <div style="position: fixed; bottom: 10px; right: 10px; font-size: 17px; color: #f0f0f0;"><?php echo $dateTime; ?></div>
</body>
</html>