<?php 
require_once __DIR__ . '/../includes/header.php';
$usuarios = buscarTodosUsuarios(); // Busca todos os usuários ordenados por tipo
?>

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
                <td><?= $user['usuario_id']; ?></td>
                <td><?= $user['nome']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['login']; ?></td>
                <td><?= $user['tipo']; ?></td>
                <td><?= $user['ativo'] ? 'Ativo' : 'Inativo'; ?></td>
                <td>
                    <a href="/gestao_escolar/views/editar_usuario.php?id=<?= $user['usuario_id']; ?>"
                        class="btn-editar">Editar</a>
                    <a href="/gestao_escolar/actions/excluir_usuario.php?id=<?= $user['usuario_id']; ?>"
                        class="btn-excluir">Excluir</a>
                    <?php if ($user['ativo']): ?>
                    <a href="/gestao_escolar/actions/desativar_usuario.php?id=<?= $user['usuario_id']; ?>"
                        class="btn-desativar">Desativar</a>
                    <?php else: ?>
                    <a href="/gestao_escolar/actions/ativar_usuario.php?id=<?= $user['usuario_id']; ?>"
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