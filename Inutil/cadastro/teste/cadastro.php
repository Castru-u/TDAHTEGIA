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

// Recebe dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

// Insere usuário no banco de dados
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$nome, $email, $senha]);
    echo "Cadastro realizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
}
?>
