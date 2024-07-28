<?php

require_once("conecta.php");

function verificaEmail($email){

    conecta();

    global $mysqli;

    $sql = "SELECT idusuario FROM usuario WHERE email = ?;";

    $stmt = $mysqli->prepare($sql);
    
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $retorno = $stmt->get_result();

    desconecta();

    if($retorno->num_rows == 1){
        return true;
    }else{
        return false;
    }  
}

function retornaUser($idusuario){

    conecta();

    global $mysqli;

    $sql = "SELECT * FROM usuario WHERE idusuario = ?;";

    $stmt = $mysqli->prepare($sql);
    
    $stmt->bind_param("i",$idusuario);
    $stmt->execute();
    $retorno = $stmt->get_result();

    desconecta();

    if($retorno->num_rows == 1){
        $usuario = $retorno->fetch_object();
        return $usuario;
    }else{
        return false;
    }  
}

?>