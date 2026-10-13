function calcularValorTotal() {
    const ipi = parseFloat(document.getElementById('ipi').value);
    const valor1 = parseFloat(document.getElementById('valor1').value);
    const quantidade1 = parseInt(document.getElementById('quantidade1').value);
    const valor2 = parseFloat(document.getElementById('valor2').value);
    const quantidade2 = parseInt(document.getElementById('quantidade2').value);

    if (!isNaN(ipi) && !isNaN(valor1) && !isNaN(quantidade1) && !isNaN(valor2) && !isNaN(quantidade2)) {
        const valorTotal = (valor1 * quantidade1 + valor2 * quantidade2) * (1 + ipi / 100);
        document.getElementById('resultado').innerText = `Valor Total a ser Pago: R$ ${valorTotal.toFixed(2)}`;
    } else {
        document.getElementById('resultado').innerText = 'Por favor, preencha todos os campos corretamente.';
    }
}