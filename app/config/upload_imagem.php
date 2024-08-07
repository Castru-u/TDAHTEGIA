<?php

session_start();
require_once("conecta.php");
require_once("validacoes.php");

function uploadImagem($imagem) {

    $novonome = str_replace(" ","",uniqid() . "_" . basename($imagem["name"]));// Definir um nome único para o arquivo
    $diretorio = "../../../public/uploads/"; // Diretório para armazenar as imagens
    $arqImagem = $diretorio . $novonome; // Caminho completo do arquivo

    if ($imagem["error"] !== UPLOAD_ERR_OK) {
        return "Erro no upload: " . $imagem["error"];
    }

    if (!is_dir($diretorio)) {
        die("O diretório de uploads não existe.");
    }

    if (!is_writable($diretorio)) {
        return "O diretório de uploads não é gravável.";
    }

    if (move_uploaded_file($imagem["tmp_name"], $arqImagem)) {
        return $novonome;
    } else {
        return "Não foi possível mover a imagem para o diretório de uploads.";
    }
}
?>
