<?php
session_start();

// Verifica se o usuário é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 1) {
    header('Location: /gestao_escolar/public/login.php');
    exit();
}

$usuario_id = $_GET['id']; // Obtém o ID do usuário a ser editado

// Redireciona para a página de edição (implemente essa página posteriormente)
header("Location: /gestao_escolar/views/editar_usuario_form.php?id=$usuario_id");
exit();
?>