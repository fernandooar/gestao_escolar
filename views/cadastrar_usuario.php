<?php 
require_once __DIR__ . '/../includes/header.php';
?>

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