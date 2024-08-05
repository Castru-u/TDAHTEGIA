<?php
// Inicia a sessão
session_start();

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tdahtegia"; // Nome do seu banco de dados

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém dados do formulário
    $idpostagem = isset($_POST['idpostagem']) ? intval($_POST['idpostagem']) : 0;
    $idusuario = isset($_POST['idusuario']) ? intval($_POST['idusuario']) : 0;
    $idcomunidade = isset($_POST['idcomunidade']) ? intval($_POST['idcomunidade']) : 0;
    $comentario = isset($_POST['comentario']) ? $conn->real_escape_string($_POST['comentario']) : '';

    // Insere o comentário no banco de dados
    $sql = "INSERT INTO comentarios_postagem (idusuario, idpostagem, idcomunidade, comentario, data_comentario) 
            VALUES (?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $idusuario, $idpostagem, $idcomunidade, $comentario);

    if ($stmt->execute()) {
        // Redireciona de volta para a página de comentários
        header("Location: comentarios.php?postagem_id=" . $idpostagem);
        exit();
    } else {
        echo "Erro ao adicionar comentário: " . $stmt->error;
    }

    $stmt->close();
}

// Obtém os parâmetros da URL
$idpostagem = isset($_GET['postagem_id']) ? intval($_GET['postagem_id']) : 0;
$idcomunidade = isset($_GET['comunidade_id']) ? intval($_GET['comunidade_id']) : 0;
$idusuario = isset($_SESSION['id_usuario']) ? intval($_SESSION['id_usuario']) : 0;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Comentário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 500px;
        }
        .form-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .form-container textarea {
            width: 100%;
            height: 100px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
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
        <h1>Adicionar Comentário</h1>
        <form action="adicionar_comentarios.php" method="post">
            <input type="hidden" name="idpostagem" value="<?php echo $idpostagem; ?>">
            <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
            <input type="hidden" name="idcomunidade" value="<?php echo $idcomunidade; ?>">
            <textarea name="comentario" placeholder="Escreva seu comentário aqui..." required></textarea>
            <input type="submit" value="Enviar Comentário">
        </form>
    </div>
</body>
</html>

<?php
// Fecha a conexão
$conn->close();
?>
