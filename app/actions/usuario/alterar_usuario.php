<?php

session_start();

require_once("../../config/conecta.php");
require_once("../../config/upload_imagem.php");

$nome = $_POST['nome'];
$foto = $_FILES['foto'];
$desc = $_POST['descricao'];
$id = $_SESSION['id_usuario'];

$msg1 = uploadImagem($foto);

conecta();

global $mysqli;

$sql = "UPDATE usuario SET nome = (?), descricao = (?) WHERE idusuario = (?)";

$stmt = $mysqli->prepare($sql);

if(!$stmt){
    die("Erro ao inserir. Problema no acesso ao banco de dados");
}

$stmt->bind_param("ssi",$nome, $desc, $id);

$stmt->execute();

if($stmt->affected_rows > 0){
    $msg = "Dados alterados com sucesso.";
}else{
    $msg = "Não foi possível inserir.";
}

desconecta();

header("location: ../../pages/perfil.php?msg={$msg1}");

?>