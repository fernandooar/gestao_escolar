<?php
session_start();

// Verifica se o usuário está autenticado e é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 1) {
    header('Location: /gestao_escolar/public/login.php');
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
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Usuário</title>
    <link rel="stylesheet" href="/gestao_escolar/css/navbar.css">
    <link rel="stylesheet" href="/gestao_escolar/css/cadastro.css"> <!-- CSS específico para cadastro -->
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <div class="user-info">
                <h3><?php echo $_SESSION['usuario']['nome']; ?></h3>
                <p><?php echo $_SESSION['usuario']['email']; ?></p>
                <p><?php echo $tipo_usuario; ?></p>
                <div class="logout-section">
                    <a href="/gestao_escolar/actions/logout.php" class="btn-logout">Sair</a>
                </div>
            </div>
        </div>
        <div class="navbar-right">
            <div class="current-time">
                <p id="current-time"></p>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="/gestao_escolar/views/cadastrar_usuario.php">Cadastrar</a></li>
                    <li><a href="/gestao_escolar/views/editar_usuario.php">Editar</a></li>
                    <li><a href="/gestao_escolar/views/excluir_usuario.php">Excluir</a></li>
                </ul>
            </div>
            <div class="backup-section">
                <a href="/gestao_escolar/actions/backup.php" class="btn-backup">Backup DB</a>
            </div>

        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="cadastro-container">
        <h1>Cadastrar Novo Usuário</h1>

        <?php if (isset($_GET['sucesso'])): ?>
        <div class="mensagem sucesso"><?php echo htmlspecialchars($_GET['sucesso']); ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['erro'])): ?>
        <div class="mensagem erro"><?php echo htmlspecialchars($_GET['erro']); ?></div>
        <?php endif; ?>

        <form class="cadastro-form" method="POST" action="/gestao_escolar/actions/cadastrar_usuario_action.php">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="login">Login:</label>
            <input type="text" name="login" id="login" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <label for="tipo_usuario_id">Tipo de Usuário:</label>
            <select name="tipo_usuario_id" id="tipo_usuario_id" required>
                <option value="1">Administrador</option>
                <option value="2">Professor</option>
                <option value="3">Aluno</option>
            </select>

            <button type="submit">Cadastrar</button>
        </form>
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