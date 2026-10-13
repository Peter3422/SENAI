function converterMoeda() {
    const cotacao = parseFloat(document.getElementById('cotacao').value);
    const quantidade = parseFloat(document.getElementById('quantidade').value);

    if (cotacao > 0 && quantidade > 0) {
        const valorEmReais = cotacao * quantidade;
        document.getElementById('resultado').innerText = `Valor em Reais: R$ ${valorEmReais.toFixed(2)}`;
    } else {
        document.getElementById('resultado').innerText = 'Por favor, insira valores válidos.';
    }
}