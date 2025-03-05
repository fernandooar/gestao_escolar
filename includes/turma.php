<?php 
require_once __DIR__ . '/../config/db.php';

// function cadastrarTurma($nomeTurma) {
// global $pdo;

//     try {
//     // Prepara a query SQL para inserir a turma
//     $sql = "INSERT INTO turma (turma) VALUES ($nomeTurma)";
//     $stmt = $pdo->prepare($sql);
//     var_dump($nomeTurma);

//     $stmt->bindParam(':turma', $nomeTurma);

//     return $stmt->execute();

//     } catch (PDOException $e) {
//         error_log("Erro ao cadastrar Turma: " . $e->getMessage());
//         return false;
//     }
    
// }

// Função para cadastrar uma turma
function cadastrarTurma($nomeTurma, $pdo) {
    try {
        // Prepara a query SQL usando prepared statements
        $sql = "INSERT INTO turma (turma) VALUES (:nome_turma)";
        $stmt = $pdo->prepare($sql);

        // Usa bindParam para associar o parâmetro ao valor
        $stmt->bindParam(':nome_turma', $nomeTurma, PDO::PARAM_STR);

        // Executa a query
        if ($stmt->execute()) {
            echo "Turma cadastrada com sucesso!";
        } else {
            echo "Erro ao cadastrar turma.";
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar turma: " . $e->getMessage();
    }
}