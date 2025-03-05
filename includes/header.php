<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está autenticado e é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 1) {
    header('Location: /gestao_escolar/public/login.php'); // Redireciona para o login
    exit();
}

require_once __DIR__ . '/../includes/auth.php'; // Inclui as funções de autenticação

$usuario = $_SESSION['usuario']; // Obtém os dados do usuário da sessão
$tipos_usuario = [
    1 => 'Administrador',
    2 => 'Professor',
    3 => 'Aluno'
];

$tipo_usuario = $tipos_usuario[$usuario['tipo_usuario_id']] ?? 'Desconhecido';
//var_dump($usuario);

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/gestao_escolar/css/navbar.css">
    <link rel="stylesheet" href="/gestao_escolar/css/btn_style.css">
    <link rel="stylesheet" href="/gestao_escolar/css/tabelas_style.css">
    <link rel="stylesheet" href="/gestao_escolar/css/form_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="/gestao_escolar/js/scripts.js" defer=""></script>
</head>

<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <div class="logo">Gestão Escolar</div>
            <div class="user-info">
                <p><?=$_SESSION['usuario']['login'];?></p><i class="bi bi-arrows btn-logout"></i>
                <!-- <p><?=$_SESSION['usuario']['email']; ?></p> -->
                <p><?=$tipo_usuario ?></p>
                <a href="/gestao_escolar/actions/logout.php" class="btn-logout"><i
                        class="bi bi-box-arrow-right "></i></a>
                <div class="current-time">
                    <p id="current-time"></p>
                </div>
            </div>
            <div class="menu-icon" id="menuIcon">☰</div>
            <ul class="menu" id="menu">
                <li><a href="dashboard_admin.php">Home</a></li>
                <li class="dropdown">
                    <a href="#cadastro">Cadastro</a>
                    <ul class="dropdown-content">
                        <li><a href="cadastrar_usuario.php">Usuário</a></li>
                        <li><a href="cadastrar_turma.php">Turma</a></li>
                        <li><a href="#curso">Curso</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#editar">Editar</a>
                    <ul class="dropdown-content">
                        <li><a href="editar_usuario.php">Usuário</a></li>
                        <li><a href="#turma">Turma</a></li>
                        <li><a href="#curso">Curso</a></li>
                    </ul>
                </li>
                <li><a href="#contato">Contato</a></li>
            </ul>
        </nav>
    </header>