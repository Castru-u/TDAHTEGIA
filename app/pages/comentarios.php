<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentários</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../../public/css/comentarios.css">
</head>
<body>
    <a href="comunidade.php" class="voltar"><i class="material-symbols-outlined voltar">arrow_back_ios</i></a>
    <div class="container">
        <div class="comentarios">
            <h2>Comentários</h2>
            <?php
            require_once("../config/conecta.php"); 
            conecta(); 
            $publicacao_id = isset($_GET['publicacao_id']) ? intval($_GET['publicacao_id']) : 0;
            if ($publicacao_id > 0) {
                $sql = "SELECT c.idusuario, u.nome AS autor, u.foto AS foto_usuario, c.comentario 
                        FROM comentarios_postagem c
                        JOIN usuario u ON c.idusuario = u.idusuario
                        WHERE c.idpostagem = ?
                        ORDER BY c.data_comentario DESC";
                $stmt = $mysqli->prepare($sql); // Usa $mysqli do conecta.php
                $stmt->bind_param("i", $publicacao_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="comentario">';
                        echo '<div class="perfil_organizado">';
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
            desconecta();
            ?>
        </div>
    </div>
</body>
</html>
