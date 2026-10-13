<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Setor</title>
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

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 6px;
        }

        table {
            margin-top: 20px;
        }
    </style>
</head>
<?php
include "C:/wamp64/www/faztudodobarreto/conectarbanco.php";

$idSetor = "";
$nomeSetor = "";
$evento_id = "";
$tipoBanco = "";
$ingressos = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idSetor"])) {
        $idSetor = $_POST["idSetor"];
    }

    if (isset($_POST["tipoBanco"])) {
        $tipoBanco = $_POST["tipoBanco"];

        // Se clicou em "Editar", buscar os dados do banco
        if ($tipoBanco == 'C' && !empty($idSetor)) {
            $stmt = $conexao->prepare("SELECT * FROM setor WHERE id = :id");
            $stmt->bindParam(":id", $idSetor);
            $stmt->execute();
            $setor = $stmt->fetch();
            if ($setor) {
                $nomeSetor = $setor["nome"];
                $evento_id = $setor["evento_id"];
                $ingressos = $setor["ingressos"];
            }
        }

        // Se for Inserir, Alterar ou Excluir
        if (in_array($tipoBanco, ['I', 'A', 'E'])) {
            if (isset($_POST["nomeSetor"])) {
                $nomeSetor = $_POST["nomeSetor"];
            }
            if (isset($_POST["evento_id"])) {
                $evento_id = $_POST["evento_id"];
            }
            if (isset($_POST["ingressos"])) {
                $ingressos = $_POST["ingressos"];
            }

            if ($tipoBanco == 'I') {
                $comandoSQL = $conexao->prepare(
                    "INSERT INTO setor(nome, evento_id, ingressos) VALUES(:vNomeSetor, :vEventoId, :vIngressos);"
                );
                $comandoSQL->bindValue(":vNomeSetor", $nomeSetor);
                $comandoSQL->bindValue(":vEventoId", $evento_id);
                $comandoSQL->bindValue(":vIngressos", $ingressos);
                $comandoSQL->execute();
            } elseif ($tipoBanco == 'A') {
                $comandoSQL = $conexao->prepare(
                    "UPDATE setor SET nome = :vNomeSetor, evento_id = :vEventoId, ingressos = :vIngressos WHERE id = :idSetor"
                );
                $comandoSQL->bindParam(":vNomeSetor", $nomeSetor);
                $comandoSQL->bindParam(":vEventoId", $evento_id);
                $comandoSQL->bindParam(":vIngressos", $ingressos);
                $comandoSQL->bindParam(":idSetor", $idSetor);
                $comandoSQL->execute();                
            } elseif ($tipoBanco == 'E') {
                $comandoSQL = $conexao->prepare("DELETE FROM setor WHERE id = :idSetor");
                $comandoSQL->bindParam(":idSetor", $idSetor);
                $comandoSQL->execute();
            }
        }
    }
}
?>

<body>
    <form action="#" method="post" id="formulario">
        <a href="/faztudodobarreto/evento/cadastrodoevento.php">Voltar</a>
        <input type="hidden" id="tipoBanco" name="tipoBanco" />
        <input type="hidden" id="idSetor" name="idSetor" value="<?php echo htmlspecialchars($idSetor); ?>" />

        <div>
            <label for="nomeSetor">Nome do Setor:</label>
            <input type="text" name="nomeSetor" id="nomeSetor" placeholder="Insira o nome do setor"
                value="<?php echo htmlspecialchars($nomeSetor); ?>" required>
        </div>
        <div>
            <label for="ingressos">Qnt de Ingressos</label>
            <input type="number" name="ingressos" id="ingressos" placeholder="Insira a quantidade"
                value="<?php echo htmlspecialchars($ingressos); ?>" required>
        </div>
        <div>
            <label for="evento_id">Selecione o Evento:</label>
            <select name="evento_id" id="evento_id" required>
                <?php
                $comandoSQL = $conexao->query("SELECT * FROM evento");
                while ($linhaBD = $comandoSQL->fetch()) {
                    $selected = ($linhaBD['id'] == $evento_id) ? "selected" : "";
                    echo "<option value='" . $linhaBD['id'] . "' $selected>" . htmlspecialchars($linhaBD['nome']) . "</option>";
                }
                ?>
            </select>
        </div><br>

        <?php if ($tipoBanco == 'C'): ?>
            <input type="button" value="Alterar" onclick="banco('A', <?php echo $idSetor; ?>)" />
            <input type="button" value="Excluir" onclick="banco('E', <?php echo $idSetor; ?>)" />
        <?php else: ?>
            <input type="button" value="Cadastrar" onclick="banco('I', 0)" />
        <?php endif; ?>
    </form>

    <?php
    $comandoSQL = $conexao->query("SELECT * FROM setor");
    echo "<table>";
    echo "<tr><th>ID</th><th>Nome</th><th>Evento ID</th><th>Quantidade</th><th>Ações</th></tr>";
    while ($linhaBD = $comandoSQL->fetch()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($linhaBD["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($linhaBD["nome"]) . "</td>";
        echo "<td>" . htmlspecialchars($linhaBD["evento_id"]) . "</td>";
        echo "<td>" . htmlspecialchars($linhaBD["ingressos"]) . "</td>";
        echo "<td><input type='button' value='Editar' onclick=\"banco('C', " . $linhaBD["id"] . ")\" /></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

    <script>
        function banco(operacao, idSetor) {
            document.getElementById("tipoBanco").value = operacao;
            document.getElementById("idSetor").value = idSetor;
            document.getElementById("formulario").submit();
        }
    </script>
</body>

</html>
