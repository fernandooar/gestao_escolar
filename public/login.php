<?php
session_start();
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Verifica as credenciais do usuário
    $usuario = verificarCredenciais($login, $senha);

    if ($usuario) {
        // Armazena os dados do usuário na sessão
        $_SESSION['usuario'] = $usuario;

        // Redireciona o usuário para o dashboard correspondente
        redirecionarUsuario($usuario);
    } else {
        $erro = "Login ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão Escolar</title>
    <link rel="stylesheet" href="/gestao_escolar/css/login_style.css">

</head>

<body>
    <div class="landing-page">
        <!-- Conteúdo da Landing Page -->
        <div class="landing-content">
            <h1>Gestão Escolar</h1>
            <p>
                Bem-vindo ao sistema de Gestão Escolar! Aqui você pode gerenciar usuários, turmas, cursos e muito mais.
                Faça login para acessar todas as funcionalidades.
            </p>
        </div>

        <!-- Container de Login -->
        <div class="login-container">
            <div class="card-login">
                <div class="card-title">
                    <h1>Login</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <label for="login">Login:</label>
                        <input type="text" name="login" id="login" required>

                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" required>

                        <button type="submit">Entrar</button>
                    </form>
                </div>
                <div class="card-footer">
                    <p>Não tem uma conta? <a href="#">Cadastre-se</a></p>
                </div>
                <div class="card-footer">
                    <p> <a href="#">Esqueceu a senha?</a></p>
                </div>
                <div class="card-footer">
                    <p> <a href="../index.php">Inicio</a></p>
                </div>
            </div>

            <?php if (isset($erro)): ?>
            <p class="error-message"><?php echo $erro; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>