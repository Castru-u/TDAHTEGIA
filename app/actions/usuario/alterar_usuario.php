<?php

session_start();

require_once("../../config/conecta.php");
require_once("../../config/upload_imagem.php");

$nome = $_POST['nome'];
$foto = $_FILES['foto'];
$desc = $_POST['descricao'];
$id = $_SESSION['id_usuario'];

$msg1 = uploadImagem($foto);

$user = retornaUser($_SESSION['id_usuario']); //função nossa que retorna um objeto usuário
if ($user->foto !== 'default_user.jpg') {
    unlink($diretorio . $user->foto); //remove a foto anterior se ela não for a padrão
}

conecta();

global $mysqli;

$sql = "UPDATE usuario SET foto = ? WHERE idusuario = ?";
$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    desconecta();
    return "Erro ao preparar a consulta: " . $mysqli->error;
}

$stmt->bind_param("si", $msg1, $user->idusuario);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $msg = "Foto atualizada com sucesso.";
} else {
    $msg = "Não foi possível atualizar a foto.";
}


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