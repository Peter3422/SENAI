<?php
$idade1 = 25;
echo "Olá, Mundo! " . $idade1 . "<br>", "snnda<br><br>";

$nome = "Maria";
$idade = 30;
$altura = 1.75;
$casado = false;

            echo "nome: " . $nome . "<br>";
echo "idade: " . $idade . "<br>";
echo "altura: " . $altura . "<br>";
echo "casado: " . ($casado ? "Sim" : "Não") . "<br><br>";

//na função a questao da variavel, ele precisa de um item predefinido doque ele espera, para depois receber oque ele vai colocar la
// dentro do () neste caso, ele pode ser quase qualquer coisa, como neste exemplo
function saudacao($sim)
{
    return "Olá, " . $sim . "!<br><br>";
}
// dentro do () é o que ele vai imprimir
echo saudacao("$nome");
echo saudacao("Carlos");

$numero = 10;

if ($numero > 0) {
    echo "O número é positivo<br><br>";
} else {
    echo "O número é negativo<br><br>";
}

for ($i = 0; $i <= 5; $i++) {
    echo "Número: " . $i . "<br>";
}

