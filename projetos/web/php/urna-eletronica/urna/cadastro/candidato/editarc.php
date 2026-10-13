<?php
include "C:\wamp64\www\urna\conecta_banco.php"; // Inclui o arquivo de conexão

// Verifica se o ID do candidato foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obter os dados do candidato
    $query = "SELECT * FROM candidato WHERE id_cand = '$id'";
    $result = mysqli_query($conexao, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $nome = $row['nome_cand'];
        $idade = $row['idade_cand'];
        $partido = $row['partido_cand'];
    } else {
        echo "Candidato não encontrado.";
        exit;
    }
} else {
    echo "ID não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Candidato</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #181818; /* Cor de fundo escura */
            color: #f4f4f4; /* Cor do texto clara */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #ffffff; /* Cor do título */
        }

        form {
            background-color: #2c2c2c; /* Fundo do formulário */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            margin: auto;
        }

        label {
            display: block; /* Faz o label ocupar toda a largura */
            margin-bottom: 5px; /* Espaço entre o label e o input */
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"],
        select {
            width: calc(100% - 20px); /* Ajusta a largura para caber no espaço */
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #444; /* Borda mais escura */
            background-color: #444; /* Fundo dos inputs */
            color: #f4f4f4; /* Texto claro nos inputs */
            font-size: 16px;
            margin-bottom: 15px; /* Espaço entre os campos */
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #007BFF; /* Borda azul ao focar */
            outline: none; /* Remove o contorno padrão */
        }

        input[type="submit"] {
            background-color: #007BFF; /* Azul padrão */
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Azul escuro ao passar o mouse */
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF; /* Azul padrão para links */
        }

        a:hover {
            text-decoration: underline; /* Sublinha ao passar o mouse */
        }
    </style>
</head>

<body>
    <h1>Editar Candidato</h1>
    <form method="POST" action="atualizarc.php">
        <input type="hidden" name="id_antigo" value="<?php echo htmlspecialchars($id); ?>">
        
        <label for="nomec">Nome:</label>
        <input type="text" id="nomec" name="nomec" value="<?php echo htmlspecialchars($nome); ?>" required>

        <label for="idadec">Idade:</label>
        <input type="number" id="idadec" name="idadec" value="<?php echo htmlspecialchars($idade); ?>" required min="18" max="80">

        <label for="partidoc">Partido:</label>
        <select id="partidoc" name="partidoc" required>
            <?php 
                $partidos = ["PT", "PSDB", "PSB", "PL", "MDB", "DEM", "PDT", "REDE", "PPS", "PV", "PSOL", "PROS", "Agir", "Avante", "Cidadania", "DC", "PCB", "PCO", "PSTU", "NOVO", "Republicanos", "Solidariedade", "Podemos"];
                foreach ($partidos as $p) {
                    $selected = ($p == $partido) ? 'selected' : '';
                    echo "<option value='$p' $selected>$p</option>";
                }
            ?>
        </select>

        <input type="submit" value="Atualizar">
    </form>

    <a href="/urna/opcoes/index.php">Voltar ao Menu Principal</a>

</body>

</html>

<?php mysqli_close($conexao); ?>