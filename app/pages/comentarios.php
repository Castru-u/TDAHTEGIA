<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentários</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
            margin-top: 10%;
        }
        .voltar {
            color: black;
            position: fixed;
            left: 10%;
            top: 5%;
            font-size: 3rem;
            font-variation-settings: 'FILL' 0, 'wght' 1000, 'GRAD' 300, 'opsz' 0;
            }
        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 40%;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .comentarios {
            text-align: left;
            margin-top: 20px;
        }
        .comentarios h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }
        .perfil_organizado {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .perfil_organizado img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 5px;
        }
        .comentario {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            overflow-wrap: break-word;
            word-wrap: break-word;
            max-width: 100%;
        }
        .comentario h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }
        .comentario p {
            margin-left: 15px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <a href="comunidade.php" class="voltar"><i class="material-symbols-outlined voltar">arrow_back_ios</i></a>
    <div class="container">
        <div class="comentarios">
            <h2>Comentários</h2>
            <?php
            // Configurações do banco de dados
            $servername = "localhost";
            $username = "root"; // Altere conforme necessário
            $password = ""; // Altere conforme necessário
            $dbname = "tdahtegia"; // Corrigido para o nome correto do banco de dados

            // Cria a conexão com o banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica a conexão
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Obtém o ID da publicação
            $publicacao_id = isset($_GET['publicacao_id']) ? intval($_GET['publicacao_id']) : 0;

            // Busca os comentários da publicação
            if ($publicacao_id > 0) {
                $sql = "SELECT c.idusuario, u.nome AS autor, u.foto AS foto_usuario, c.comentario 
                        FROM comentarios_postagem c
                        JOIN usuario u ON c.idusuario = u.idusuario
                        WHERE c.idpostagem = ?
                        ORDER BY c.data_comentario DESC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $publicacao_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Exibe os comentários
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="comentario">';
                        echo '<div class="perfil_organizado">';
                        // Caminho para a foto do usuário
                        $foto_path = '/TDAHTEGIA/public/uploads/' . htmlspecialchars($row["foto_usuario"]);
                        echo '<img src="' . $foto_path . '" alt="Foto do Usuário">';
                        echo '<h3>' . htmlspecialchars($row['autor']) . '</h3>';
                        echo '</div>';
                        echo '<p>' . htmlspecialchars($row['comentario']) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Sem comentários ainda.</p>';
                }
                $stmt->close();
            } else {
                echo '<p>ID de publicação inválido.</p>';
            }

            // Fecha a conexão
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
