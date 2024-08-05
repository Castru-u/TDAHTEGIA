<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tdahtegia"; // Altere para o nome do seu banco de dados

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém dados do formulário
$idpostagem = isset($_POST['idpostagem']) ? intval($_POST['idpostagem']) : 0;
$idusuario = isset($_POST['idusuario']) ? intval($_POST['idusuario']) : 0;
$idcomunidade = isset($_POST['idcomunidade']) ? intval($_POST['idcomunidade']) : 0;
$comentario = isset($_POST['comentario']) ? $conn->real_escape_string($_POST['comentario']) : '';

// Insere o comentário no banco de dados
$sql = "INSERT INTO comentarios_postagem (idusuario, idpostagem, idcomunidade, comentario, data_comentario) 
        VALUES (?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiis", $idusuario, $idpostagem, $idcomunidade, $comentario);

if ($stmt->execute()) {
    // Redireciona de volta para a página de comentários
    header("Location: comentarios.php?postagem_id=" . $idpostagem);
    exit();
} else {
    echo "Erro ao adicionar comentário: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
