<?php
session_start();

// Verifica se o usuário é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario_id'] != 1) {
    header('Location: /gestao_escolar/public/login.php');
    exit();
}

require_once __DIR__ . '/../config/db.php'; // Inclui a conexão com o banco de dados

// Define o nome do arquivo de backup
$backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

// Comando para gerar o backup
$command = "mysqldump --user={$username} --password={$password} --host={$host} {$dbname} > {$backupFile}";

// Executa o comando
exec($command);

// Força o download do arquivo
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
readfile($backupFile);

// Remove o arquivo após o download
unlink($backupFile);
exit();
?>