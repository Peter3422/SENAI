function calcularMedia() {
    const nota1 = parseFloat(document.getElementById('nota1').value);
    const nota2 = parseFloat(document.getElementById('nota2').value);
    const nota3 = parseFloat(document.getElementById('nota3').value);

    if (!isNaN(nota1) && !isNaN(nota2) && !isNaN(nota3)) {
        const mediaPonderada = (nota1 * 2 + nota2 * 3 + nota3 * 5) / 10;
        document.getElementById('resultado').innerText = `Média Final: ${mediaPonderada.toFixed(2)}`;
    } else {
        document.getElementById('resultado').innerText = 'Por favor, insira valores válidos para todas as notas.';
    }
}