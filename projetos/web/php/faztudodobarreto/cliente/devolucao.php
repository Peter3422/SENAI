<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "C:/wamp64/www/faztudodobarreto/conectarbanco.php";

// Função para processar a devolução
function processarDevolucao($usuario_id, $venda_id, $quantidade)
{
    global $conexao;

    // Consulta para obter a venda e os detalhes
    $consulta = $conexao->prepare("SELECT setor_id, quantidade FROM vendas WHERE id = ? AND usuario_id = ?");
    $consulta->execute([$venda_id, $usuario_id]);
    $venda = $consulta->fetch();

    if ($venda) {
        // Verifica se a quantidade a ser devolvida não é maior que a comprada
        if ($venda['quantidade'] < $quantidade) {
            return "Quantidade de ingressos inválida!";
        }

        // Atualiza a quantidade de ingressos vendidos no setor
        $consulta = $conexao->prepare("UPDATE setor SET ingressos = ingressos + ? WHERE id = ?");
        $consulta->execute([$quantidade, $venda['setor_id']]);

        // Remove os ingressos devolvidos da tabela de vendas
        $consulta = $conexao->prepare("UPDATE vendas SET quantidade = quantidade - ? WHERE id = ?");
        $consulta->execute([$quantidade, $venda_id]);

        return true;
    }
    return "Venda não encontrada!";
}

// Processa a devolução quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario_id'];  // ID do usuário logado
    $venda_id = $_POST['venda_id'];
    $quantidade = $_POST['quantidade'];

    $resultado = processarDevolucao($usuario_id, $venda_id, $quantidade);

    if ($resultado === true) {
        echo "<h2>Devolução realizada com sucesso!</h2>";
    } else {
        echo "<h2 style='color:red;'>Erro: " . htmlspecialchars($resultado) . "</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Devolução de Ingressos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: #333;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .devolucao-form {
            margin-top: 20px;
            text-align: center;
        }

        .devolucao-form input[type="number"],
        .devolucao-form select {
            padding: 8px;
            width: 150px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .devolucao-form button {
            padding: 10px 20px;
            border: none;
            background-color: #333;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .devolucao-form button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>

    <h1>Devolução de Ingressos</h1>

    <?php
    // Exibe as vendas do usuário para devolução
    $usuario_id = $_SESSION['usuario_id'];
    $consulta = $conexao->prepare("SELECT vendas.id AS venda_id, evento.nome AS evento_nome, setor.nome AS setor_nome, vendas.quantidade
                               FROM vendas
                               INNER JOIN setor ON vendas.setor_id = setor.id
                               INNER JOIN evento ON setor.evento_id = evento.id
                               WHERE vendas.usuario_id = ?");
    $consulta->execute([$usuario_id]);

    echo "<table>";
    echo "<tr><th>Evento</th><th>Setor</th><th>Quantidade Comprada</th><th>Ação</th></tr>";
    while ($linha = $consulta->fetch()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($linha['evento_nome']) . "</td>";
        echo "<td>" . htmlspecialchars($linha['setor_nome']) . "</td>";
        echo "<td>" . $linha['quantidade'] . "</td>";
        echo "<td><a href='devolucao.php?venda_id=" . $linha['venda_id'] . "'>Devolver</a></td>";
        echo "</tr>";
    }
    echo "</table>";

    if (isset($_GET['venda_id'])) {
        $venda_id = $_GET['venda_id'];

        // Exibe o formulário para devolução
        echo "<div class='devolucao-form'>
            <h2>Devolver Ingressos</h2>
            <form action='devolucao.php' method='POST'>
                <input type='hidden' name='venda_id' value='" . htmlspecialchars($venda_id) . "'>
                <label for='quantidade'>Quantidade de Ingressos a Devolver:</label>
                <input type='number' name='quantidade' min='1' required>
                <button type='submit'>Devolver</button>
            </form>
          </div>";
    }
    ?>
    <br>
    <form action="index.php">
        <button type="submit">Voltar</button>
    </form>
</body>

</html>