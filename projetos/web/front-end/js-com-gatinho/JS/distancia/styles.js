function converterDistancia() {
    const milhas = parseFloat(document.getElementById('milhas').value);

    if (milhas > 0) {
        const quilometros = milhas / 0.6214;
        document.getElementById('resultado').innerText = `Distância em Quilômetros: ${quilometros.toFixed(2)} km`;
    } else {
        document.getElementById('resultado').innerText = 'Por favor, insira um valor válido.';
    }
}