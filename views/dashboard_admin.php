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
    <link rel="stylesheet" href="/gestao_escolar/css/dashadmin.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <div class="user-info">
                <h3><?php echo $_SESSION['usuario']['nome']; ?></h3>
                <p><?php echo $_SESSION['usuario']['email']; ?></p>
                <p><?php echo $tipo_usuario ?></p>
            </div>
        </div>
        <div class="navbar-right">
            <div class="current-time">
                <p id="current-time"></p>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="/gestao_escolar/views/cadastrar_usuario.php">Cadastrar</a></li>
                    <li><a href="/gestao_escolar/views/dashboard_admin.php">Listar</a></li>
                </ul>
            </div>
            <div class="backup-section">
                <a href="/gestao_escolar/actions/backup.php" class="btn-backup">Backup BD</a>
            </div>
            <div class="logout-section">
                <a href="/gestao_escolar/actions/logout.php" class="btn-logout">Sair</a>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="content">
        <h1>Bem-vindo, <?php echo $_SESSION['usuario']['nome']; ?> (Admin)</h1>
        <p>Este é o painel do administrador.</p>

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