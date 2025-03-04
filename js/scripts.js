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

// Seleciona o ícone do menu e o menu
const menuIcon = document.getElementById('menuIcon');
const menu = document.getElementById('menu');

// Adiciona um evento de clique ao ícone do menu
menuIcon.addEventListener('click', () => {
    menu.classList.toggle('active'); // Alterna a classe 'active' no menu
});

// Adiciona interação aos dropdowns no mobile
const dropdowns = document.querySelectorAll('.dropdown');

dropdowns.forEach(dropdown => {
    dropdown.addEventListener('click', () => {
        dropdown.classList.toggle('active'); // Alterna a classe 'active' no dropdown
    });
});


function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleString('pt-BR', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    document.getElementById('current-time').textContent = timeString;
}

setInterval(updateTime, 1000); // Atualiza a cada 1 segundo
updateTime(); // Executa imediatamente ao carregar a página