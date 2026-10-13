<?php
$cpf = $_POST['cpf'];
function validaCPF($cpf) {
    // Extrai somente os números
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);
    
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }
    
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    
    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    
    return true;
}
if (validaCPF($cpf)) {
    echo 'O cpf recebido é valido';
} else {
    echo 'O cpf recebido está incorreto, tente novamente';
}
$isValid = validaCPF($cpf);
?>
<html>
    <br>
    <?php
    if (!$isValid) {
        echo "<p style='color:red;'>O CPF recebido está incorreto, tente novamente</p>";
    } else {
        echo "<p style='color:green;'>O CPF recebido é válido</p>";
    }
    ?>
    <a href="index3.php" 
       style="padding: 10px 20px; text-decoration: none; color: white; background-color: <?php echo $isValid ? 'green' : 'red'; ?>; border: none; border-radius: 5px;">
       Tentar outro CPF
    </a>
    </html>