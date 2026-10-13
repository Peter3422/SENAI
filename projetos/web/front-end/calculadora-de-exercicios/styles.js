// Função para validar entrada como número inteiro positivo
function validarEntrada(valor) {
    return Number.isInteger(Number(valor)) && Number(valor) > 0;
}

function resolverExpressao() {
    let a = document.getElementById('a1_a').value;
    let b = document.getElementById('a1_b').value;
    let c = document.getElementById('a1_c').value;
    if (validarEntrada(a) && validarEntrada(b) && validarEntrada(c)) {
        let resultado = (Number(a) + Number(b)) / Number(c);
        alert(`O resultado de (${a} + ${b}) / ${c} é: ${resultado}`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.1 – Resolva a expressão: ( a + b ) / c
function resolverExpressao() {
    let a = prompt("Digite o valor de a:");
    let b = prompt("Digite o valor de b:");
    let c = prompt("Digite o valor de c:");

    if (validarEntrada(a) && validarEntrada(b) && validarEntrada(c)) {
        let resultado = (Number(a) + Number(b)) / Number(c);
        alert(`O resultado de (${a} + ${b}) / ${c} é: ${resultado}`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.2 – Calcular tempo de viagem
function calcularTempoViagem() {
    let velocidade = prompt("Digite a velocidade do carro (km/h):");
    let distancia = prompt("Digite a distância a ser percorrida (km):");

    if (validarEntrada(velocidade) && validarEntrada(distancia)) {
        let tempo = Number(distancia) / Number(velocidade);
        alert(`O tempo necessário para percorrer ${distancia} km a ${velocidade} km/h é: ${tempo.toFixed(2)} horas`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.3 – Calcular reajuste salarial
function calcularReajusteSalarial() {
    let nome = prompt("Digite o nome da pessoa:");
    let salario = prompt("Digite o salário atual:");
    let percentual = prompt("Digite o percentual de reajuste (%):");

    if (validarEntrada(salario) && validarEntrada(percentual)) {
        let novoSalario = Number(salario) * (1 + Number(percentual) / 100);
        alert(`${nome}, seu novo salário é: R$ ${novoSalario.toFixed(2)}`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos para salário e percentual.");
    }
}

// A.4 – Calcular pontos de um time de futebol
function calcularPontosFutebol() {
    let nomeTime = prompt("Digite o nome do time:");
    let vitorias = prompt("Digite o número de vitórias:");
    let empates = prompt("Digite o número de empates:");

    if (validarEntrada(vitorias) && validarEntrada(empates)) {
        let pontos = Number(vitorias) * 3 + Number(empates);
        alert(`O time ${nomeTime} tem um total de ${pontos} pontos.`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos para vitórias e empates.");
    }
}

// A.5 – Mostrar n-1 e n+1
function mostrarAntecessorSucessor() {
    let n = prompt("Digite um número inteiro positivo:");

    if (validarEntrada(n)) {
        alert(`Para n = ${n}:\nn - 1 = ${Number(n) - 1}\nn + 1 = ${Number(n) + 1}`);
    } else {
        alert("Por favor, insira apenas um número inteiro positivo.");
    }
}

// A.6 – Calcular tempo de voo (com seleção de aviões)
function calcularTempoVoo() {
    let distancia = prompt("Digite a distância (km):");
    let avioes = {
        "747-300": 900,
        "A380": 1185,
        "787 Dreamliner": 903,
        "A350": 945,
        "777": 892,
        "A330": 871
    };

    let aviao = prompt("Escolha o modelo de avião:\n" + Object.keys(avioes).join("\n"));

    if (validarEntrada(distancia) && avioes[aviao]) {
        let tempo = Number(distancia) / avioes[aviao];
        alert(`O tempo de voo para ${distancia} km em um ${aviao} é: ${tempo.toFixed(2)} horas`);
    } else {
        alert("Entrada inválida. Verifique a distância e o modelo do avião.");
    }
}

// A.7 – Calcular viagens de caminhão para transporte de laranjas
function calcularViagensLaranjas() {
    let numCaminhoes = prompt("Digite o número de caminhões:");
    let numAlqueires = prompt("Digite o número de alqueires:");
    let caminhoes = {
        "Padrão": 18,
        "Volvo FH": 20,
        "Scania R450": 22,
        "Mercedes-Benz Actros": 25,
        "MAN TGX": 23,
        "DAF XF": 21
    };

    let modeloCaminhao = prompt("Escolha o modelo de caminhão:\n" + Object.keys(caminhoes).join("\n"));

    if (validarEntrada(numCaminhoes) && validarEntrada(numAlqueires) && caminhoes[modeloCaminhao]) {
        let producaoTotal = Number(numAlqueires) * 250; // 250 toneladas por alqueire
        let capacidadeTotal = Number(numCaminhoes) * caminhoes[modeloCaminhao];
        let viagensNecessarias = Math.ceil(producaoTotal / capacidadeTotal);
        alert(`Serão necessárias ${viagensNecessarias} viagens para transportar toda a colheita.`);
    } else {
        alert("Entrada inválida. Verifique os números e o modelo do caminhão.");
    }
}

// A.8 – Calcular área e volume de um cilindro
function calcularCilindro() {
    let raio = prompt("Digite o raio do cilindro (cm):");
    let altura = prompt("Digite a altura do cilindro (cm):");

    if (validarEntrada(raio) && validarEntrada(altura)) {
        let area = 2 * Math.PI * Number(raio) * (Number(raio) + Number(altura));
        let volume = Math.PI * Math.pow(Number(raio), 2) * Number(altura);
        alert(`Área do cilindro: ${area.toFixed(2)} cm²\nVolume do cilindro: ${volume.toFixed(2)} cm³`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.9 – Calcular aumento de 5% no preço de uma mercadoria
function calcularAumentoPreco() {
    let nome = prompt("Digite o nome da mercadoria:");
    let preco = prompt("Digite o preço da mercadoria:");

    if (validarEntrada(preco)) {
        let novoPreco = Number(preco) * 1.05;
        alert(`${nome}\nPreço original: R$ ${Number(preco).toFixed(2)}\nNovo preço: R$ ${novoPreco.toFixed(2)}`);
    } else {
        alert("Por favor, insira um preço válido (número inteiro positivo).");
    }
}

// A.10 – Calcular participação de eleitores
function calcularParticipacaoEleitores() {
    let cidade = prompt("Digite o nome da cidade:");
    let totalEleitores = prompt("Digite o número total de eleitores:");
    let votosApurados = prompt("Digite o número total de votos apurados:");

    if (validarEntrada(totalEleitores) && validarEntrada(votosApurados)) {
        let participacao = (Number(votosApurados) / Number(totalEleitores)) * 100;
        alert(`A participação dos eleitores em ${cidade} foi de ${participacao.toFixed(2)}%`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.11 – Calcular densidade de uma barra de calcário
function calcularDensidade() {
    let massa = prompt("Digite a massa da barra de calcário (kg):");
    let volume = prompt("Digite o volume da barra de calcário (m³):");

    if (validarEntrada(massa) && validarEntrada(volume)) {
        let densidade = Number(massa) / Number(volume);
        alert(`A densidade da barra de calcário é: ${densidade.toFixed(2)} kg/m³`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.12 – Calcular o resto da divisão
function calcularRestoDivisao() {
    let dividendo = prompt("Digite o primeiro valor (dividendo):");
    let divisor = prompt("Digite o segundo valor (divisor):");

    if (validarEntrada(dividendo) && validarEntrada(divisor)) {
        let resto = Number(dividendo) % Number(divisor);
        alert(`O resto da divisão de ${dividendo} por ${divisor} é: ${resto}`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.13 – Calcular quantidade e custo de pedra mineira
function calcularPedraMineira() {
    let area = prompt("Digite a área total a ser revestida (m²):");

    if (validarEntrada(area)) {
        let quilosPorM2 = 10 / 3.7;
        let quilosNecessarios = Number(area) * quilosPorM2;
        let custoTotal = quilosNecessarios * (130 / 10);
        alert(`Quilos necessários: ${quilosNecessarios.toFixed(2)} kg\nCusto total: R$ ${custoTotal.toFixed(2)}`);
    } else {
        alert("Por favor, insira um número inteiro positivo para a área.");
    }
}

// A.14 – Somar dois valores inteiros
function somarValores() {
    let valor1 = prompt("Digite o primeiro valor:");
    let valor2 = prompt("Digite o segundo valor:");

    if (validarEntrada(valor1) && validarEntrada(valor2)) {
        let soma = Number(valor1) + Number(valor2);
        alert(`A soma de ${valor1} e ${valor2} é: ${soma}`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.16 – Multiplicar dois valores inteiros
function multiplicarValores() {
    let valor1 = prompt("Digite o primeiro valor:");
    let valor2 = prompt("Digite o segundo valor:");

    if (validarEntrada(valor1) && validarEntrada(valor2)) {
        let produto = Number(valor1) * Number(valor2);
        alert(`O produto de ${valor1} e ${valor2} é: ${produto}`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.17 – Calcular o quadrado de um valor
function calcularQuadrado() {
    let valor = prompt("Digite um valor inteiro:");

    if (validarEntrada(valor)) {
        let quadrado = Math.pow(Number(valor), 2);
        alert(`O quadrado de ${valor} é: ${quadrado}`);
    } else {
        alert("Por favor, insira apenas um número inteiro positivo.");
    }
}

// A.18 – Calcular o cubo de um valor
function calcularCubo() {
    let valor = prompt("Digite um valor inteiro:");

    if (validarEntrada(valor)) {
        let cubo = Math.pow(Number(valor), 3);
        alert(`O cubo de ${valor} é: ${cubo}`);
    } else {
        alert("Por favor, insira apenas um número inteiro positivo.");
    }
}

// A.19 – Calcular a metade de um valor
function calcularMetade() {
    let valor = prompt("Digite um valor inteiro:");

    if (validarEntrada(valor)) {
        let metade = Number(valor) / 2;
        alert(`A metade de ${valor} é: ${metade}`);
    } else {
        alert("Por favor, insira apenas um número inteiro positivo.");
    }
}

// A.20 – Calcular um treze avos de um valor
function calcularTrezeAvos() {
    let valor = prompt("Digite um valor inteiro:");

    if (validarEntrada(valor)) {
        let trezeAvos = Number(valor) / 13;
        alert(`Um treze avos de ${valor} é: ${trezeAvos.toFixed(2)}`);
    } else {
        alert("Por favor, insira apenas um número inteiro positivo.");
    }
}

// A.21 – Calcular o volume de um paralelepípedo
function calcularVolumeParalelepipedo() {
    let altura = prompt("Digite a altura (cm):");
    let largura = prompt("Digite a largura (cm):");
    let comprimento = prompt("Digite o comprimento (cm):");

    if (validarEntrada(altura) && validarEntrada(largura) && validarEntrada(comprimento)) {
        let volume = Number(altura) * Number(largura) * Number(comprimento);
        alert(`O volume do paralelepípedo é: ${volume} cm³`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.22 – Calcular a área de um círculo
function calcularAreaCirculo() {
    let raio = prompt("Digite o raio do círculo (mm):");

    if (validarEntrada(raio)) {
        let area = Math.PI * Math.pow(Number(raio), 2);
        alert(`A área do círculo é: ${area.toFixed(2)} mm²`);
    } else {
        alert("Por favor, insira apenas um número inteiro positivo para o raio.");
    }
}

// A.23 – Calcular a área de um triângulo
function calcularAreaTriangulo() {
    let base = prompt("Digite a base do triângulo:");
    let altura = prompt("Digite a altura do triângulo:");

    if (validarEntrada(base) && validarEntrada(altura)) {
        let area = (Number(base) * Number(altura)) / 2;
        alert(`A área do triângulo é: ${area}`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.24 – Converter polegadas para milímetros
function converterPolegadasMilimetros() {
    let polegadas = prompt("Digite o valor em polegadas:");

    if (validarEntrada(polegadas)) {
        let milimetros = Number(polegadas) * 25.4;
        alert(`${polegadas} polegadas equivalem a ${milimetros.toFixed(2)} mm`);
    } else {
        alert("Por favor, insira apenas um número inteiro positivo.");
    }
}
// A.25 – Calcular média geométrica
function calcularMediaGeometrica() {
    let valor1 = prompt("Digite o primeiro valor:");
    let valor2 = prompt("Digite o segundo valor:");
    if (validarEntrada(valor1) && validarEntrada(valor2)) {
        let mediaGeometrica = Math.sqrt(Number(valor1) * Number(valor2));
        alert(`A média geométrica de ${valor1} e ${valor2} é: ${mediaGeometrica.toFixed(2)}`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.26 – Calcular desconto em mercadoria
function calcularDescontoMercadoria() {
    let nome = prompt("Digite o nome da mercadoria:");
    let preco = prompt("Digite o preço da mercadoria:");
    let percentualDesconto = prompt("Digite o percentual de desconto (%):");
    if (validarEntrada(preco) && validarEntrada(percentualDesconto)) {
        let desconto = Number(preco) * (Number(percentualDesconto) / 100);
        let precoFinal = Number(preco) - desconto;
        alert(`Mercadoria: ${nome}\nPreço original: R$ ${Number(preco).toFixed(2)}\nValor do desconto: R$ ${desconto.toFixed(2)}\nPreço final: R$ ${precoFinal.toFixed(2)}`);
    } else {
        alert("Por favor, insira valores válidos para preço e percentual de desconto.");
    }
}

// A.27 – Converter Fahrenheit para Celsius
function converterFahrenheitCelsius() {
    let fahrenheit = prompt("Digite a temperatura em Fahrenheit:");
    if (validarEntrada(fahrenheit)) {
        let celsius = (Number(fahrenheit) - 32) * 5 / 9;
        alert(`${fahrenheit}°F é igual a ${celsius.toFixed(2)}°C`);
    } else {
        alert("Por favor, insira um valor válido para a temperatura.");
    }
}

// A.28 – Calcular IMC
function calcularIMC() {
    let peso = prompt("Digite o peso em kg:");
    let altura = prompt("Digite a altura em metros:");
    if (validarEntrada(peso) && Number(altura) > 0) {
        let imc = Number(peso) / Math.pow(Number(altura), 2);
        alert(`Seu IMC é: ${imc.toFixed(2)}`);
    } else {
        alert("Por favor, insira valores válidos para peso e altura.");
    }
}

// A.29 – Calcular área do retângulo
function calcularAreaRetangulo() {
    let base = prompt("Digite a base do retângulo:");
    let altura = prompt("Digite a altura do retângulo:");
    if (validarEntrada(base) && validarEntrada(altura)) {
        let area = Number(base) * Number(altura);
        alert(`A área do retângulo é: ${area}`);
    } else {
        alert("Por favor, insira apenas números inteiros positivos.");
    }
}

// A.30 – Calcular raiz quadrada
function calcularRaizQuadrada() {
    let numero = prompt("Digite um número inteiro:");
    if (validarEntrada(numero)) {
        let raiz = Math.sqrt(Number(numero));
        alert(`A raiz quadrada de ${numero} é: ${raiz.toFixed(2)}`);
    } else {
        alert("Por favor, insira apenas um número inteiro positivo.");
    }
}

// A.31 – Converter libras para quilos
function converterLibrasQuilos() {
    let libras = prompt("Digite o peso em libras (lbs):");
    if (validarEntrada(libras)) {
        let quilos = Number(libras) * 0.45;
        alert(`${libras} lbs é igual a ${quilos.toFixed(2)} kg`);
    } else {
        alert("Por favor, insira um valor válido para o peso em libras.");
    }
}