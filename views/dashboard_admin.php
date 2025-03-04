<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está autenticado e é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 1) {
    header('Location: /gestao_escolar/public/login.php'); // Redireciona para o login
    exit();
}

require_once __DIR__ . '/../includes/auth.php'; // Inclui as funções de autenticação

$usuario = $_SESSION['usuario']; // Obtém os dados do usuário da sessão
$tipos_usuario = [
    1 => 'Administrador',
    2 => 'Professor',
    3 => 'Aluno'
];

$tipo_usuario = $tipos_usuario[$usuario['tipo_usuario_id']] ?? 'Desconhecido';
//var_dump($usuario);
$usuarios = buscarTodosUsuarios(); // Busca todos os usuários ordenados por tipo
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/gestao_escolar/css/navbar.css">
    <link rel="stylesheet" href="/gestao_escolar/css/btn_style.css">
    <link rel="stylesheet" href="/gestao_escolar/css/tabelas_style.css">
    <script src="/gestao_escolar/js/scripts.js" defer=""></script>
</head>

<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <div class="logo">Gestão Escolar</div>
            <div class="user-info">
                <p><?=$_SESSION['usuario']['nome'] . " /  " ;?></p>
                <!-- <p><?=$_SESSION['usuario']['email']; ?></p> -->
                <p><?=$tipo_usuario ?></p>
                <a href="/gestao_escolar/actions/logout.php" class="btn-logout">Sair</a>
                <div class="current-time">
                    <p id="current-time"></p>
                </div>
            </div>
            <div class="menu-icon" id="menuIcon">☰</div>
            <ul class="menu" id="menu">
                <li><a href="dashboard_admin.php">Home</a></li>
                <li class="dropdown">
                    <a href="#cadastro">Cadastro</a>
                    <ul class="dropdown-content">
                        <li><a href="cadastrar_usuario.php">Usuário</a></li>
                        <li><a href="#turma">Turma</a></li>
                        <li><a href="#curso">Curso</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#editar">Editar</a>
                    <ul class="dropdown-content">
                        <li><a href="editar_usuario.php">Usuário</a></li>
                        <li><a href="#turma">Turma</a></li>
                        <li><a href="#curso">Curso</a></li>
                    </ul>
                </li>
                <li><a href="#contato">Contato</a></li>
            </ul>
        </nav>
    </header>

    <!-- Conteúdo Principal -->
    <main class="content">

        <h2>Lista de Usuários</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Login</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $user): ?>
                <tr>
                    <td><?php echo $user['usuario_id']; ?></td>
                    <td><?php echo $user['nome']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['login']; ?></td>
                    <td><?php echo $user['tipo']; ?></td>
                    <td><?php echo $user['ativo'] ? 'Ativo' : 'Inativo'; ?></td>
                    <td>
                        <a href="/gestao_escolar/views/editar_usuario.php?id=<?php echo $user['usuario_id']; ?>"
                            class="btn-editar">Editar</a>
                        <a href="/gestao_escolar/actions/excluir_usuario.php?id=<?php echo $user['usuario_id']; ?>"
                            class="btn-excluir">Excluir</a>
                        <?php if ($user['ativo']): ?>
                        <a href="/gestao_escolar/actions/desativar_usuario.php?id=<?php echo $user['usuario_id']; ?>"
                            class="btn-desativar">Desativar</a>
                        <?php else: ?>
                        <a href="/gestao_escolar/actions/ativar_usuario.php?id=<?php echo $user['usuario_id']; ?>"
                            class="btn-ativar">Ativar</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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