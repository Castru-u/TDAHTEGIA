<?php
session_start();
require_once("../../config/validacoes.php");
require_once("../../config/conecta.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../pages/login.php");
    exit();
}

conecta(); 

$action = $_POST['action'] ?? '';
$idcomunidade = intval($_POST['idcomunidade'] ?? 0);
$idusuario = intval($_POST['idusuario'] ?? 0);
$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$imagem = null;
$role = $_POST['role'] ?? '';

switch ($action) {
    case 'create':
        if (!empty($_FILES['imagem']['tmp_name'])) {
            $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        }

        $stmt = $mysqli->prepare("INSERT INTO comunidades (nome, descricao, categoria, imagem) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $nome, $descricao, $categoria, $imagem);
        if ($stmt->execute()) {
            header("Location: ../../pages/mostrar_comunidade.php?success=1");
        } else {
            error_log("Erro ao criar comunidade: " . $stmt->error); // Adiciona log de erro
            header("Location: ../../pages/crud.php?error=1");
        }
        $stmt->close();
        break;

    case 'update':
        if (!empty($_FILES['imagem']['tmp_name'])) {
            $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
            $stmt = $mysqli->prepare("UPDATE comunidades SET nome = ?, descricao = ?, categoria = ?, imagem = ? WHERE idcomunidade = ?");
            $stmt->bind_param('ssssi', $nome, $descricao, $categoria, $imagem, $idcomunidade);
        } else {
            $stmt = $mysqli->prepare("UPDATE comunidades SET nome = ?, descricao = ?, categoria = ? WHERE idcomunidade = ?");
            $stmt->bind_param('sssi', $nome, $descricao, $categoria, $idcomunidade);
        }
        if ($stmt->execute()) {
            header("Location: ../../pages/mostrar_comunidade.php?idcomunidade=$idcomunidade&success=1");
        } else {
            error_log("Erro ao atualizar comunidade: " . $stmt->error); // Adiciona log de erro
            header("Location: ../../pages/mostrar_comunidade.php?idcomunidade=$idcomunidade&error=1");
        }
        $stmt->close();
        break;

    case 'add_user':
        $stmt = $mysqli->prepare("INSERT INTO comunidade_usuario (idcomunidade, idusuario, role) VALUES (?, ?, ?)");
        $stmt->bind_param('iis', $idcomunidade, $idusuario, $role);
        if ($stmt->execute()) {
            header("Location: ../../pages/mostrar_comunidade.php?idcomunidade=$idcomunidade&success=1");
        } else {
            error_log("Erro ao adicionar usuário: " . $stmt->error); // Adiciona log de erro
            header("Location: ../../pages/crud.php?idcomunidade=$idcomunidade&error=1");
        }
        $stmt->close();
        break;

    case 'remove_user':
        $stmt = $mysqli->prepare("DELETE FROM comunidade_usuario WHERE idcomunidade = ? AND idusuario = ?");
        $stmt->bind_param('ii', $idcomunidade, $idusuario);
        if ($stmt->execute()) {
            header("Location: ../../pages/mostrar_comunidade.php?idcomunidade=$idcomunidade&success=1");
        } else {
            error_log("Erro ao remover usuário: " . $stmt->error); // Adiciona log de erro
            header("Location: ../../pages/crud.php?idcomunidade=$idcomunidade&error=1");
        }
        $stmt->close();
        break;

    case 'delete':
        // Inicie uma transação para garantir a integridade dos dados
        $mysqli->begin_transaction();
        try {
            // Exclua as postagens associadas à comunidade
            $stmt = $mysqli->prepare("DELETE FROM postagem WHERE idcomunidade = ?");
            $stmt->bind_param('i', $idcomunidade);
            $stmt->execute();
            $stmt->close();

            // Exclua os comentários associados às postagens da comunidade
            $stmt = $mysqli->prepare("DELETE FROM comentarios_postagem WHERE idcomunidade = ?");
            $stmt->bind_param('i', $idcomunidade);
            $stmt->execute();
            $stmt->close();

            // Exclua os usuários associados à comunidade
            $stmt = $mysqli->prepare("DELETE FROM comunidade_usuario WHERE idcomunidade = ?");
            $stmt->bind_param('i', $idcomunidade);
            $stmt->execute();
            $stmt->close();

            // Exclua a comunidade
            $stmt = $mysqli->prepare("DELETE FROM comunidades WHERE idcomunidade = ?");
            $stmt->bind_param('i', $idcomunidade);
            $stmt->execute();
            $stmt->close();

            // Confirme a transação
            $mysqli->commit();
            header("Location: ../../pages/mostrar_comunidade.php");
        } catch (Exception $e) {

            $mysqli->rollback();
            error_log("Erro ao deletar comunidade: " . $e->getMessage()); 
            header("Location: ../../pages/crud.php?error=1");
        }
        break;

    default:
        header("Location: ../../pages/crud.php?error=1");
}

desconecta(); 
?>
