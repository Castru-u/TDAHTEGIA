<?php
define('BASE_PATH', __DIR__ . '/../../app/pages');
require_once(BASE_PATH . '/cabecalho.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tdahtegia";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Mensagem de status
$mensagem = "";

// Processar o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $categoria = $conn->real_escape_string($_POST['categoria']);
    
    // Processar arquivo
    $arquivo = null;
    $tipoArquivo = null;
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == UPLOAD_ERR_OK) {
        // Verificar o tipo de arquivo
        $tipoArquivo = $_FILES['arquivo']['type'];
        // Definir tipos de arquivos aceitos
        $tiposAceitos = [
            'application/pdf',
            'image/jpeg',
            'image/png',
            'image/gif',
            'audio/mpeg',
            'audio/wav',
            'audio/ogg',
            'video/mp4',
            'video/webm',
            'video/ogg',
            'application/zip',
            'application/gzip',
            'application/x-tar',
            'application/x-bzip2',
            'application/x-sh',
            'application/x-python',
            'font/woff',
            'font/woff2',
            'font/otf',
            'font/ttf'
        ];
        
        if (in_array($tipoArquivo, $tiposAceitos)) {
            $arquivo = file_get_contents($_FILES['arquivo']['tmp_name']);
        } else {
            $mensagem = "Tipo de arquivo não suportado.";
        }
    } else {
        $mensagem = "Nenhum arquivo enviado ou erro no envio.";
    }

    // Inserir dados no banco de dados
    if ($arquivo !== null) {
        $sql = "INSERT INTO materiais (nome, descricao, categoria, tipo_arquivo, arquivo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        // Bind dos parâmetros. LONGBLOB requer o tipo 'b' para binário
        $stmt->bind_param('sssss', $nome, $descricao, $categoria, $tipoArquivo, $arquivo);

        if ($stmt->execute()) {
            // Redirecionar para a página de mostrar materiais
            header('Location: http://localhost/TDAHTEGIA/Inutil/teste/criar_materias.php');
            exit(); // Certifique-se de chamar exit após o redirecionamento
        } else {
            $mensagem = "Erro: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Fechar conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Material de Estudo</title>
    <link rel="stylesheet" href="material.css">
</head>
<body>
    <main>
        <div class="container">
            <h1>Novo Material de Estudo</h1>
            <form action="criar_materias.php" method="POST" enctype="multipart/form-data">
                <label for="nome">Nome do Material:</label>
                <input type="text" id="nome" name="nome" required>
                
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4"></textarea>

                <label for="categoria">Categoria:</label>
                <select id="categoria" name="categoria" required>
                    <option value="matematica">Matemática</option>
                    <option value="fisica">Física</option>
                    <option value="quimica">Química</option>
                    <option value="biologia">Biologia</option>
                    <option value="vestibular">Vestibular</option>
                </select>
                
                <label for="arquivo">Arquivo:</label>
                <input type="file" id="arquivo" name="arquivo" accept=".pdf, .jpeg, .jpg, .png, .gif, .mp3, .wav, .ogg, .mp4, .webm, .zip, .gz, .tar, .bz2, .sh, .py, .woff, .woff2, .otf, .ttf" required>
                
                <button type="submit" name="criar">Criar Material</button>
            </form>

            <!-- Mensagem de status -->
            <?php if (!empty($mensagem)) : ?>
                <p><?php echo htmlspecialchars($mensagem); ?></p>
            <?php endif; ?>
        </div>
    </main>

    <footer><p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p></footer>
</body>
</html>
