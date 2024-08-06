<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../pages/login.php");
    exit();
} 

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tdahtegia";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o idpostagem está definido
if (isset($_GET['idpostagem'])) {
    $idpostagem = $_GET['idpostagem'];
    
    // Verifica se o usuário tem permissão para deletar a postagem
    // Supondo que o administrador tem permissão para deletar qualquer postagem
    $idusuario = $_SESSION['id_usuario'];
    $is_admin = $_SESSION['role'] == 'admin';

    // Verifica se a postagem pertence ao usuário ou se o usuário é admin
    $sql_check = "SELECT idusuario FROM postagem WHERE idpostagem = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $idpostagem);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $post = $result_check->fetch_assoc();
        if ($post['idusuario'] == $idusuario || $is_admin) {
            // Deleta a postagem
            $sql_delete = "DELETE FROM postagem WHERE idpostagem = ?";
            $stmt_delete = $conn->prepare($sql_delete);
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

$conn->close();
?>
