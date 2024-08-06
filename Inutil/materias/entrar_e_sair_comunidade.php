<?php
session_start();
require_once("../../app/config/validacoes.php");

if (!isset($_SESSION['id_usuario'])) {
    echo "Você precisa estar logado para participar de uma comunidade.";
    exit();
}

$idusuario = $_SESSION['id_usuario'];
$idcomunidade = isset($_POST['idcomunidade']) ? $_POST['idcomunidade'] : '';
$acao = isset($_POST['acao']) ? $_POST['acao'] : ''; // 'entrar' ou 'sair'

if ($idcomunidade && ($acao === 'entrar' || $acao === 'sair')) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tdahtegia";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    if ($acao === 'entrar') {
        // Verifica se o usuário já está na comunidade
        $sql_check = "SELECT * FROM comunidade_usuario WHERE idusuario = ? AND idcomunidade = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param('ii', $idusuario, $idcomunidade);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            echo "Você já está na comunidade.";
        } else {
            // Insere o usuário na comunidade
            $sql_insert = "INSERT INTO comunidade_usuario (idusuario, idcomunidade) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param('ii', $idusuario, $idcomunidade);

            if ($stmt_insert->execute()) {
                echo "Você entrou na comunidade com sucesso.";
            } else {
                echo "Erro ao entrar na comunidade.";
            }
        }
    } elseif ($acao === 'sair') {
        // Remove o usuário da comunidade
        $sql_delete = "DELETE FROM comunidade_usuario WHERE idusuario = ? AND idcomunidade = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param('ii', $idusuario, $idcomunidade);

        if ($stmt_delete->execute()) {
            echo "Você saiu da comunidade com sucesso.";
        } else {
            echo "Erro ao sair da comunidade.";
        }
    }

    $conn->close();
} else {
    echo "ID da comunidade ou ação não fornecido.";
}
?>
