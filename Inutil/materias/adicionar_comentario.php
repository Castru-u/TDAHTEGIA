<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'tdahtegia';
$user = 'root';
$pass = '';

// Conectar ao banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter dados do formulário
    $idusuario = isset($_POST['idusuario']) ? intval($_POST['idusuario']) : 0;
    $idpostagem = isset($_POST['publicacao_id']) ? intval($_POST['publicacao_id']) : 0;
    $comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';

    // Validar dados
    if ($idusuario > 0 && $idpostagem > 0 && !empty($comentario)) {
        try {
            // Preparar e executar a consulta de inserção
            $sql = "INSERT INTO comentarios_postagem (idusuario, idpostagem, idcomunidade, comentario) 
                    VALUES (:idusuario, :idpostagem, (SELECT idcomunidade FROM postagem WHERE idpostagem = :idpostagem), :comentario)";
            $stmt = $pdo->prepare($sql);

            // Vincular os parâmetros
            $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
            $stmt->bindParam(':idpostagem', $idpostagem, PDO::PARAM_INT);
            $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);

            // Executar a consulta
            $stmt->execute();

            // Redirecionar após o envio
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        } catch (PDOException $e) {
            echo "Erro ao adicionar comentário: " . $e->getMessage();
        }
    } else {
        echo "Dados inválidos ou incompletos!";
    }
}
?>
