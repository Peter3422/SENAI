<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<!-- sistema de cadastro, fazer um sistema contendo campos de nome, senha, 
endereço, genero, disciplinas que cursou (programe ao menos 6 opções) e escolaridade -->
<body>
    <form action="" method="POST">
        <h1>Sistema de Cadastro</h1>
        <label for="nome">Nome: </label>
        <input type="text" id="nome" name="nome"><br>

        <label for="senha">Senha: </label>
        <input type="password" id="senha" name="senha"><br>

        <label for="endereco">Endereço: </label>
        <input type="text" id="endereco" name="endereco"><br>

        <label for="genero">Gênero: </label>
        <input type="radio" name="genero" id="genero" value="1">Masculino</td>
        <input type="radio" name="genero" id="genero" value="2">Feminino</td><br>

        <h3>Educação</h3>
        <label for="escolaridade">Escolaridade: (SOMENTE EM)</label>
        <select name="escolaridade" id="escolaridade">
                    <option value="1ano">1º EM</option>
                    <option value="2ano">2º EM</option>
                    <option value="3ano">3º EM</option>
        </select><br><br>

        <label for="disciplinas">Disciplinas: </label><br>
        <input type="checkbox" name="disciplinas1" id="disciplinas1">IOT</td>
        <input type="checkbox" name="disciplinas2" id="disciplinas2">Linguagem de Marcação</td><br>
        <input type="checkbox" name="disciplinas3" id="disciplinas3">Back-end</td>
        <input type="checkbox" name="disciplinas4" id="disciplinas4">Front-end</td><br>
        <input type="checkbox" name="disciplinas5" id="disciplinas5">Banco de dados</td>
        <input type="checkbox" name="disciplinas6" id="disciplinas6">Android</td><br><br>

        <input type="submit" name="enviar" value="enviar">
    </form>
<br><br>
<?php
$nome = $_POST["nome"];         
$senha = $_POST["senha"];
$endereco = $_POST["endereco"];
$genero = $_POST["genero"];
$escolaridade = $_POST["escolaridade"];
$disciplinas = "";

//isset verifica se a var existe
if(isset($_POST["disciplinas1"])) $disciplinas .= "IOT - ";
if(isset($_POST["disciplinas2"])) $disciplinas .= "LM -";
if(isset($_POST["disciplinas3"])) $disciplinas .= "BE - ";
if(isset($_POST["disciplinas4"])) $disciplinas .= "FE - ";
if(isset($_POST["disciplinas5"])) $disciplinas .= "BD - ";
if(isset($_POST["disciplinas6"])) $disciplinas .= "ANd - ";

$disciplinas = substr($disciplinas, 0, -1);

print $nome." - ".$senha." - ".$endereco." - ".$genero." - ".$escolaridade." - ".$disciplinas;
?>
</body>
</html>