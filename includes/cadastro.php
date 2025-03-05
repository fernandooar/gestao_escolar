<?php
require_once __DIR__ . '/../config/db.php'; // Inclui a conexão com o banco de dados

/**
 * Função para cadastrar um novo usuário.
 * @param string $nome Nome do usuário.
 * @param string $email Email do usuário.
 * @param string $login Login do usuário.
 * @param string $senha Senha do usuário (já deve estar em hash).
 * @param int $tipo_usuario_id ID do tipo de usuário (1 = Admin, 2 = Professor, 3 = Aluno).
 * @return bool Retorna true se o cadastro for bem-sucedido, ou false em caso de erro.
 */
function cadastrarUsuario($nome, $email, $login, $senha, $tipo_usuario_id) {
    global $pdo; // Usa a conexão PDO definida no db.php

    try {
        // Prepara a consulta SQL para inserir o novo usuário
        $sql = "INSERT INTO usuarios (nome, email, login, senha, tipo_usuario_id) VALUES (:nome, :email, :login, :senha, :tipo_usuario_id)";
        $stmt = $pdo->prepare($sql);

        // Vincula os parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':tipo_usuario_id', $tipo_usuario_id);

        // Executa a consulta
        return $stmt->execute();
    } catch (PDOException $e) {
        // Log do erro (opcional)
        error_log("Erro ao cadastrar usuário: " . $e->getMessage());
        return false;
    }
}