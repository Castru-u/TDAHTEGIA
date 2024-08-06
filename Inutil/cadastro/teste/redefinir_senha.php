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

// Recebe o token da URL
$token = $_GET['token'];

// Verifica se o token é válido
$sql = "SELECT email FROM recuperacao_senha WHERE token = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$token]);

if ($stmt->rowCount() > 0) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nova_senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        // Atualiza a senha no banco de dados
        $email = $stmt->fetchColumn();
        $sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nova_senha, $email]);

        // Remove o token após usar
        $sql = "DELETE FROM recuperacao_senha WHERE token = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$token]);

        echo "Senha redefinida com sucesso!";
    } else {
        echo '
            <form method="post">
                <label for="senha">Nova Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <br>
                <button type="submit">Redefinir Senha</button>
            </form>
        ';
    }
} else {
    echo "Token inválido ou expirado.";
}
?>
