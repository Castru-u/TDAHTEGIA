<?php
session_start();
require_once("../../config/validacoes.php");
require_once("../../config/conecta.php"); // Inclui o arquivo de conexão

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../pages/login.php");
    exit();
}

// Estabelece a conexão com o banco de dados
conecta(); // Usa a função do arquivo conecta.php para conectar ao banco de dados

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
        } else {
            $imagem = null;
        }

        $stmt = $mysqli->prepare("INSERT INTO comunidades (nome, descricao, categoria, imagem) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $nome, $descricao, $categoria, $imagem);
        if ($stmt->execute()) {
            header("Location: ../../pages/crud.php?success=1");
        } else {
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
            header("Location: ../../pages/crud.php?idcomunidade=$idcomunidade&error=1");
        }
        $stmt->close();
        break;

    default:
        header("Location: ../../pages/crud.php?error=1");
}

// Fecha a conexão com o banco de dados
desconecta();
?>
