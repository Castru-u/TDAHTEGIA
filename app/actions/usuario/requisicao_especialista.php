<?php

require_once("../../config/conecta.php");
require_once('../../config/upload_imagem.php');

$tipo = $_POST['formacao'];
$documento = $_FILES['documento'];

session_start();
conecta();

global $mysqli;

$sql = "SELECT * FROM usuario_especialidade WHERE idusuario = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("i", $_SESSION['id_usuario']);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $msg = "Você já possui uma requisição em andamento!";
    header("location: ../../pages/consulta.php?msg={$msg}");
    exit;
}

$caminho = uploadImagem($documento);

$sql = "INSERT INTO usuario_especialidade(tipo, idusuario, formacao) VALUES(?,?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sis',$tipo, $_SESSION['id_usuario'], $caminho);
$stmt->execute();

if($stmt->affected_rows > 0){

    $msg = "Requisição enviada!";
}else{
    $msg = "Não foi possível criar a requisição, tente novamente mais tarde.";
}


header("location: ../../pages/consulta.php?msg={$msg}");




?>