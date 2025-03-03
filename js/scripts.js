// Exemplo de script para validação no lado do cliente
document.querySelector('form').addEventListener('submit', function (e) {
    const login = document.getElementById('login').value;
    const senha = document.getElementById('senha').value;

    if (!login || !senha) {
        alert('Preencha todos os campos.');
        e.preventDefault(); // Impede o envio do formulário
    }
});

// script.js
document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });
});