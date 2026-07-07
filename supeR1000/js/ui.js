function validarFormularioCadastro(form) {
    const inputs = form.querySelectorAll('input[type="text"]');
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value.trim() === '') {
            alert('Preencha todos os campos.');
            return false;
        }
    }
    return true;
}

function validarFormularioPlacar(form) {
    const inputs = form.querySelectorAll('input[type="number"]');
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value.trim() === '') {
            alert('Preencha todos os campos.');
            return false;
        }
        const valor = parseInt(inputs[i].value, 10);
        if (valor < 0 || valor > 15) {
            alert('A pontuação deve ser de 0 a 15 pontos.');
            return false;
        }
    }

    const jogos = form.querySelectorAll('.jogo');
    for (let i = 0; i < jogos.length; i++) {
        const placarA = jogos[i].querySelector('.placar-A').value;
        const placarB = jogos[i].querySelector('.placar-B').value;
        
        if (placarA === placarB) {
            alert('O sistema de Beach Tennis Super 8 não aceita empates.');
            return false;
        }
    }
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    const formCadastro = document.querySelector('form[action*="salvar_participantes.php"]');
    if (formCadastro) {
        formCadastro.addEventListener('submit', function(e) {
            if (!validarFormularioCadastro(formCadastro)) {
                e.preventDefault();
            }
        });
    }

    const formPlacar = document.querySelector('form[action*="salvar_placar.php"]');
    if (formPlacar) {
        formPlacar.addEventListener('submit', function(e) {
            if (!validarFormularioPlacar(formPlacar)) {
                e.preventDefault();
            }
        });
    }
});