<?php
define('BASE_PATH', __DIR__ . '/../../app/pages');
require_once(BASE_PATH . '/cabecalho.php');
require_once('../config/conecta.php');

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../app/pages/login.php");
    exit();
}

$idusuario = $_SESSION['id_usuario'];

// Caminho para a imagem padrão
$imagemPadrao = '../../public/img/tdah_menino.jpeg'; 

$mensagem = "";

// Processar o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $descricao = htmlspecialchars($_POST['descricao']);
    $categoria = htmlspecialchars($_POST['categoria']);
    
    conecta();
    
    $imagem = null;

    // Processar imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $tipoImagem = $_FILES['imagem']['type'];
        if (in_array($tipoImagem, ['image/jpeg', 'image/png', 'image/gif'])) {
            $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        } else {
            $mensagem = "Tipo de imagem não suportado.";
        }
    } else {
        // Usar a imagem padrão se nenhuma imagem for enviada
        $imagem = file_get_contents($imagemPadrao);
    }
    if ($imagem !== null) {
        $sql = "INSERT INTO comunidades (nome, descricao, categoria, imagem) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssss', $nome, $descricao, $categoria, $imagem);

        if ($stmt->execute()) {
            $idcomunidade = $stmt->insert_id;

            // Associar o usuário criador à nova comunidade como administrador
            $sqlAssociacao = "INSERT INTO comunidade_usuario (idcomunidade, idusuario, role) VALUES (?, ?, 'admin')";
            $stmtAssociacao = $mysqli->prepare($sqlAssociacao);
            $stmtAssociacao->bind_param('ii', $idcomunidade, $idusuario);

            if ($stmtAssociacao->execute()) {
                header('Location: http://localhost/TDAHTEGIA/Inutil/materias/mostrar_comunidades.php');
                exit();
            } else {
                $mensagem = "Erro ao associar usuário à comunidade: " . $stmtAssociacao->error;
            }

            $stmtAssociacao->close();
        } else {
            $mensagem = "Erro ao criar comunidade: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $mensagem = "Erro ao processar a imagem.";
    }
    desconecta();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Comunidade</title>
    <link rel="stylesheet" href="../../public/css/material.css">
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
            <?php if (!empty($mensagem)) : ?>
                <p><?php echo htmlspecialchars($mensagem); ?></p>
            <?php endif; ?>
        </div>
    </main>

    <footer><p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p></footer>
</body>
</html>
