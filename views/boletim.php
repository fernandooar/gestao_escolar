<?php
session_start();

// Verifica se o usuário está autenticado e é um professor
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 2) {
    header('Location: /gestao_escolar/public/login.php');
    exit();
}

require_once __DIR__ . '/../includes/professor.php'; // Inclui as funções do professor

$matricula_id = $_GET['matricula_id'] ?? null;

if (!$matricula_id) {
    header('Location: /gestao_escolar/views/dashboard_professor.php');
    exit();
}

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bimestre = $_POST['bimestre'];
    $nota = $_POST['nota'];

    if (lancarNota($matricula_id, $bimestre, $nota)) {
        $sucesso = "Nota lançada com sucesso!";
    } else {
        $erro = "Erro ao lançar nota.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Lançar Notas</title>
    <link rel="stylesheet" href="/gestao_escolar/css/navbar.css">
    <link rel="stylesheet" href="/gestao_escolar/css/dashboard_admin.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <div class="user-info">
                <h3><?php echo $_SESSION['usuario']['nome']; ?></h3>
                <p><?php echo $_SESSION['usuario']['email']; ?></p>
                <p><?php echo $_SESSION['usuario']['tipo']; ?></p>
            </div>
        </div>
        <div class="navbar-right">
            <div class="current-time">
                <p id="current-time"></p>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="/gestao_escolar/views/dashboard_professor.php">Meus Alunos</a></li>
                </ul>
            </div>
            <div class="logout-section">
                <a href="/gestao_escolar/actions/logout.php" class="btn-logout">Sair</a>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="content">
        <h1>Lançar Notas</h1>

        <?php if (isset($sucesso)): ?>
        <p style="color: green;"><?php echo $sucesso; ?></p>
        <?php endif; ?>

        <?php if (isset($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="bimestre">Bimestre:</label>
            <input type="number" name="bimestre" id="bimestre" min="1" max="4" required>
            <br>

            <label for="nota">Nota:</label>
            <input type="number" name="nota" id="nota" step="0.1" min="0" max="10" required>
            <br>

            <button type="submit">Lançar Nota</button>
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