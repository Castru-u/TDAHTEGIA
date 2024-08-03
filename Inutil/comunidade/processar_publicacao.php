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

// Obtém os dados do formulário
$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo'];
$imagem = NULL;

if (isset($_FILES['imagem']) && $_FILES['imagem']['size'] > 0) {
    $imagem = addslashes(file_get_contents($_FILES['imagem']['tmp_name']));
}

// Insere a publicação no banco de dados
$sql = "INSERT INTO publicacoes (titulo, conteudo, imagem) VALUES ('$titulo', '$conteudo', '$imagem')";

if ($conn->query($sql) === TRUE) {
    echo "Publicação adicionada com sucesso.";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Fecha a conexão
$conn->close();

// Redireciona de volta para a página principal
header("Location: publicacao_teste.php");
exit();
?>
