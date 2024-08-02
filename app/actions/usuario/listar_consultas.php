<?php

require_once("../config/conecta.php");

conecta();

global $mysqli;

$sql;


if($_SESSION['role']=='especialista'){
    $sql = "SELECT chat.idchat, chat.idusuario, chat.idespecialista, chat.denuncia, usuario.nome FROM chat 
    INNER JOIN usuario ON usuario.idusuario = chat.idusuario WHERE chat.idespecialista = ?"; }
elseif($_SESSION['role']=='comum'){
    $sql = "SELECT chat.idchat, chat.idusuario, chat.idespecialista, chat.denuncia, usuario.nome FROM chat 
    INNER JOIN usuario ON usuario.idusuario = chat.idespecialista WHERE chat.idusuario = ?";}

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("i",$_SESSION['id_usuario']);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){

    $listaConsultas = $result->fetch_all(MYSQLI_ASSOC);
 }

 desconecta()

?>