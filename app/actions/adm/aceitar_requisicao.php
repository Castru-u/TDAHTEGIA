<?php

session_start();

require_once("../../config/conecta.php");

$id = $_POST['id    usuario'];

conecta();

global $mysqli;

$sql = "UPDATE usuario SET role = 'especialista' WHERE idusuario = ?";
$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    desconecta();
    return "Erro ao preparar a consulta: " . $mysqli->error;
}

$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $msg = "Especialista adicionado.";
} else {
    $msg = "Não foi possível adicionar.";
}

desconecta();

header("location: ../../pages/menuadm.php?msg={$msg}");

?>