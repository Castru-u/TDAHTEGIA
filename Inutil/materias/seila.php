<?php
session_start();
require_once("../../app/config/validacoes.php"); // Inclua a validação

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../app/pages/login.php");
    exit();
}

// Acessar informações do usuário
$idusuario = $_SESSION['id_usuario']; // Atualizado para refletir o nome da variável de sessão correta
$usuario = $_SESSION['email']; // Ajustado para refletir o nome da variável de sessão correta
$nome = $_SESSION['nome'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</h1>
    <p>Seu ID de usuário é <?php echo htmlspecialchars($idusuario); ?>.</p>
    <p>Seu nome de usuário é <?php echo htmlspecialchars($usuario); ?>.</p>
    <a href="logout.php">Sair</a>
</body>
</html>
