<?php
define('BASE_PATH', __DIR__ . '/../../app/pages');
require_once(BASE_PATH . '/cabecalho.php');

// Definições de conexão com o banco de dados
$servername = "localhost"; // Altere conforme necessário
$username = "root";        // Altere conforme necessário
$password = "";            // Altere conforme necessário
$dbname = "tdahtegia";     // Altere conforme necessário

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
    
    // Processar imagem
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        // Verificar o tipo de arquivo
        $tipoImagem = $_FILES['imagem']['type'];
        if (in_array($tipoImagem, ['image/jpeg', 'image/png', 'image/gif'])) {
            $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        } else {
            $mensagem = "Tipo de imagem não suportado.";
        }
    }

    // Inserir dados no banco de dados
    if ($imagem !== null) {
        $sql = "INSERT INTO comunidades (nome, descricao, categoria, imagem) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $nome, $descricao, $categoria, $imagem);

        if ($stmt->execute()) {
            // Redirecionar para a página de mostrar comunidades
            header('Location: http://localhost/TDAHTEGIA/Inutil/materias/mostrar_comunidades.php');
            exit(); // Certifique-se de chamar exit após o redirecionamento
        } else {
            $mensagem = "Erro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $mensagem = "Erro ao processar a imagem.";
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
    <title>Criar Comunidade</title>
    <link rel="stylesheet" href="material.css">
</head>
<body>
    <main>
        <div class="container">
            <h1>Nova Comunidade</h1>
            <form action="criar_comunidade.php" method="POST" enctype="multipart/form-data">
                <label for="nome">Nome da Comunidade:</label>
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
                
                <label for="imagem">Imagem da Comunidade:</label>
                <input type="file" id="imagem" name="imagem" accept="image/*">
                
                <button type="submit" name="criar">Criar Comunidade</button>
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
