<?php
require_once '../../config/conecta.php'; 
conecta(); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idusuario = isset($_POST['idusuario']) ? intval($_POST['idusuario']) : 0;
    $idpostagem = isset($_POST['publicacao_id']) ? intval($_POST['publicacao_id']) : 0;
    $comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';
    if ($idusuario > 0 && $idpostagem > 0 && !empty($comentario)) {
        $sql = "INSERT INTO comentarios_postagem (idusuario, idpostagem, idcomunidade, comentario) 
                VALUES (?, ?, (SELECT idcomunidade FROM postagem WHERE idpostagem = ?), ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("iiis", $idusuario, $idpostagem, $idpostagem, $comentario);
            if ($stmt->execute()) {
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit();
            } else {
                echo "Erro ao adicionar comentário: " . $mysqli->error;
            }
            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $mysqli->error;
        }
    } else {
        echo "Dados inválidos ou incompletos!";
    }
}
desconecta();
?>
