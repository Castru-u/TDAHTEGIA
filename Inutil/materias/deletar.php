<?php
session_start();
require_once("../../app/config/validacoes.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../app/pages/login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tdahtegia";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_GET['action']) && $_GET['action'] === 'remove_user') {
    $idcomunidade = isset($_GET['idcomunidade']) ? intval($_GET['idcomunidade']) : 0;
    $idusuario = isset($_GET['idusuario']) ? intval($_GET['idusuario']) : 0;

    // Depuração: verificar valores recebidos
    error_log("ID Comunidade: " . $idcomunidade);
    error_log("ID Usuário: " . $idusuario);

    $stmt = $conn->prepare("DELETE FROM comunidade_usuario WHERE idcomunidade = ? AND idusuario = ?");
    $stmt->bind_param('ii', $idcomunidade, $idusuario);

    if ($stmt->execute()) {
        echo "Usuário removido com sucesso!";
    } else {
        error_log("Erro ao remover usuário: " . $stmt->error);
        echo "Erro ao remover usuário.";
    }

    $stmt->close();
    $conn->close();

    // Redirecionar de volta para a página de CRUD
    header("Location: crud.php?idcomunidade=" . $idcomunidade);
    exit();
}
?>
