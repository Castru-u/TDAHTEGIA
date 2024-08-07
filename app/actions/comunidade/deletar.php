<?php
session_start();
require_once("../../config/conecta.php"); 
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../pages/login.php");
    exit();
}
conecta();

if (isset($_GET['action']) && $_GET['action'] === 'remove_user') {
    $idcomunidade = isset($_GET['idcomunidade']) ? intval($_GET['idcomunidade']) : 0;
    $idusuario = isset($_GET['idusuario']) ? intval($_GET['idusuario']) : 0;
    error_log("ID Comunidade: " . $idcomunidade);
    error_log("ID Usuário: " . $idusuario);

    $stmt = $mysqli->prepare("DELETE FROM comunidade_usuario WHERE idcomunidade = ? AND idusuario = ?");
    $stmt->bind_param('ii', $idcomunidade, $idusuario);

    if ($stmt->execute()) {
        echo "Usuário removido com sucesso!";
    } else {
        error_log("Erro ao remover usuário: " . $stmt->error);
        echo "Erro ao remover usuário.";
    }

    $stmt->close();
}
desconecta();

header("Location: ../../pages/mostrar_comunidade.php?idcomunidade=" . $idcomunidade);
exit();
?>
