<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Eventos</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;

        }

        form {
            width: 400px;
            padding: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 6px;
        }

        .tabelas-container {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        .tabela-eventos {
            margin-bottom: 20px;
        }

        th,
        td {
            text-align: left;
        }
    </style>
</head>


<?php
include "C:/wamp64/www/faztudodobarreto/conectarbanco.php";

$idEvento = "";
$nomeEvento = "";
$dhEvento = "";
$inicioVendas = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idEvento"])) {
        $idEvento = $_POST["idEvento"];
    }

    if (isset($_POST["nomeEvento"])) {
        $nomeEvento = $_POST["nomeEvento"];
        $dhEvento = $_POST["dhEvento"];
        $inicioVendas = $_POST["inicioVendas"];
        $tipoBanco = $_POST["tipoBanco"];

        if ($tipoBanco == 'I') {
            $comandoSQL = $conexao->prepare(
                "INSERT INTO evento(nome, dataHora, inicioVendas) VALUES(:vNome, :vDataHora, :vInicioVendas);"
            );
            $comandoSQL->bindValue(":vNome", $nomeEvento);
            $comandoSQL->bindValue(":vDataHora", $dhEvento);
            $comandoSQL->bindValue(":vInicioVendas", $inicioVendas);
            $comandoSQL->execute();
        } else if ($tipoBanco == 'A') {
            $comandoSQL = $conexao->prepare(
                "UPDATE evento SET nome = :vNome, dataHora = :vDataHora, inicioVendas = :vInicioVendas WHERE id = :idEvento"
            );
            $comandoSQL->bindParam(":vNome", $nomeEvento);
            $comandoSQL->bindParam(":vDataHora", $dhEvento);
            $comandoSQL->bindParam(":vInicioVendas", $inicioVendas);
            $comandoSQL->bindParam(":idEvento", $idEvento);
            $comandoSQL->execute();
        } else if ($tipoBanco == 'E') {
            $comandoSQL = $conexao->prepare("DELETE FROM evento WHERE id = :idEvento");
            $comandoSQL->bindParam(":idEvento", $idEvento);
            $comandoSQL->execute();
        }
    }
}
?>

<body>
    <form action="#" method="post" id="formulario">
        <a href="/faztudodobarreto/Delete.php">DELETAR TUDO</a><br><br>
        <a href="cadastrodesetor.php">Cadastro de Setor</a>
        <input type="hidden" id="tipoBanco" name="tipoBanco" />
        <input type="hidden" id="idEvento" name="idEvento" value="<?php echo htmlspecialchars($idEvento); ?>" />
        <div>
            <label for="nomeEvento">Nome: </label>
            <input type="text" name="nomeEvento" id="nomeEvento" placeholder="Insira o nome do evento"
                value="<?php echo htmlspecialchars($nomeEvento); ?>" required>
        </div>
        <div>
            <label for="dhEvento">Data e hora: </label>
            <input type="datetime-local" name="dhEvento" id="dhEvento"
                value="<?php echo htmlspecialchars($dhEvento); ?>" required>
        </div>
        <div>
            <label for="inicioVendas">Início das vendas: </label>
            <input type="datetime-local" name="inicioVendas" id="inicioVendas"
                value="<?php echo htmlspecialchars($inicioVendas); ?>" required>
        </div><br>
        <?php
        if (isset($_POST["tipoBanco"])) {
            if ($_POST["tipoBanco"] == 'C') {
                ?>
                <input type='button' value='Alterar' onclick="banco('A', <?php echo $idEvento; ?>)" />
                <input type='button' value='Excluir' onclick="banco('E', <?php echo $idEvento; ?>)" />
                <?php
            } else {
                ?>
                <input type="button" value="Cadastrar" onclick="banco('I', 0)" />
                <?php
            }
        } else {
            ?>
            <input type="button" value="Cadastrar" onclick="banco('I', 0)" />
            <?php
        }
        ?>
    </form>
    <?php
// Primeira consulta para obter os eventos
$comandoSQL = $conexao->query("SELECT * FROM evento");

// Exibindo os eventos em uma tabela
echo "<div class='tabelas-container'>";
echo "<table class='tabela-eventos'>";
echo "<tr><th>ID</th><th>Nome</th><th>Data Evento</th><th>Início Vendas</th><th>Ações</th></tr>";

while ($linhaBD = $comandoSQL->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($linhaBD["id"]) . "</td>";
    echo "<td>" . htmlspecialchars($linhaBD["nome"]) . "</td>";
    echo "<td>" . htmlspecialchars($linhaBD["dataHora"]) . "</td>";
    echo "<td>" . htmlspecialchars($linhaBD["inicioVendas"]) . "</td>";
    echo "<td><input type='button' value='Editar' onclick=\"banco('C', " . $linhaBD["id"] . ")\" /></td>";
    echo "</tr>";
}
echo "</table>";

// Segunda consulta para obter o total de ingressos por evento
$comandoSQL = $conexao->query("SELECT evento_id, SUM(ingressos) AS total_ingressos FROM setor GROUP BY evento_id");

// Exibindo o total de ingressos por evento
echo "<table class='tabela-ingressos'>";
echo "<tr><th>Evento ID</th><th>Total de Ingressos</th></tr>";

while ($linhaBD = $comandoSQL->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($linhaBD["evento_id"]) . "</td>";
    echo "<td>" . htmlspecialchars($linhaBD["total_ingressos"]) . "</td>";
    echo "</tr>";
}
echo "</table>";

// Consulta para exibir os ingressos disponíveis em cada setor
$consulta = $conexao->query("SELECT evento.nome AS evento_nome, setor.nome AS setor_nome, setor.ingressos FROM setor INNER JOIN evento ON setor.evento_id = evento.id");

echo "<table class='tabela-ingressos-disponiveis'>";
echo "<tr><th>Evento</th><th>Setor</th><th>Ingressos Disponíveis</th></tr>";

while ($linha = $consulta->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($linha['evento_nome']) . "</td>";
    echo "<td>" . htmlspecialchars($linha['setor_nome']) . "</td>";
    echo "<td>" . ($linha['ingressos'] > 0 ? $linha['ingressos'] : "<span style='color:red;'>Esgotado</span>") . "</td>";
    echo "</tr>";
}
echo "</table>";

// Consulta para exibir as vendas realizadas, com data formatada
$consulta = $conexao->query("
    SELECT 
        evento.nome AS evento_nome, 
        setor.nome AS setor_nome, 
        vendas.quantidade, 
        DATE_FORMAT(vendas.data, '%Y-%m-%d') AS data_venda
    FROM vendas
    INNER JOIN setor ON vendas.setor_id = setor.id
    INNER JOIN evento ON setor.evento_id = evento.id
    ORDER BY vendas.data DESC
");

echo "<table class='tabela-vendas'>";
echo "<tr><th>Evento</th><th>Setor</th><th>Quantidade</th><th>Data da Venda</th></tr>";

while ($linha = $consulta->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($linha['evento_nome']) . "</td>";
    echo "<td>" . htmlspecialchars($linha['setor_nome']) . "</td>";
    echo "<td>" . $linha['quantidade'] . "</td>";
    echo "<td>" . $linha['data_venda'] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "</div>"; 
?>

    <script>
        function banco(operacao, idev) {
            document.getElementById("tipoBanco").value = operacao;
            document.getElementById("idEvento").value = idev;
            document.getElementById("formulario").submit();
        }
    </script>
</body>

</html>