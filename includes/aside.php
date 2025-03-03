<nav class="sidebar">
    <!-- Card do Usuário -->
    <div class="user-card">
        <img src="user-avatar.jpg" alt="Avatar do Usuário" class="user-avatar">
        <div class="user-info">
            <span class="user-name">João Silva</span>
            <span class="user-email">joao.silva@example.com</span>
        </div>
    </div>

    <!-- Menu de Navegação -->
    <ul class="nav-menu">
        <li><a href="#home">Home</a></li>
        <li class="dropdown">
            <a href="#cadastro" class="dropdown-btn">Cadastro</a>
            <ul class="dropdown-content">
                <li><a href="cadastrar_usuario.php">Usuário</a></li>
                <li><a href="#turma">Turma</a></li>
                <li><a href="#curso">Curso</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#editar" class="dropdown-btn">Editar</a>
            <ul class="dropdown-content">
                <li><a href="#usuario">Usuário</a></li>
                <li><a href="#turma">Turma</a></li>
                <li><a href="#curso">Curso</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#listar" class="dropdown-btn">Listar</a>
            <ul class="dropdown-content">
                <li><a href="#usuario">Usuários</a></li>
                <li><a href="#turma">Turmas</a></li>
                <li><a href="#curso">Cursos</a></li>
            </ul>
        </li>
    </ul>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });
});
</script>
</body>

</html>