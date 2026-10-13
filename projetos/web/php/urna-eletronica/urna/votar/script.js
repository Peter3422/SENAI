function playSound(type) {
    let sound;
    switch(type) {
        case 'click':
            sound = document.getElementById('click-sound');
            break;
        case 'confirmar':
            sound = document.getElementById('confirm-sound');
            break;
    }
    if (sound) {
        sound.currentTime = 0; // Recomeça o som
        sound.play().catch(function(error) {
            console.error("Erro ao reproduzir som:", error);
        });
    }
}

// Função para digitar o número e atualizar o campo oculto
function digitar(numero) {
    const votoInput = document.getElementById('voto');
    // Atualiza o valor do campo oculto
    votoInput.value += numero;
    
    // Atualiza a tela (opcional)
    const display = document.getElementById('display');
    display.querySelector('.divisao1').innerText = votoInput.value;
}

// Função para corrigir (limpar) o voto
function corrigir() {
    const votoInput = document.getElementById('voto');
    votoInput.value = '';
    
    // Limpa a tela
    const display = document.getElementById('display');
    display.querySelector('.divisao1').innerText = '';
}

// Função para confirmar o voto
function confirmarVoto() {
    playSound('confirmar'); // Toca o som de confirmação
    const form = document.querySelector('.teclado-form');
    
    // Aguarda um pequeno tempo para garantir que o som toque antes de enviar
    setTimeout(() => {
        form.submit(); // Envia o formulário
    }, 750); // 500 milissegundos (ajuste conforme necessário)
}

// Função para votar em branco
function votarBranco() {
    playSound('confirmar'); // Toca o som de confirmação
    const votoInput = document.getElementById("voto");
    votoInput.value = "-1"; // Define o valor para votar em branco
    const form = document.querySelector('.teclado-form');
    
    // Aguarda um pequeno tempo para garantir que o som toque antes de enviar
    setTimeout(() => {
        form.submit(); // Envia o formulário
    }, 750); // 500 milissegundos (ajuste conforme necessário)
}