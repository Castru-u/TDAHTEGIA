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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Publicações</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .publicacao {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
        }
        .titulo {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .data-publicacao {
            color: #888;
            font-size: 0.9em;
        }
        .imagem {
            width: 40px;
            /* height: 40px; */
            height: auto;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Publicações</h1>

    <?php
    if ($result->num_rows > 0) {
        // Exibe as publicações
        while($row = $result->fetch_assoc()) {
            echo "<div class='publicacao'>";
            echo "<div class='titulo'>" . htmlspecialchars($row["titulo"]) . "</div>";
            echo "<div class='data-publicacao'>Publicado em: " . $row["data_publicacao"] . "</div>";
            if ($row["imagem"]) {
                echo "<img src='data:image/jpeg;base64," . base64_encode($row["imagem"]) . "' class='imagem' />";
            }
            echo "<div class='conteudo'>" . nl2br(htmlspecialchars($row["conteudo"])) . "</div>";
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
