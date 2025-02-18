<?php
session_start();

// Verifica se o usuário é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 1) {
    header('Location: /gestao_escolar/public/login.php');
    exit();
}

require_once __DIR__ . '/../config/db.php'; // Inclui a conexão com o banco de dados

$usuario_id = $_GET['id']; // Obtém o ID do usuário

// Alterna o status do usuário
$sql = "UPDATE usuarios SET ativo = NOT ativo WHERE usuario_id = :usuario_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();

// Redireciona de volta para o painel do administrador
header('Location: /gestao_escolar/views/dashboard_admin.php');
exit();
?>