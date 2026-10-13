<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Resultado do Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
        }
        h2 {
            color: #ffffff;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 1);
        }
        .section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #1e1e1e;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }
        .item {
            margin: 5px 0;
        }
        strong {
            color: yellow;
        }
    </style>
</head>

<body>

    <?php
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $datan = $_POST['datan'];
    $end = $_POST['end'];

    $esc = $_POST['esc'];
    $anoi = $_POST['anoi'];
    $anof = $_POST['anof'];

    $emp = $_POST['emp'];
    $anoie = $_POST['anoie'];
    $anofe = $_POST['anofe'];
    $carg = $_POST['carg'];
    ?>

    <div class="section">
        <h2>Dados Pessoais</h2>
        <div class="item"><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></div>
        <div class="item"><strong>Idade:</strong> <?php echo htmlspecialchars($idade); ?></div>
        <div class="item"><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($datan); ?></div>
        <div class="item"><strong>Endereço:</strong> <?php echo htmlspecialchars($end); ?></div>
    </div>

    <div class="section">
        <h2>Educação</h2>
        <div class="item"><strong>Escola:</strong> <?php echo htmlspecialchars($esc); ?></div>
        <div class="item"><strong>Ano de Início:</strong> <?php echo htmlspecialchars($anoi); ?></div>
        <div class="item"><strong>Ano de Fim:</strong> <?php echo htmlspecialchars($anof); ?></div>
    </div>

    <div class="section">
        <h2>Dados Profissionais</h2>
        <div class="item"><strong>Empresa:</strong> <?php echo htmlspecialchars($emp); ?></div>
        <div class="item"><strong>Ano de Início:</strong> <?php echo htmlspecialchars($anoie); ?></div>
        <div class="item"><strong>Ano de Fim:</strong> <?php echo htmlspecialchars($anofe); ?></div>
        <div class="item"><strong>Cargo:</strong> <?php echo htmlspecialchars($carg); ?></div>
    </div>

</body>

</html>