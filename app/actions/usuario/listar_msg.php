<?php

require_once("../config/conecta.php");


conecta();

global $mysqli;

$sql;

$sql = "SELECT * FROM mensagem WHERE idchat = ?;";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("i", $_POST['idchat']);
$stmt->execute();
$result = $stmt->get_result();

desconecta();

if($result->num_rows > 0){
    $msgs = $result->fetch_all(MYSQLI_ASSOC);

}


?>