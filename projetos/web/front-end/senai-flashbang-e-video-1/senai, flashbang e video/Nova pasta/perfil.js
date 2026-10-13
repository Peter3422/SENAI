function resetAnimation(element) {
    element.classList.remove('shake');
    void element.offsetWidth;
    element.classList.add('shake');
}

document.getElementById('img').addEventListener('click', function () {
    document.getElementById("audio").play();


    resetAnimation(this);


    setTimeout(function () {

        document.body.style.backgroundColor = 'white';
        document.body.style.color = 'white';

        const elements = document.body.children;
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }

        setTimeout(function () {
            document.body.style.backgroundColor = '';
            document.body.style.color = '';

            for (let i = 0; i < elements.length; i++) {
                elements[i].style.display = '';
                elements[i].classList.add('fade-in');
            }

            setTimeout(function () {
                for (let i = 0; i < elements.length; i++) {
                    elements[i].classList.remove('fade-in');
                    elements[i].classList.add('show');
                }
            }, 50);
        }, 2000);
    }, 300);
});

document.getElementById("img2").addEventListener("click", function () {
    document.getElementById("audio2").play();
});

document.getElementById("img3").addEventListener("click", function () {
    document.getElementById("audio").play();
    resetAnimation(this);
});