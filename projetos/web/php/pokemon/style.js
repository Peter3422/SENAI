function validarPontos(event) {
    event.preventDefault(); // Impede o envio do formulário

    // Obter os valores dos inputs
    const ataque1 = parseInt(document.querySelector('input[name="ataque1"]').value) || 0;
    const ataque2 = parseInt(document.querySelector('input[name="ataque2"]').value) || 0;
    const ataque3 = parseInt(document.querySelector('input[name="ataque3"]').value) || 0;
    const defesa1 = parseInt(document.querySelector('input[name="defesa1"]').value) || 0;
    const defesa2 = parseInt(document.querySelector('input[name="defesa2"]').value) || 0;
    const defesa3 = parseInt(document.querySelector('input[name="defesa3"]').value) || 0;

    // Calcular a soma total
    const totalAtaque = ataque1 + ataque2 + ataque3;
    const totalDefesa = defesa1 + defesa2 + defesa3;
    const totalPontos = totalAtaque + totalDefesa;

    // Verificar se a soma total é 100
    if (totalPontos === 100) {
        document.querySelector('form').submit(); // Enviar o formulário se a soma for 100
    } else {
        alert(`A soma total de Ataque e Defesa deve ser 100. Você ainda tem ${100 - totalPontos} pontos para distribuir.`); // Alerta se não for 100
    }
}