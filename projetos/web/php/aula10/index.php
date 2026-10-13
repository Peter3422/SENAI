<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema de Cadastro de Clientes para Clínica Veterinária</title>
    <script>
        // Função para aplicar a máscara de telefone
        function mascaraTelefone(event) {
            const input = event.target;
            let value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos

            if (value.length > 10) {
                value = value.slice(0, 11); // Limita a 11 dígitos
            }

            if (value.length > 6) {
                input.value = `(${value.slice(0, 2)}) ${value.slice(2, 6)}-${value.slice(6)}`;
            } else if (value.length > 2) {
                input.value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
            } else {
                input.value = value;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Cadastro</h1>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'sucesso') { ?>
            <p class="success">Cliente cadastrado com sucesso!</p>
        <?php } elseif (isset($_GET['status']) && $_GET['status'] == 'erro') { ?>
            <p class="error">Erro ao cadastrar. Tente novamente.</p>
        <?php } ?>

        <form method="post" action="processa.php">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required oninput="mascaraTelefone(event)" maxlength="14" placeholder="(xx)xxxx-xxxx">

            <label for="animal_nome">Nome do Animal de Estimação:</label>
            <input type="text" id="animal_nome" name="animal_nome" required>
            
            <label for="especie">Espécie do Animal:</label>
            <input type="text" id="especie" name="especie" required>
            
            <div class="button-container">
                <input type="submit" value="Enviar">
                <a href="lista.php" class="button">Ver Lista de Clientes</a>
            </div>
        </form>
    </div>
</body>
</html>