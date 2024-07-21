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
            margin-top: 5%;
            margin-bottom: 10%;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;

        }
        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .perfil-foto {
            display: flex;
            align-items: center;
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
            width: 20%;
            height: auto;
            border-radius: 10px;
            margin: 10px 0;
        }
        .descricao p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }
        .comentarios {
            margin-top: 20px;
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
            padding: 10px;
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
            margin-left: 10px;
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
            // Simulando comentários, você pode substituir pelo código para buscar comentários do banco de dados
            echo "<div class='comentario'>";
            echo "<div class='perfil_organizado'>";
            echo "<img src='perfil.jpeg' alt='Foto do Usuário'>";
            echo "<h3>THWAVERTON</h3>";
            echo "</div>";
            echo "<p>Ótima foto! Adorei.</p>";
            echo "</div>";
            echo "<div class='comentario'>";
            echo "<div class='perfil_organizado'>";
            echo "<img src='perfil.jpeg' alt='Foto do Usuário'>";
            echo "<h3>THWAVERTON</h3>";
            echo "</div>";
            echo "<p>Interessante! Parece um lugar legal.</p>";
            echo "</div>";
            echo "<div class='comentario'>";
            echo "<div class='perfil_organizado'>";
            echo "<img src='perfil.jpeg' alt='Foto do Usuário'>";
            echo "<h3>THWAVERTON</h3>";
            echo "</div>";
            echo "<p>Obrigado por compartilhar.</p>";
            echo "</div>";
            echo "<a href='comentarios.php'>Ver + Comentários</a>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "Nenhuma publicação encontrada.";
    }

    // Fecha a conexão
    $conn->close();
    ?>
</body>
</html>
