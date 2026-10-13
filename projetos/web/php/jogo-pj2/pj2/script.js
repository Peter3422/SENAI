function moveNoButton() {
    const noButton = document.getElementById('noButton');
    const randomX = Math.random() * (window.innerWidth - 100); // 100 é a largura do botão
    const randomY = Math.random() * (window.innerHeight - 50); // 50 é a altura do botão
    noButton.style.left = randomX + 'px';
    noButton.style.top = randomY + 'px';
}

document.addEventListener('mousemove', function(event) {
    const noButton = document.getElementById('noButton');
    const buttonRect = noButton.getBoundingClientRect();
    const mouseX = event.clientX;
    const mouseY = event.clientY;

    // Verifica se o mouse está próximo do botão
    if (mouseX >= buttonRect.left && mouseX <= buttonRect.right &&
        mouseY >= buttonRect.top && mouseY <= buttonRect.bottom) {
        moveNoButton(); // Move o botão se o mouse estiver próximo
    }
});

// Move o botão "NÃO" para uma posição inicial ao lado do botão "SIM" quando a página carregar
window.onload = function() {
    const simButton = document.querySelector('form button[type="submit"]');
    const simButtonRect = simButton.getBoundingClientRect();
    const noButton = document.getElementById('noButton');

    // Define a posição inicial do botão "NÃO" ao lado do botão "SIM"
    noButton.style.left = (simButtonRect.right + 10) + 'px'; // 10px à direita do botão "SIM"
    noButton.style.top = (simButtonRect.top) + 'px'; // Alinha verticalmente com o botão "SIM"
};