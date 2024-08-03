<?php

require_once("../config/conecta.php");


function set_msg($msg, $idchat){

    conecta();

    global $mysqli;

    $sql = "INSERT INTO mensagem(conteudo,idusuario,idchat)VALUES(?,?,?);";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt){
        die("Erro ao inserir. Problema no acesso ao banco de dados");
    }

    $stmt->bind_param("sss",$msg,$_SESSION['id_usuario'],$idchat);

    $stmt->execute();

    if($stmt->affected_rows > 0){
        $msg = "Cadastro realizado com sucesso.";
    }else{
        $msg = "Não foi possível realizar o cadastro, tente novamente mais tarde.";
    }

    desconecta();
}


?>