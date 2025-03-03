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

// Busca todas as turmas
$turmas = buscarTurmas();
// var_dump($turmas);

//  $turmas = buscarTurmasDoProfessor($_SESSION['usuario']['usuario_id']);

// Obtém o ID da turma selecionada (se existir)
$turma_id = $_GET['turma_id'] ?? null;

// Busca os alunos da turma selecionada (se houver)
$alunos = [];
if ($turma_id) {
    $alunos = buscarAlunosPorTurma($turma_id);
    //var_dump($alunos);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Listar Alunos por Turma</title>
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
                    <li><a href="/gestao_escolar/views/dashboard_professor.php">Dashboard</a></li>
                </ul>
            </div>
            <div class="logout-section">
                <a href="/gestao_escolar/actions/logout.php" class="btn-logout">Sair</a>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="content">
        <h1>Listar Alunos por Turma</h1>

        <!-- Formulário para escolher a turma -->
        <form method="GET" action="">
            <label for="turma_id">Selecione a Turma:</label>
            <select name="turma_id" id="turma_id" required>
                <option value="">-- Escolha uma turma --</option>
                <?php foreach ($turmas as $turma): ?>
                <option value="<?php echo $turma['turma_id']; ?>"
                    <?php echo ($turma_id == $turma['turma_id']) ? 'selected' : ''; ?>>
                    <?php echo $turma['turma']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Buscar</button>
        </form>

        <!-- Tabela de alunos -->
        <?php if ($turma_id && !empty($alunos)): ?>
        <h2>Alunos da Turma: <?php echo $turmas[array_search($turma_id, array_column($turmas, 'turma_id'))]['turma']; ?>
        </h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Login</th>
                    <th>Matrícula</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?php echo $aluno['nome']; ?></td>
                    <td><?php echo $aluno['email']; ?></td>
                    <td><?php echo $aluno['login']; ?></td>
                    <td><?php echo $aluno['matricula']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif ($turma_id && empty($alunos)): ?>
        <p>Nenhum aluno encontrado para esta turma.</p>
        <?php endif; ?>
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