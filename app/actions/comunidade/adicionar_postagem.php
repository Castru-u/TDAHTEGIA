<?php
session_start();
require_once("../../config/validacoes.php");
require_once("../../config/conecta.php"); 
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../pages/login.php");
    exit();
}
conecta(); 
function limparEntrada($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = limparEntrada($_POST['titulo']);
    $conteudo = limparEntrada($_POST['conteudo']);
    $idusuario = intval($_SESSION['id_usuario']); 
    $idcomunidade = intval($_POST['idcomunidade']);
    $arquivoNome = $_FILES['arquivo']['name'];
    $arquivoTmpNome = $_FILES['arquivo']['tmp_name'];
    $arquivoErro = $_FILES['arquivo']['error'];
    $diretorioUploads = '/opt/lampp/htdocs/TDAHTEGIA/public/uploads/';
    $arquivoNovoNome = uniqid('', true) . '-' . basename($arquivoNome);
    $caminhoArquivo = $diretorioUploads . $arquivoNovoNome;
    if ($arquivoErro === 0) {
        if (move_uploaded_file($arquivoTmpNome, $caminhoArquivo)) {
            $sql = "INSERT INTO postagem (titulo, conteudo, arquivo, idusuario, idcomunidade, data_envio, hora_envio) VALUES (?, ?, ?, ?, ?, CURDATE(), CURTIME())";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sssii", $titulo, $conteudo, $arquivoNovoNome, $idusuario, $idcomunidade);

                if ($stmt->execute()) {
                    header("Location: ../../pages/comunidade.php?success=1");
                    exit();
                } else {
                    echo "<p>Erro ao adicionar postagem: " . $stmt->error . "</p>";
                }

                $stmt->close();
            } else {
                echo "<p>Erro ao preparar a consulta: " . $mysqli->error . "</p>";
            }
        } else {
            echo "<p>Erro ao mover o arquivo para o diretório de uploads.</p>";
        }
    } else {
        echo "<p>Erro no upload do arquivo: " . $_FILES['arquivo']['error'] . "</p>";
    }
}
desconecta();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Postagem</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        .form-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
            max-width: 600px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .form-container textarea,
        .form-container input[type="text"],
        .form-container input[type="file"],
        .form-container input[type="hidden"] {
            width: 100%;
            max-width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
        }
        .form-container textarea {
            height: 150px;
        }
        .form-container input[type="submit"] {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Adicionar Postagem</h1>
        <form action="adicionar_postagem.php" method="post" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título da Postagem" required>
            <textarea name="conteudo" placeholder="Digite o conteúdo da postagem..." required></textarea>
            <input type="file" name="arquivo" accept="image/*,video/*,.pdf">
            <input type="hidden" name="idcomunidade" value="1"> <!-- Altere conforme necessário ou remova se não for necessário -->
            <input type="submit" value="Adicionar Postagem">
        </form>
    </div>
</body>
</html>
