function calcularCustoConsumidor() {
    const custoFabrica = parseFloat(document.getElementById('custoFabrica').value);

    if (custoFabrica > 0) {
        const percentagemDistribuidor = 0.28;
        const percentagemImpostos = 0.45;
        const custoConsumidor = custoFabrica * (1 + percentagemDistribuidor + percentagemImpostos);
        document.getElementById('resultado').innerText = `Custo ao Consumidor: R$ ${custoConsumidor.toFixed(2)}`;
    } else {
        document.getElementById('resultado').innerText = 'Por favor, insira um valor válido para o custo de fábrica.';
    }
}