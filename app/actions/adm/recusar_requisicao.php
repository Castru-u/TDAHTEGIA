<?php

session_start();

require_once("../../config/conecta.php");

$id = $_POST['idusuario'];
$documento = $_POST['formacao'];

conecta();

global $mysqli;

unlink("../../../public/uploads/" . $documento);

$sql = "DELETE FROM usuario_especialidade WHERE idusuario = ?";
$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    desconecta();
    return "Erro ao preparar a consulta: " . $mysqli->error;
}

$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $msg = "Requisição recusada com sucesso.";
} else {
    $msg = "Não foi possível concluir.";
}

desconecta();

header("location: ../../pages/menuadm.php?msg={$msg}");

?>