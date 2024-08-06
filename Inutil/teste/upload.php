<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tdahtegia";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!<br>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $tipo_arquivo = $_POST['tipo_arquivo'];
    
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        $arquivo = file_get_contents($_FILES['arquivo']['tmp_name']);
        
        $stmt = $conn->prepare("INSERT INTO materiais (nome, descricao, categoria, tipo_arquivo, arquivo) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }
        
        // Bind dos parâmetros. LONGBLOB requer o tipo 'b'
        $stmt->bind_param("sssss", $nome, $descricao, $categoria, $tipo_arquivo, $arquivo);
        
        if ($stmt->execute()) {
            echo "Arquivo enviado com sucesso!";
        } else {
            echo "Erro ao enviar o arquivo: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Erro no upload do arquivo: " . $_FILES['arquivo']['error'];
    }
}

$conn->close();
?>
