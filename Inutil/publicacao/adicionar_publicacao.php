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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $conn->real_escape_string($_POST["titulo"]);
    $conteudo = $conn->real_escape_string($_POST["conteudo"]);
    
    // Processa a imagem carregada
    $imagem = NULL;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    }
    
    // Insere a nova publicação no banco de dados
    $stmt = $conn->prepare("INSERT INTO publicacoes (titulo, conteudo, imagem) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $conteudo, $imagem);

    if ($stmt->execute()) {
        echo "Publicação adicionada com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Publicação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .form-group input[type="file"] {
            padding: 0;
        }
    </style>
</head>
<body>
    <h1>Adicionar Publicação</h1>
    <div class="form-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo:</label>
                <textarea id="conteudo" name="conteudo" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" id="imagem" name="imagem" accept="image/*">
            </div>
            <div class="form-group">
                <button type="submit">Adicionar Publicação</button>
            </div>
        </form>
    </div>
</body>
</html>
