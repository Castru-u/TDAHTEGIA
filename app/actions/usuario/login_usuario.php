<?php

require_once("../../config/conecta.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

conecta();

$sql = "SELECT * FROM usuario WHERE email = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 1){

    $usuario = $result->fetch_object();

    if(password_verify($senha, $usuario->senha)){

        session_start();
        $_SESSION['nome'] = $usuario->nome;
        $_SESSION['logado'] = true;
        $_SESSION['id_usuario'] = $usuario->idusuario;
        header("location: ../../pages/home.php");

    }else{
        header("location: ../../pages/login.php?msgLogin=Usuário ou senha incorretos!");
    }

    }else{
        header("location: ../../pages/login.php?msgLogin=Usuário ou senha incorretos!");
    }

?>