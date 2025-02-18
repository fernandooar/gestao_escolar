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
                <div class="card title">
                    <h3>Nova Escola.</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores tempore reiciendis nobis
                        repellendus corporis dolorum recusandae esse. Amet tempore cupiditate, quaerat dolores iste at
                        itaque. Amet, quia sed a animi facilis deleniti eligendi dolores rerum molestias, in incidunt
                        consequatur explicabo similique minima. Dignissimos ullam nobis commodi nemo molestias! Autem
                        incidunt nam voluptates. Vero modi necessitatibus expedita ipsa libero eius provident maiores
                        voluptate laborum, voluptas maxime enim commodi! Ut quis sit assumenda? Molestias magni
                        cupiditate nulla voluptate, quia, distinctio harum aliquid quod enim vel quas. Dicta autem
                        aperiam, minus enim, magnam modi eligendi adipisci dolore nisi tempora ullam, iusto iure dolor
                        commodi molestiae veniam labore? Delectus dolor iure consequuntur nulla nostrum, atque excepturi
                        fugiat nihil vitae eius possimus labore ipsa quam eum explicabo, modi veritatis consequatur
                        laboriosam quos ullam distinctio. Eos vero sit animi ea, error veniam esse harum repellat, quasi
                        aliquid, voluptas facilis consequuntur qui sint eum beatae voluptatem sequi.</p>
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