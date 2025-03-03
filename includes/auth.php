<?php
require_once __DIR__ . '/../config/db.php'; // Inclui a conexão com o banco de dados



/**
 * Função para verificar as credenciais do usuário.
 * @param string $login Login do usuário.
 * @param string $senha Senha do usuário.
 * @return array|false Retorna os dados do usuário se as credenciais estiverem corretas, ou false caso contrário.
 */
function verificarCredenciais($login, $senha) {
    global $pdo; // Usa a conexão PDO definida no db.php

    // Prepara a consulta SQL para buscar o usuário pelo login
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();

    // Obtém o usuário do banco de dados
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        return $usuario; // Retorna os dados do usuário
    }

    return false; // Credenciais inválidas
}

/**
 * Função para buscar todos os usuários ordenados por tipo (administrador, professor, aluno).
 * @return array Retorna um array com os usuários ordenados.
 */
function buscarTodosUsuarios() {
    global $pdo; // Usa a conexão PDO definida no db.php

    // Consulta SQL para buscar todos os usuários ordenados por tipo_usuario_id
    $sql = "SELECT u.usuario_id, u.nome, u.email, u.login, t.tipo, u.ativo 
            FROM usuarios u
            JOIN tipos_usuario t ON u.tipo_usuario_id = t.tipo_usuario_id
            ORDER BY u.tipo_usuario_id ASC, u.nome ASC";

    $stmt = $pdo->query($sql); // Executa a consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna os resultados como um array associativo
}

/**
 * Função para redirecionar o usuário com base no tipo de usuário.
 * @param array $usuario Dados do usuário autenticado.
 */
function redirecionarUsuario($usuario) {
    switch ($usuario['tipo_usuario_id']) {
        case 1: // Administrador
            header('Location: /gestao_escolar/views/dashboard_admin.php');
            break;
        case 2: // Professor
            header('Location: /gestao_escolar/views/dashboard_professor.php');
            break;
        case 3: // Aluno
            header('Location: /gestao_escolar/views/dashboard_aluno.php');
            break;
        default:
            die("Tipo de usuário inválido.");
    }
    exit();
}
?>