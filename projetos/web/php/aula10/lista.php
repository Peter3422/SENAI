<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Lista de Clientes - Clínica Veterinária</title>
    <script>
        function confirmarExclusao() {
            return confirm('Você tem certeza que deseja excluir este cliente?');
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Lista de Clientes</h1>

        <?php
        $filename = 'clientes.txt';

        if (!file_exists($filename)) {
            die('Arquivo não encontrado: ' . realpath($filename));
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['excluir'])) {
            $linhaParaExcluir = (int)$_POST['excluir'];
            $linhas = file($filename);
            unset($linhas[$linhaParaExcluir]);
            file_put_contents($filename, implode("", $linhas));
            echo "<p class='success'>Cliente excluído com sucesso!</p>";
        }

        $handle = fopen($filename, "r");
        if ($handle) {
            echo '<table>';
            echo '<tr><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Nome do Animal</th><th>Espécie</th><th>Ações</th></tr>';

            $index = 0;
            while (($line = fgets($handle)) !== false) {
                $data = explode("|", trim($line));
                echo '<tr>';
                foreach ($data as $cell) {
                    echo "<td>{$cell}</td>";
                }
                echo '<td>
                        <form method="post" onsubmit="return confirmarExclusao();" style="margin: 0;">
                            <input type="hidden" name="excluir" value="' . $index . '">
                            <input type="submit" value="Excluir" class="button">
                        </form>
                      </td>';
                echo '</tr>';
                $index++;
            }

            echo '</table>';
            fclose($handle);
        } else {
            echo '<p class="error">Erro ao abrir o arquivo.</p>';
        }
        ?>
        
        <div class="button-container">
            <a href="index.php" class="button">Voltar ao cadastro</a>
        </div>
    </div>
</body>
</html>