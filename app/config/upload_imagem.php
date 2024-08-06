<?php

session_start();
require_once("conecta.php");
require_once("validacoes.php");

function uploadImagem($imagem) {

    $novonome = uniqid() . "_" . basename($imagem["name"]);// Definir um nome único para o arquivo
    $diretorio = "../../../public/uploads/"; // Diretório para armazenar as imagens
    $arqImagem = $diretorio . $novonome; // Caminho completo do arquivo

    if ($imagem["error"] !== UPLOAD_ERR_OK) {
        return "Erro no upload: " . $imagem["error"];
    }

    if (!is_dir($diretorio)) {
        die("O diretório de uploads não existe.");
    }

    $tipoImagem = mime_content_type($imagem["tmp_name"]);
    if (strpos($tipoImagem, "image") === false) {
        return "O arquivo não é uma imagem.";
    }

    if (!is_writable($diretorio)) {
        return "O diretório de uploads não é gravável.";
    }

 
    if (move_uploaded_file($imagem["tmp_name"], $arqImagem)) {
        
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

        $stmt->bind_param("si", $novonome, $user->idusuario);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $msg = "Foto atualizada com sucesso.";
        } else {
            $msg = "Não foi possível atualizar a foto.";
        }

        $stmt->close();
        desconecta();

        return $msg;
    } else {
        return "Não foi possível mover a imagem para o diretório de uploads.";
    }
}
?>
