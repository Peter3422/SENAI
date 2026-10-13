function converterTemperatura() {
    const fahrenheit = parseFloat(document.getElementById('fahrenheit').value);

    if (!isNaN(fahrenheit)) {
        const celsius = (fahrenheit - 32) * (5 / 9);
        document.getElementById('resultado').innerText = `Temperatura em Celsius: ${celsius.toFixed(2)}°C`;
    } else {
        document.getElementById('resultado').innerText = 'Por favor, insira um valor válido.';
    }
}