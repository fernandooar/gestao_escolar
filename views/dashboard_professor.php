<?php
session_start();

// Verifica se o usuário está autenticado e é um professor
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 2) {
    header('Location: /gestao_escolar/public/login.php');
    exit();
}

require_once __DIR__ . '/../includes/professor.php'; // Inclui as funções do professor
require_once __DIR__ . '/../includes/auth.php'; // Inclui as funções de autenticação

$usuario = $_SESSION['usuario']; // Obtém os dados do usuário da sessão
$tipos_usuario = [
    1 => 'Administrador',
    2 => 'Professor',
    3 => 'Aluno'
];

$tipo_usuario = $tipos_usuario[$usuario['tipo_usuario_id']] ?? 'Desconhecido';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Professor</title>
    <link rel="stylesheet" href="/gestao_escolar/css/navbar.css">
    <link rel="stylesheet" href="/gestao_escolar/css/dashadmin.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <div class="user-info">
                <h3><?php echo $_SESSION['usuario']['nome']; ?></h3>
                <p><?php echo $_SESSION['usuario']['email']; ?></p>
                <p><?php echo $tipo_usuario; ?></p>
            </div>
        </div>
        <div class="navbar-right">
            <div class="current-time">
                <p id="current-time"></p>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="/gestao_escolar/views/listar_alunos.php">Listar Todos os Alunos</a></li>
                    <li><a href="/gestao_escolar/views/listar_alunos_turma.php">Listar Alunos por Turma</a></li>
                    <li><a href="/gestao_escolar/views/listar_turmas.php">Listar Turmas</a></li>
                    <li><a href="/gestao_escolar/views/lancar_notas.php">Lançar Notas</a></li>
                    <li><a href="/gestao_escolar/views/editar_notas.php">Editar Notas</a></li>
                    <li><a href="/gestao_escolar/views/gerar_boletim.php">Gerar Boletim</a></li>
                </ul>
            </div>
            <div class="logout-section">
                <a href="/gestao_escolar/actions/logout.php" class="btn-logout">Sair</a>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="content">
        <h1>Bem-vindo, <?php echo $_SESSION['usuario']['nome']; ?> (Professor)</h1>
        <p>Este é o painel do professor. Use o menu acima para acessar as funcionalidades.</p>
    </main>

    <!-- Script para atualizar a data e hora em tempo real -->
    <script>
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
    </script>
</body>

</html>