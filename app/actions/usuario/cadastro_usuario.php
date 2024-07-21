<?php

require_once("../../config/conecta.php");
require_once("../../config/validacoes.php");

if(verificaEmail($_POST['email'])){
    $msg = "Email já cadastrado.";

}else{
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senhaCrip = password_hash($_POST['senha'],PASSWORD_DEFAULT);

    conecta();

    $sql = "INSERT INTO usuario(nome,email,senha)VALUES(?,?,?);";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt){
        die("Erro ao inserir. Problema no acesso ao banco de dados");
    }

    $stmt->bind_param("sss",$nome,$email,$senhaCrip);

    $stmt->execute();

    if($stmt->affected_rows > 0){
        $msg = "Cadastro realizado com sucesso.";
    }else{
        $msg = "Não foi possível realizar o cadastro, tente novamente mais tarde.";
    }

    desconecta();
}


header("Location: ../../pages/cadastro.php?msg={$msg}");

?>