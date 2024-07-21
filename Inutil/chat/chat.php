<?php
// Conexão com o banco de dados (utilize PDO para segurança)
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'chat';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $mensagem = $_POST['mensagem'];

    // Insere a mensagem no banco de dados
    $stmt = $pdo->prepare("INSERT INTO minichat (username, mensagem) VALUES (?, ?)");
    $stmt->execute([$username, $mensagem]);
}

// Exibe as últimas 10 mensagens
$stmt = $pdo->query("SELECT * FROM minichat ORDER BY ID DESC LIMIT 10");
$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Formulário -->
<form method="post">
    <input type="text" name="username" placeholder="Seu apelido">
    <input type="text" name="mensagem" placeholder="Sua mensagem">
    <button type="submit">Enviar</button>
</form>

<!-- Exibição das mensagens -->
<ul>
    <?php foreach ($mensagens as $msg): ?>
        <li><?= $msg['username'] ?>: <?= $msg['mensagem'] ?></li>
    <?php endforeach; ?>
</ul>
