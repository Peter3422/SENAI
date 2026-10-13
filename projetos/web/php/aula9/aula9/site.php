<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Clientes</h1>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'sucesso') { ?>
            <p class="success">Cliente cadastrado com sucesso!</p>
        <?php } elseif (isset($_GET['status']) && $_GET['status'] == 'erro') { ?>
            <p class="error">Erro ao cadastrar. Tente novamente.</p>
        <?php } ?>

        <form action="processa.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required>

            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>