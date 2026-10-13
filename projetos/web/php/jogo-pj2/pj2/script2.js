function validateForm() {
    const radioButtons = document.getElementsByName('pergunta_seguranca');
    let isHuman = false;

    for (const radioButton of radioButtons) {
        if (radioButton.checked) {
            if (radioButton.value === "Sim") {
                isHuman = true;
            }
        }
    }

    if (!isHuman) {
        alert('Você deve ser um humano para se cadastrar!');
        return false; // Impede o envio do formulário
    }

    return true; // Permite o envio do formulário
}