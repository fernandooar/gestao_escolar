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
    <title>Login</title>
    <link rel="stylesheet" href="/gestao_escolar/css/tela_de_login.css">
</head>

<body>
    <div class="container-main">
        <div class="propaganda-container">
            <div class="card">
                <div class="card-title">
                    <h3>Nova Escola.</h3>
                    <div class="img-login">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Et quas ad earum commodi error enim
                            aut incidunt voluptatem molestiae soluta debitis voluptates, architecto sed neque harum! Ea,
                            cupiditate reiciendis. Expedita cumque omnis explicabo fugit? Mollitia illo officia expedita
                            dignissimos quisquam consectetur. Velit explicabo quam atque, voluptatem quis suscipit.
                            Consequatur eum ducimus ad blanditiis nemo sunt molestiae voluptas voluptatibus architecto
                            illum dicta repudiandae dolor perspiciatis minus, ab maiores nobis alias dolorem facilis
                            culpa quo numquam cumque adipisci. Incidunt ratione vitae vel enim? Hic iusto laudantium
                            velit, voluptate quis ratione rerum vel similique commodi quam architecto assumenda.
                            Dolorem, voluptas! Maiores, ab libero.</p>
                    </div>
                </div>
            </div>
        </div>
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

                </div>
            </div>

            <?php if (isset($erro)): ?>
            <p style="color: red;"><?php echo $erro; ?></p>
            <?php endif; ?>

        </div>
    </div>
</body>

</html>