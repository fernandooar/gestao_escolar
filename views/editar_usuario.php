<?php
session_start();

// Verifica se o usuário está autenticado e é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 1) {
    header('Location: /gestao_escolar/public/login.php');
    exit();
}

require_once __DIR__ . '/../includes/auth.php'; // Inclui as funções de autenticação
require_once __DIR__ . '/../config/db.php'; // Inclui a conexão com o banco de dados
$usuario = $_SESSION['usuario']; // Obtém os dados do usuário da sessão
$tipos_usuario = [
    1 => 'Administrador',
    2 => 'Professor',
    3 => 'Aluno'
];

$tipo_usuario = $tipos_usuario[$usuario['tipo_usuario_id']] ?? 'Desconhecido';

// Obtém o ID do usuário a ser editado
$usuario_id = $_GET['id'] ?? null;

if (!$usuario_id) {
    header('Location: /gestao_escolar/views/dashboard_admin.php');
    exit();
}

// Busca os dados do usuário no banco de dados
$sql = "SELECT * FROM usuarios WHERE usuario_id = :usuario_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header('Location: /gestao_escolar/views/dashboard_admin.php');
    exit();
}

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $tipo_usuario_id = $_POST['tipo_usuario_id'];

    // Atualiza os dados do usuário no banco de dados
    $sql = "UPDATE usuarios SET nome = :nome, email = :email, login = :login, tipo_usuario_id = :tipo_usuario_id WHERE usuario_id = :usuario_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':tipo_usuario_id', $tipo_usuario_id);
    $stmt->bindParam(':usuario_id', $usuario_id);

    if ($stmt->execute()) {
        $sucesso = "Usuário atualizado com sucesso!";
    } else {
        $erro = "Erro ao atualizar usuário.";
    }
}
?>
<?php 
require_once __DIR__ . '/../includes/header.php';
?>


<!-- Conteúdo Principal -->
<main class="cadastro-container">
    <h1>Editar Usuário</h1>

    <?php if (isset($sucesso)): ?>
    <p style="color: green;"><?php echo $sucesso; ?></p>
    <?php endif; ?>

    <?php if (isset($erro)): ?>
    <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form method="POST" action="" class="cadastro-form">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome']; ?>" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>" required>
        <br>

        <label for="login">Login:</label>
        <input type="text" name="login" id="login" value="<?php echo $usuario['login']; ?>" required>
        <br>

        <label for="tipo_usuario_id">Tipo de Usuário:</label>
        <select name="tipo_usuario_id" id="tipo_usuario_id" required>
            <option value="1" <?php echo $usuario['tipo_usuario_id'] == 1 ? 'selected' : ''; ?>>Administrador
            </option>
            <option value="2" <?php echo $usuario['tipo_usuario_id'] == 2 ? 'selected' : ''; ?>>Professor</option>
            <option value="3" <?php echo $usuario['tipo_usuario_id'] == 3 ? 'selected' : ''; ?>>Aluno</option>
        </select>
        <br>

        <button type="submit">Atualizar</button>
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