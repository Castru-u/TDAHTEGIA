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

// Consulta para obter todas as publicações
$sql = "SELECT * FROM publicacoes ORDER BY data_publicacao DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicações</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100%;
        }
        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            max-width: 500px;
            min-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Alinha o conteúdo à esquerda */
            text-align: left; /* Alinha o texto à esquerda */
        }
        .perfil-foto {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        .perfil-foto img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .perfil-nome {
            margin-left: 10px;
            font-size: 24px;
            color: #333;
        }
        .descricao img {
            width: 100%; /* Aumente a largura conforme necessário */
            height: auto; /* Mantém a proporção da imagem */
            max-height: 500px;
            border-radius: 10px;
            /* margin: 10px 0; */
        }
        .descricao{
            width: 100%;

        }
        .descricao p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }
        .comentarios {
            margin-top: 20px;
            width: 100%;
        }
        .comentarios h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }
        .comentario {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            /* padding: 10px; */
            margin-bottom: 10px;
        }
        .perfil_organizado {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .perfil_organizado img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 5px;
        }
        .comentario h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }
        .comentario p {
            /* margin-left: 10px; */
            font-size: 14px;
            color: #666;
        }
        .comentarios a {
            color: #007bff;
            text-decoration: none;
        }
        .comentarios a:hover {
            text-decoration: underline;
        }
        .form-comentario {
            margin-top: 20px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .form-comentario textarea {
            width: 90%;
            max-width: 500px;
            /* height: 100px; */
            border-radius: 5px;
            border: 1px solid #ddd;
            /* padding: 10px; */
            margin-bottom: 10px;
        }
        .form-comentario input[type="text"] {
            width: 90%;
            max-width: 500px;
            border-radius: 5px;
            border: 1px solid #ddd;
            /* padding: 10px; */
            margin-bottom: 10px;
        }
        .form-comentario input[type="submit"] {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .form-comentario input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    if ($result->num_rows > 0) {
        // Exibe as publicações
        while($row = $result->fetch_assoc()) {
            echo "<div class='container'>";
            echo "<div class='perfil-foto'>";
            echo "<img src='perfil.jpeg' alt='Foto do Usuário'>";
            echo "<h1 class='perfil-nome'>" . htmlspecialchars($row["titulo"]) . "</h1>";
            echo "</div>";
            echo "<div class='descricao'>";
            if ($row["imagem"]) {
                echo "<img src='data:image/jpeg;base64," . base64_encode($row["imagem"]) . "' alt='Postagem'>";
            }
            echo "<p>" . nl2br(htmlspecialchars($row["conteudo"])) . "</p>";
            echo "</div>";
            echo "<div class='comentarios'>";
            echo "<h2>Comentários</h2>";
            
            // Link para a página de comentários
            echo "<a href='comentarios.php?publicacao_id=" . $row["id"] . "'>Ver Comentários</a>";

            // Adiciona o formulário de comentário
            echo "<div class='form-comentario'>";
            echo "<h2>Adicionar Comentário</h2>";
            echo "<form action='adicionar_comentario.php' method='post'>";
            echo "<input type='hidden' name='publicacao_id' value='" . $row["id"] . "'>";
            echo "<input type='text' name='autor' placeholder='Seu nome' required>";
            echo "<textarea name='comentario' placeholder='Escreva seu comentário aqui...' required></textarea>";
            echo "<input type='submit' value='Enviar'>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div class='container'>Nenhuma publicação encontrada.</div>";
    }

    // Fecha a conexão
    $conn->close();
    ?>
</body>
</html>
