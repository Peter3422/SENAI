
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $animal_nome = $_POST['animal_nome'];
    $especie = $_POST['especie'];

    $dados = "$nome|$email|$telefone|$animal_nome|$especie\n";
    $arquivo = 'clientes.txt';

    $file = fopen($arquivo, 'a');
    if ($file) {
        fwrite($file, $dados);
        fclose($file);
        header('Location: index.php?status=sucesso');
        exit();
    } else {
        header('Location: index.php?status=erro');
    }
} else {
    echo "Método de requisição inválido";
}

$filename = 'clientes.txt';

if (!file_exists($filename)) {
    die('Arquivo não encontrado: ' . realpath($filename));
}

$handle = fopen($filename, "r");
if ($handle) {
    $header = fgets($handle);
    $headers = explode("|", trim($header));

    echo '<table border="1">';
    echo '<tr>';
    foreach ($headers as $header) {
        echo "<th>{$header}</th>";
    }
    echo '</tr>';

    while (($line = fgets($handle)) !== false) {
        $data = explode("|", trim($line));
        echo '<tr>';
        foreach ($data as $cell) {
            echo "<td>{$cell}</td>";
        }
        echo '</tr>';
    }

    echo '</table>';
    fclose($handle);
} else {
    echo 'Erro ao abrir o arquivo';
}
?>
