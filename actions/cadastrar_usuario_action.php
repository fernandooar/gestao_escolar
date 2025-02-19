<?php
session_start();

// Verifica se o usuário está autenticado e é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 1) {
    header('Location: /gestao_escolar/public/login.php');
    exit();
}

require_once __DIR__ . '/../includes/cadastro.php'; //Require_once no arquivo casdastro.php para incluir a função de cadastro

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); //Usando metodo passworhash para gerar a senha hash
    $tipo_usuario_id = $_POST['tipo_usuario_id'];

    //Realiza a tentativa de cadastrar o usuario
    if (cadastrarUsuario($nome, $email, $login, $senha, $tipo_usuario_id)) {
        header('Location: /gestao_escolar/views/dashboard_admin.php?sucesso=Usuário Cadastrado com sucesso!');
    } else {
        header('Location: /gestao_escolar/views/cadastrar_usuario.php?sucesso=Erro ao cadastrar usuário');
    }

    exit();
}