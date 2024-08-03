<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'tdahtegia';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Recebe e-mail do formulário
$email = $_POST['email'];

// Verifica se o e-mail existe
$sql = "SELECT id FROM usuarios WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    $token = bin2hex(random_bytes(16)); // Gera um token de recuperação

    // Armazena o token no banco de dados (você precisa de uma tabela para isso)
    $sql = "INSERT INTO recuperacao_senha (email, token) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $token]);

    // Envia o e-mail com o link de recuperação
    $to = $email;
    $subject = "Recuperação de Senha";
    $message = "Clique no link a seguir para redefinir sua senha: http://seusite.com/redefinir_senha.php?token=$token";
    $headers = "From: no-reply@seusite.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "Instruções de recuperação de senha enviadas para o seu e-mail.";
    } else {
        echo "Erro ao enviar o e-mail.";
    }
} else {
    echo "E-mail não encontrado.";
}
?>
