<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root"; // Altere conforme necessário
$password = ""; // Altere conforme necessário
$dbname = "publicacoes_db";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém dados do formulário
$publicacao_id = isset($_POST['publicacao_id']) ? intval($_POST['publicacao_id']) : 0;
$autor = isset($_POST['autor']) ? $conn->real_escape_string($_POST['autor']) : '';
$comentario = isset($_POST['comentario']) ? $conn->real_escape_string($_POST['comentario']) : '';

// Insere o comentário no banco de dados
$sql = "INSERT INTO comentarios (publicacao_id, autor, comentario, data_comentario) VALUES ($publicacao_id, '$autor', '$comentario', NOW())";

if ($conn->query($sql) === TRUE) {
    // Redireciona de volta para a página de comentários
    header("Location: comentarios.php?publicacao_id=" . $publicacao_id);
} else {
    echo "Erro ao adicionar comentário: " . $conn->error;
}

// Fecha a conexão
$conn->close();
?>
