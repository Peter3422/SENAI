<?php
session_start();

// Verificação da sessão completa (username e usuario_id)
if (!isset($_SESSION['username']) || !isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include "C:/wamp64/www/faztudodobarreto/conectarbanco.php";

// Função para realizar a compra
function realizarCompra($usuario_id, $setor_id, $quantidade)
{
    global $conexao;

    // Verifica a quantidade de ingressos disponíveis no setor
    $consulta = $conexao->prepare("SELECT ingressos FROM setor WHERE id = ?");
    $consulta->execute([$setor_id]);
    $setor = $consulta->fetch();

    if (!$setor || $setor['ingressos'] < $quantidade) {
        return false; // Setor não encontrado ou ingressos insuficientes
    }

    // Registra a venda
    $consulta = $conexao->prepare("INSERT INTO vendas (usuario_id, setor_id, quantidade) VALUES (?, ?, ?)");
    $consulta->execute([$usuario_id, $setor_id, $quantidade]);

    // Atualiza a quantidade de ingressos no setor
    $consulta = $conexao->prepare("UPDATE setor SET ingressos = ingressos - ? WHERE id = ?");
    $consulta->execute([$quantidade, $setor_id]);

    return true;
}

// Quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $setor_id = $_POST['setor_id'];
    $quantidade = $_POST['quantidade'];

    if (realizarCompra($usuario_id, $setor_id, $quantidade)) {
        echo "<h2>Compra realizada com sucesso!</h2>";
    } else {
        echo "<h2 style='color:red;'>Ingressos insuficientes disponíveis ou setor inválido!</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 20px;
            background-color: white;
            color: #333;
            font-family: Arial, sans-serif;
        }

        #user-info {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 15px;
            width: 200px;
            text-align: center;
        }

        .plano-fundo {
            padding: 100px 20px;
            z-index: 1;
        }

        .tabela-ingressos {
            width: 40%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabela-ingressos th,
        .tabela-ingressos td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            background-color: white;
        }

        .compra-centro {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            text-align: center;
        }

        .titulo-comprar {
            margin-bottom: 15px;
            font-size: 24px;
            padding: 10px 20px;
            display: inline-block;
        }

        .compra-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 320px;
            margin: 0 auto;
        }

        .compra-container label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        .compra-container select,
        .compra-container input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Novo Estilo para a devolução */
        .devolucao-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 10px;
        }

        .devolucao-link {
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
            margin-bottom: 15px;
            /* Espaçamento entre o link de devolução e o botão */
        }

        .devolucao-link:hover {
            color: #0056b3;
        }

        /* Estilizando o botão de compra */
        .comprar-btn {
            background-color:rgb(0, 0, 0);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .comprar-btn:hover {
            background-color:rgb(68, 68, 68);
        }

    </style>
</head>

<body>

    <div id="user-info">
        <h3>Bem-vindo,<br><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
        <form action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>

    <h1>Venda de Ingressos</h1>
    <div class="plano-fundo">
        <table class='tabela-ingressos'>
            <tr>
                <th>Evento</th>
                <th>Setor</th>
                <th>Ingressos Disponíveis</th>
            </tr>
            <?php
            $consulta = $conexao->query("SELECT evento.nome AS evento_nome, setor.nome AS setor_nome, setor.ingressos FROM setor INNER JOIN evento ON setor.evento_id = evento.id");
            while ($linha = $consulta->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($linha['evento_nome']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['setor_nome']) . "</td>";
                echo "<td>" . ($linha['ingressos'] > 0 ? $linha['ingressos'] : "<span style='color:red;'>Esgotado</span>") . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="compra-centro">
        <h2 class="titulo-comprar">Comprar Ingressos</h2>

        <div class="compra-container">
            <form action="" method="post">
                <label for="setor_id">Selecione o Setor:</label>
                <select name="setor_id" id="setor_id" required>
                    <?php
                    $consulta = $conexao->query("SELECT setor.id, evento.nome AS evento_nome, setor.nome AS setor_nome, setor.ingressos FROM setor INNER JOIN evento ON setor.evento_id = evento.id WHERE setor.ingressos > 0");
                    while ($linha = $consulta->fetch()) {
                        echo "<option value='" . $linha['id'] . "'>" . htmlspecialchars($linha['evento_nome'] . " - " . $linha['setor_nome'] . " (" . $linha['ingressos'] . " disponíveis)") . "</option>";
                    }
                    ?>
                </select>

                <label for="quantidade">Quantidade de Ingressos:</label>
                <input type="number" name="quantidade" id="quantidade" min="1" required>

                <div class="devolucao-container">
                    <a href="devolucao.php" class="devolucao-link">Devolução?</a>
                </div>

                <button type="submit" class="comprar-btn">Comprar</button>

            </form>
        </div>
    </div>

</body>

</html>
