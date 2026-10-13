var numeroSorteado = Math.ceil(Math.random() * 100);
var tentativasAnt = "Tentativas Anteriores: ";
var numTentativas = 5;

function adivinhar() {
    var numeroDig = parseInt(document.getElementById("numeroDig").value);
    alert(numeroSorteado);
    numTentativas--;
    document.getElementById("numTentativas").innerHTML = "Tentativas restantes: " + numTentativas;
    tentativasAnt += numeroDig + " - ";
    document.getElementById("tentativasAnt").innerHTML = tentativasAnt.substr(0, tentativasAnt.length - 3);
    var mensagem = document.getElementById("tentativaAtual");
    if (numeroDig === numeroSorteado) {
        mensagem.innerHTML = "Acertou!";
        mensagem.style.color = "yellow";
    } else if (numTentativas === 0) {
        alert("Você esgotou suas tentativas! O número era " + numeroSorteado + ".");
        mensagem.style.color = "red";
        document.getElementById("numeroDig").disabled = true;
    } else if (numeroDig < numeroSorteado) {
        if (numeroDig >= numeroSorteado - 10) {
            mensagem.innerHTML = "O número sorteado está um pouco acima do número digitado!";
            mensagem.style.color = "orange";
        } else {
            mensagem.innerHTML = "O número sorteado está acima do número digitado!";
            mensagem.style.color = "red";
        }
    } else if (numeroDig > numeroSorteado) {
        if (numeroDig <= numeroSorteado + 10) {
            mensagem.innerHTML = "O número sorteado está um pouco abaixo do número digitado!";
            mensagem.style.color = "orange";
        } else {
            mensagem.innerHTML = "O número sorteado está abaixo do número digitado!";
            mensagem.style.color = "green";
        }
    }
}