<?php

session_start();
require_once("conecta.php");
require_once("validacoes.php");

function uploadImagem($imagem) {
    // Definir um nome único para o arquivo
    $novonome = uniqid() . "_" . basename($imagem["name"]); 
    $diretorio = "../../../public/uploads/"; // Diretório para armazenar as imagens
    $arqImagem = $diretorio . $novonome; // Caminho completo do arquivo

    // Verificar se há erros no upload
    if ($imagem["error"] !== UPLOAD_ERR_OK) {
        return "Erro no upload: " . $imagem["error"];
    }

    if (!is_dir($diretorio)) {
        die("O diretório de uploads não existe.");
    }

    // Verificar o tipo de imagem (opcional)
    $tipoImagem = mime_content_type($imagem["tmp_name"]);
    if (strpos($tipoImagem, "image") === false) {
        return "O arquivo não é uma imagem.";
    }

    // Verificar permissões do diretório
    if (!is_writable($diretorio)) {
        return "O diretório de uploads não é gravável.";
    }

    // Mover o arquivo para o diretório de destino
    if (move_uploaded_file($imagem["tmp_name"], $arqImagem)) {
        // Conectar ao banco de dados
        

        // Obter informações do usuário
        $user = retornaUser($_SESSION['id_usuario']);
        if ($user->foto !== 'default_user.jpg') {
            // Remover imagem antiga, se não for a imagem padrão
            unlink($diretorio . $user->foto);
        }
        conecta();
        global $mysqli;

        // Atualizar o banco de dados
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
