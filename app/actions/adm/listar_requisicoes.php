<?php

require_once("../config/conecta.php");

conecta();

global $mysqli;

$sql;

$sql = "SELECT ue.*, usuario.* FROM usuario_especialidade AS ue
INNER JOIN usuario ON usuario.idusuario = ue.idusuario
WHERE usuario.role = 'comum';";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

desconecta();

if($result->num_rows > 0){
    $requisicoes = $result->fetch_all(MYSQLI_ASSOC);

}


?>