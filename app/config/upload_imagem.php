<?php

require_once("conecta.php")

function uploadImagem($imagem){

    $novonome = uniqid()."".$imagem["name"]; /*SELECIONA O NOME DO ARQUIVO E CRIA UM ID UNICO PARA ELE*/
    $diretorio = "../../public/uploads/"; /*SELECIONA O DIRETORIO ONDE SERÃO ARMAZENADAS AS IMAGENS*/
    $arqImagem = $diretorio.$novonome; /*CONCATENA PARA CRIAR O CAMINHO PARA A IMAGEM*/
    if(move_uploaded_file($imagem["tmp_name"], $arqImagem)) /*ADICIONA A IMAGEM NO CAMINHO CRIADO*/{

        /*ADICIONA O NOME DO ARQUIVO NO BANCO DE DADOS*/
        conecta();

        global $mysqli;

        $sql = "UPDATE usuario SET foto = (?);";

        $stmt = $mysqli->prepare($sql);

        if(!$stmt){
            die("Erro ao inserir. Problema no acesso ao banco de dados");
        }

        $stmt->bind_param("s",$novonome);

        $stmt->execute();

        if($stmt->affected_rows > 0){
            $msg = "Foto inserida com sucesso.";
        }else{
            $msg = "Não foi possível inserir.";
        }

        desconecta();

        return $arqImagem;
    }else{
        return null;
    }
}

?>