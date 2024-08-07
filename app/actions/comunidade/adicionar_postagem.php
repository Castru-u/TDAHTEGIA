<?php
session_start();
require_once("../../config/validacoes.php");
require_once("../../config/conecta.php");
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../pages/login.php");
    exit();
}
conecta();

// Função para limpar a entrada de dados
function limparEntrada($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Captura o idcomunidade da URL
$idcomunidade = isset($_GET['idcomunidade']) ? intval($_GET['idcomunidade']) : 0;

// Função para verificar se o idcomunidade existe
function verificarIdComunidade($idcomunidade) {
    global $mysqli;
    $sql = "SELECT 1 FROM comunidades WHERE idcomunidade = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $idcomunidade);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();
        return $exists;
    } else {
        echo "<p>Erro ao preparar a consulta: " . $mysqli->error . "</p>";
        return false;
    }
}

// Verifica se o idcomunidade é válido
if (!verificarIdComunidade($idcomunidade)) {
    echo "<p>ID da comunidade inválido.</p>";
    desconecta();
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Depuração: Verifique o valor de idcomunidade recebido via POST
    $idcomunidade_post = isset($_POST['idcomunidade']) ? intval($_POST['idcomunidade']) : 0;
    echo "<p>ID da Comunidade via POST: " . $idcomunidade_post . "</p>";
    
    $titulo = limparEntrada($_POST['titulo']);
    $conteudo = limparEntrada($_POST['conteudo']);
    $idusuario = intval($_SESSION['id_usuario']); 
    $idcomunidade = $idcomunidade_post;

    // Verifica se o arquivo foi enviado
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        $arquivoNome = $_FILES['arquivo']['name'];
        $arquivoTmpNome = $_FILES['arquivo']['tmp_name'];
        $diretorioUploads = '../../../public/uploads/';
        $arquivoNovoNome = uniqid('', true) . '-' . basename($arquivoNome);
        $caminhoArquivo = $diretorioUploads . $arquivoNovoNome;

        // Valida o tipo de arquivo
        $tipoArquivo = strtolower(pathinfo($arquivoNome, PATHINFO_EXTENSION));
        $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'pdf'];
        if (!in_array($tipoArquivo, $tiposPermitidos)) {
            echo "<p>Tipo de arquivo não permitido.</p>";
        } elseif (move_uploaded_file($arquivoTmpNome, $caminhoArquivo)) {
            $sql = "INSERT INTO postagem (titulo, conteudo, arquivo, idusuario, idcomunidade, data_envio, hora_envio) VALUES (?, ?, ?, ?, ?, CURDATE(), CURTIME())";
            global $mysqli;
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sssii", $titulo, $conteudo, $arquivoNovoNome, $idusuario, $idcomunidade);
                if ($stmt->execute()) {
                    header("Location: ../../pages/comunidade.php?idcomunidade=" . $idcomunidade . "&success=1");
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
/* Reset básico */
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

/* Estilos gerais do corpo */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Container do formulário */
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

/* Estilo do título */
.form-container h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

/* Estilo dos campos de entrada */
.form-container textarea,
.form-container input[type="text"],
.form-container input[type="file"],
.form-container input[type="hidden"] {
    width: 100%;
    border-radius: 5px;
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 20px;
    font-size: 16px;
}

/* Estilo específico para o campo de texto */
.form-container textarea {
    height: 150px;
    resize: vertical;
}

/* Estilo do botão de envio */
.form-container input[type="submit"] {
    background: #FF7621;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
}

/* Estilo do botão de envio em hover */
.form-container input[type="submit"]:hover {
    background: #FF914D;
}

/* Estilo do campo de upload */
.form-container input[type="file"] {
    font-size: 16px;
    padding: 10px;
}

/* Responsividade para telas menores */
@media only screen and (max-width: 768px) {
    .form-container {
        margin: 10px;
        padding: 15px;
    }
    
    .form-container h1 {
        font-size: 20px;
    }

    .form-container textarea {
        height: 120px;
    }

    .form-container input[type="submit"] {
        padding: 8px 16px;
        font-size: 14px;
    }
}
.voltar {
    color: black;
    position: fixed;
    left: 10%;
    top: 5%;
    font-size: 3rem;
    font-variation-settings: 'FILL' 0, 'wght' 1000, 'GRAD' 300, 'opsz' 0;
}
    </style>
</head>
<body>
<?php
    require_once("../../config/conecta.php");
    conecta();
    $idcomunidade = isset($_GET['idcomunidade']) ? intval($_GET['idcomunidade']) : 0;
    ?>
<a href="../../pages/comunidade.php?idcomunidade=<?php echo htmlspecialchars($idcomunidade); ?>" class="voltar">
<i class="material-symbols-outlined voltar">arrow_back_ios</i>
</a>
    <div class="form-container">
        <h1>Adicionar Postagem</h1>
        <form action="adicionar_postagem.php?idcomunidade=<?php echo htmlspecialchars($idcomunidade); ?>" method="post" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título da Postagem" required>
            <textarea name="conteudo" placeholder="Digite o conteúdo da postagem..." required></textarea>
            <input type="file" name="arquivo" accept="image/*,video/*,.pdf" required>
            <input type="hidden" name="idcomunidade" value="<?php echo htmlspecialchars($idcomunidade); ?>">
            <input type="submit" value="Adicionar Postagem">
        </form>
    </div>
</body>
</html>
