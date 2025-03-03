<?php 
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/db.php'; // Inclui a conexão com o banco de dados

/**
 * Função para buscar todos os alunos.
 * @return array Retorna um array com os dados dos alunos.
 */
function buscarTodosAlunos() {
    global $pdo;

    $sql = "SELECT u.usuario_id, u.nome, u.email, u.login, m.matricula
        FROM usuarios u
        LEFT JOIN matricula m ON u.usuario_id = m.usuario_id
        WHERE u.tipo_usuario_id = 3";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Função para buscar alunos por turma, incluindo suas notas.
 * @param int $turma_id ID da turma.
 * @return array Retorna um array com os dados dos alunos e suas notas.
 */
function buscarAlunosPorTurma($turma_id) {
    global $pdo;

    $sql = "SELECT u.usuario_id, u.nome, u.email, u.login, m.matricula, t.turma, n.nota, n.bimestre
        FROM usuarios u
        JOIN matricula m ON u.usuario_id = m.usuario_id
        JOIN turma t ON m.turma_id = t.turma_id
        LEFT JOIN notas n ON m.matricula_id = n.matricula_id
        WHERE m.turma_id = :turma_id AND u.tipo_usuario_id = 3
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':turma_id', $turma_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Função para lançar ou atualizar notas de um aluno.
 * @param int $matricula_id ID da matrícula.
 * @param int $bimestre Número do bimestre.
 * @param float $nota Nota do aluno.
 * @return bool Retorna true se a operação for bem-sucedida.
 */
function lancarNota($matricula_id, $bimestre, $nota) {
   global $pdo;

   $sql = "INSERT INTO notas (matricula_id, bimestre, nota)
       VALUES (:matricula_id, :bimestre, :nota)
       ON DUPLICATE KEY UPDATE nota = :nota
   ";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':matricula_id', $matricula_id);
   $stmt->bindParam(':bimestre', $bimestre);
   $stmt->bindParam(':nota', $nota);
   return $stmt->execute();
}

 /**
 * Função para buscar todas as turmas.
 * @return array Retorna um array com as turmas.
 */
function buscarTurmas() {
   global $pdo;

   $sql = "SELECT turma_id, turma FROM turma";
   $stmt = $pdo->prepare($sql);
   $stmt->execute();
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Função para vincular um professor a uma turma.
 * @param int $usuario_id ID do professor.
 * @param int $turma_id ID da turma.
 * @return bool Retorna true se o vínculo for bem-sucedido.
 */
function vincularProfessorTurma($usuario_id, $turma_id) {
   global $pdo;

   $sql = "INSERT INTO professor_turma (usuario_id, turma_id) VALUES (:usuario_id, :turma_id)";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':usuario_id', $usuario_id);
   $stmt->bindParam(':turma_id', $turma_id);
   return $stmt->execute();
}

/**
* Função para buscar as turmas de um professor.
* @param int $usuario_id ID do professor.
* @return array Retorna um array com as turmas do professor.
*/
function buscarTurmasDoProfessor($usuario_id) {
   global $pdo;

   $sql = "SELECT t.turma_id, t.turma
       FROM turma t
       JOIN professor_turma pt ON t.turma_id = pt.turma_id
       WHERE pt.usuario_id = :usuario_id
   ";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':usuario_id', $usuario_id);
   $stmt->execute();
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


 