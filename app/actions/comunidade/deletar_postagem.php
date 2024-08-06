<?php
session_start();
require_once("../../config/conecta.php"); // Inclui o arquivo de conexão

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../pages/login.php");
    exit();
}

// Estabelece a conexão com o banco de dados
conecta(); // Usa a função do arquivo conecta.php para conectar ao banco de dados

// Verifica se o idpostagem está definido
if (isset($_GET['idpostagem'])) {
    $idpostagem = intval($_GET['idpostagem']);
    
    // Verifica se o usuário tem permissão para deletar a postagem
    // Supondo que o administrador tem permissão para deletar qualquer postagem
    $idusuario = intval($_SESSION['id_usuario']);
    $is_admin = $_SESSION['role'] == 'admin';

    // Verifica se a postagem pertence ao usuário ou se o usuário é admin
    $sql_check = "SELECT idusuario FROM postagem WHERE idpostagem = ?";
    $stmt_check = $mysqli->prepare($sql_check);
    $stmt_check->bind_param("i", $idpostagem);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $post = $result_check->fetch_assoc();
        if ($post['idusuario'] == $idusuario || $is_admin) {
            // Deleta a postagem
            $sql_delete = "DELETE FROM postagem WHERE idpostagem = ?";
            $stmt_delete = $mysqli->prepare($sql_delete);
            $stmt_delete->bind_param("i", $idpostagem);
            if ($stmt_delete->execute()) {
                // Redireciona para a página de publicações com sucesso
                header("Location: ../../pages/comunidade.php?deletado=1");
            } else {
                echo "Erro ao deletar a postagem: " . $stmt_delete->error;
            }
        } else {
            echo "Você não tem permissão para deletar esta postagem.";
        }
    } else {
        echo "Postagem não encontrada.";
    }
} else {
    echo "ID da postagem não definido.";
}

// Fecha a conexão com o banco de dados
desconecta();
?>
