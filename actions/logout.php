<?php
session_start(); // Inicia a sessão

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header('Location: /gestao_escolar/public/login.php');
exit();
?>