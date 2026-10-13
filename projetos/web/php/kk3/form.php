<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <h1>Sistema de Cadastro</h1>
        <label for="nome">Nome: </label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="senha">Senha: </label>
        <input type="password" id="senha" name="senha" required><br>

        <label for="endereco">Endereço: </label>
        <input type="text" id="endereco" name="endereco" required><br>

        <label>Gênero: </label>
        <input type="radio" name="genero" id="genero1" value="Masculino" required>Masculino
        <input type="radio" name="genero" id="genero2" value="Feminino">Feminino<br>

        <h3>Educação</h3>
        <label for="escolaridade">Escolaridade: (SOMENTE EM)</label>
        <select name="escolaridade" id="escolaridade" required>
            <option value="1ano">1º EM</option>
            <option value="2ano">2º EM</option>
            <option value="3ano">3º EM</option>
        </select><br><br>

        <label>Disciplinas: </label><br>
        <input type="checkbox" name="disciplinas1" id="disciplinas1" value="IOT">IOT<br>
        <input type="checkbox" name="disciplinas2" id="disciplinas2" value="Linguagem de Marcação">Linguagem de Marcação<br>
        <input type="checkbox" name="disciplinas3" id="disciplinas3" value="Back-end">Back-end<br>
        <input type="checkbox" name="disciplinas4" id="disciplinas4" value="Front-end">Front-end<br>
        <input type="checkbox" name="disciplinas5" id="disciplinas5" value="Banco de dados">Banco de dados<br>
        <input type="checkbox" name="disciplinas6" id="disciplinas6" value="Android">Android<br><br>

        <input type="submit" name="enviar" value="Enviar">
    </form>
<br><br>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];         
    $senha = $_POST["senha"];
    $endereco = $_POST["endereco"];
    $genero = $_POST["genero"];
    $escolaridade = $_POST["escolaridade"];
    $disciplinas = "";

    // Verifica se as disciplinas foram selecionadas
    if (isset($_POST["disciplinas1"])) $disciplinas .= "IOT - ";
    if (isset($_POST["disciplinas2"])) $disciplinas .= "Linguagem de Marcação - ";
    if (isset($_POST["disciplinas3"])) $disciplinas .= "Back-end - ";
    if (isset($_POST["disciplinas4"])) $disciplinas .= "Front-end - ";
    if (isset($_POST["disciplinas5"])) $disciplinas .= "Banco de dados - ";
    if (isset($_POST["disciplinas6"])) $disciplinas .= "Android - ";

    // Remove o último traço e espaço
    $disciplinas = rtrim($disciplinas, " - ");

    if (!isset($_SESSION["livros"])) {
        $_SESSION["livros"] = array();
    }

    $linhaLivro = array($nome, $senha, $endereco, $genero, $escolaridade, $disciplinas);
    array_push($_SESSION["livros"], $linhaLivro);
}
?>  
<table>
    <tr>
        <th>Nome</th>
        <th>Senha</th>
        <th>Endereço</th>
        <th>Gênero</th>
        <th>Escolaridade</th>
        <th>Disciplinas</th>
    </tr>
    <?php
    foreach ($_SESSION["livros"] as $linha) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($linha[0]) . "</td>";
        echo "<td>" . htmlspecialchars($linha[1]) . "</td>";
        echo "<td>" . htmlspecialchars($linha[2]) . "</td>";
        echo "<td>" . htmlspecialchars($linha[3]) . "</td>";
        echo "<td>" . htmlspecialchars($linha[4]) . "</td>";
        echo "<td>" . htmlspecialchars($linha[5]) . "</td>";
        echo "</tr>";
    }
    // print $nome." - ".$senha." - ".$endereco." - ".$genero." - ".$escolaridade." - ".$disciplinas;
    ?>
</table>

</body>
</html>