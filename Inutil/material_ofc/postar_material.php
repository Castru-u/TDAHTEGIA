<?php
define('BASE_PATH', __DIR__ . '/../../app/pages');
require_once(BASE_PATH . '/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_envio = date('Y-m-d');
    $hora_envio = date('H:i:s');
    $idusuario = 1; // Substitua com a lógica para obter o ID do usuário logado

    // Upload do arquivo
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
        $arquivo = $_FILES['arquivo']['name'];
        $caminho_temp = $_FILES['arquivo']['tmp_name'];
        $caminho_destino = '/opt/lampp/htdocs/TDAHTEGIA/public/uploads/' . $arquivo;
        
        if (move_uploaded_file($caminho_temp, $caminho_destino)) {
            // Inserir informações no banco de dados
            try {
                $stmt = $pdo->prepare("INSERT INTO material (arquivo, titulo, descricao, data_envio, hora_envio, idusuario) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$arquivo, $titulo, $descricao, $data_envio, $hora_envio, $idusuario]);
                echo 'Material enviado com sucesso!';
            } catch (PDOException $e) {
                echo 'Erro ao inserir dados no banco de dados: ' . $e->getMessage();
            }
        } else {
            echo 'Falha ao mover o arquivo para o diretório de uploads.';
        }
    } else {
        echo 'Nenhum arquivo enviado ou erro no upload.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postar Material</title>
    <link rel="stylesheet" href="material.css">
</head>
<body>
    <?php require_once(BASE_PATH . '/cabecalho.php'); ?>

    <main>
        <div class="container">
            <h1>Postar Novo Material</h1>
            <form action="postar_material.php" method="post" enctype="multipart/form-data">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
                
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>
                
                <label for="arquivo">Arquivo:</label>
                <input type="file" id="arquivo" name="arquivo" accept=".pdf, .doc, .docx, .ppt, .pptx" required>
                
                <button type="submit">Enviar</button>
            </form>
        </div>
    </main>
    
    <footer><p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p></footer>
</body>
</html>
