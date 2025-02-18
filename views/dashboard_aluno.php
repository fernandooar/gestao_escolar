<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está autenticado e é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 1) {
    header('Location: /gestao_escolar/public/login.php'); // Redireciona para o login
    exit();
}

$usuario = $_SESSION['usuario']; // Obtém os dados do usuário da sessão
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/gestao_escolar/css/styles.css">
</head>

<body>
    <h1>Bem-vindo, <?php echo $usuario['nome']; ?> (Admin)</h1>
    <p>Este é o painel do Aluno.</p>
    <a href="/gestao_escolar/actions/logout.php">Sair</a>
</body>

</html>