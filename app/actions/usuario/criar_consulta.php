<?php

require_once("../../config/conecta.php");

$tipo = $_POST['formacao'];

session_start();
conecta();

global $mysqli;

$sql = "SELECT usuario.*, COUNT(chat.idchat) as countchat FROM usuario INNER JOIN usuario_especialidade ON usuario_especialidade.idusuario = usuario.idusuario LEFT JOIN chat ON chat.idespecialista = usuario.idusuario WHERE usuario.role='especialista'";

if($tipo!="qualquer"){
    $sql.=" and usuario_especialidade.tipo=(?)";
}

$sql.="GROUP BY usuario.idusuario ORDER BY RAND() LIMIT 1;";

$stmt = $mysqli->prepare($sql);

if($tipo!="qualquer"){
    $stmt->bind_param("s",$tipo);
}
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $especialista = $result->fetch_object();
    $sql = "INSERT INTO chat(idusuario, idespecialista) VALUES({$_SESSION['id_usuario']}, {$especialista->idusuario})";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        $msg = "Consulta criada!";
    }else{
        $msg = "Não foi possível criar a consulta, tente novamente mais tarde.";
    }
}else{
    $msg='não há especialistas dessa área disponíveis';
}

header("location: ../../pages/consulta.php?msg={$msg}");




?>