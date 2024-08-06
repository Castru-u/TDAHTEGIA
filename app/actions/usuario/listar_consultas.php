<?php

require_once("../config/conecta.php");

conecta();

global $mysqli;

$sql;


if($_SESSION['role']=='especialista'){
    $sql = "SELECT 
    chat.idchat, 
    chat.idusuario, 
    chat.idespecialista, 
    chat.denuncia, 
    usuario.nome, 
    MAX(mensagem.data_envio) AS datamsg,
    (SELECT mensagem.conteudo
     FROM mensagem
     WHERE mensagem.idchat = chat.idchat
     ORDER BY mensagem.data_envio DESC
     LIMIT 1) AS ultmsg
FROM 
    chat 
INNER JOIN 
    usuario ON usuario.idusuario = chat.idusuario 
LEFT JOIN 
    mensagem ON chat.idchat = mensagem.idchat 
WHERE 
    chat.idespecialista = ? 
GROUP BY 
    chat.idchat, 
    chat.idusuario, 
    chat.idespecialista, 
    chat.denuncia, 
    usuario.nome
ORDER BY 
    datamsg DESC;
"; }
elseif($_SESSION['role']=='comum'){
    $sql = "SELECT 
    chat.idchat, 
    chat.idusuario, 
    chat.idespecialista, 
    chat.denuncia, 
    usuario.nome, 
    MAX(mensagem.data_envio) AS datamsg,
    (SELECT mensagem.conteudo
     FROM mensagem
     WHERE mensagem.idchat = chat.idchat
     ORDER BY mensagem.data_envio DESC
     LIMIT 1) AS ultmsg
FROM 
    chat 
INNER JOIN 
    usuario ON usuario.idusuario = chat.idespecialista 
LEFT JOIN 
    mensagem ON chat.idchat = mensagem.idchat 
WHERE 
    chat.idusuario = ? 
GROUP BY 
    chat.idchat
ORDER BY 
    datamsg DESC;
";}

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("i",$_SESSION['id_usuario']);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){

    $listaConsultas = $result->fetch_all(MYSQLI_ASSOC);
 }

 desconecta()

?>