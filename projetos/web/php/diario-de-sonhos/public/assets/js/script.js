document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (e) {
            const nivel = document.querySelector('#nivel_clareza');
            if (nivel) {
                let val = parseInt(nivel.value);
                if (isNaN(val) || val < 1 || val > 5) {
                    alert('Nível de clareza deve ser entre 1 e 5');
                    e.preventDefault();
                }
            }
        });
    }
});
