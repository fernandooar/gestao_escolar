<?php 

session_start();

// Verifica se o usuário está autenticado e é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 1) {
    header('Location: /gestao_escolar/public/login.php');
    exit();
}
require_once __DIR__ . '/../includes/turma.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém o nome da turma do formulário
    $nomeTurma = trim($_POST['nome_turma']);

    // Valida se o nome da turma não está vazio
    if (!empty($nomeTurma)) {
        cadastrarTurma($nomeTurma, $pdo);
        header('Location: /gestao_escolar/views/dashboard_admin.php?sucesso=Turma cadastrada com sucesso!');
    } else {
        header('Location: /gestao_escolar/views/cadastrar_usuario.php?sucesso=Erro ao cadastrar turma');
    }

    exit();
}
?>