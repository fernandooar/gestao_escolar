<?php 
require_once __DIR__ . '/../config/db.php';

/**
 * Função para buscar alunos por turma.
 * @param int $turma_id ID da turma.
 * @return array Retorna um array com os dados dos alunos.
 */

 function buscarAlunosPorTurma($turma_id) {
    global $pdo;

    $sql = "SELECT u.usuario_id, u.nome, u.login, m.matricula 
    FROM usuarios u 
    JOIN matricula m ON u.usuario_id = m.usuario_id
    WHERE m.turma_id = :turma_id AND u.tipo_usuario_id = 3";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':turma_id', $turma_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

 }

 /**
 * Função para buscar as notas de um aluno.
 * @param int $matricula_id ID da matrícula.
 * @return array Retorna um array com as notas do aluno.
 */
function buscarNotasAluno($matricula_id) {
    global $pdo;
    $sql = "SELECT * FROM notas WHERE matricula_id = :matricula_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':matricula_id', $matricula_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Função para lançar notas de um aluno.
 * @param int $matricula_id ID da matrícula.
 * @param int $bimestre Número do bimestre.
 * @param float $nota Nota do aluno.
 * @return bool Retorna true se a nota for lançada com sucesso.
 */

 function lancarNota($matricula_id, $bimestre, $nota) {
    global $pdo;

    $sql = "INSERT INTO notas (matricula_id, bimestre, nota)
            VALUES (:matricula_id, :bimestre, :nota)
            ON DUPLICATE KEY UPADATE nota = :nota";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':matricula_id', $matricula_id);
            $stmt->bindParam(':bimestre', $bimestre);
            $stmt->bindParam(':nota', $nota);
            return $stmt->execute();
 }

 ?>