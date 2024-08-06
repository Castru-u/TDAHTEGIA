<?php
define('BASE_PATH', __DIR__ . '/../../app/pages');

// Configurações do banco de dados
$host = 'localhost'; // ou o host do seu banco de dados
$dbname = 'tdahtegia'; // substitua pelo nome do seu banco de dados
$user = 'root'; // substitua pelo seu usuário do banco de dados
$pass = ''; // substitua pela sua senha do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}

// Adicionar novo material
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arquivo = $_POST['arquivo'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_envio = $_POST['data_envio'];
    $hora_envio = $_POST['hora_envio'];
    $idusuario = $_POST['idusuario'];

    $sql = "INSERT INTO material (arquivo, titulo, descricao, data_envio, hora_envio, idusuario) 
            VALUES (:arquivo, :titulo, :descricao, :data_envio, :hora_envio, :idusuario)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':arquivo' => $arquivo,
        ':titulo' => $titulo,
        ':descricao' => $descricao,
        ':data_envio' => $data_envio,
        ':hora_envio' => $hora_envio,
        ':idusuario' => $idusuario
    ]);

    echo "<p>Material adicionado com sucesso!</p>";
}

// Buscar todos os materiais
$sql = "SELECT * FROM material";
$stmt = $pdo->query($sql);
$materiais = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Material</title>
    <link rel="stylesheet" href="../../public/css/material.css">
</head>
<body>
    <?php
    require_once(BASE_PATH . '/cabecalho.php');
    ?>

    <main>
        <div class="search-container">
            <input type="text" id="search" class="search-input" placeholder="Pesquisar...">
            <select id="category" class="category-select">
                <option value="">LISTA</option>
                <option value="matematica">Matemática</option>
                <option value="fisica">Física</option>
                <option value="quimica">Química</option>
                <option value="biologia">Biologia</option>
            </select>
            <div class="button-container">
                <a href="criar_material.php" class="btn-criar">Adicionar Material</a>
            </div>
        </div>

        <div class="container_main">
            <h1>Adicionar Novo Material</h1>
            <form method="post">
                <label for="arquivo">Arquivo:</label>
                <input type="text" id="arquivo" name="arquivo" required><br>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required><br>

                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao" required><br>

                <label for="data_envio">Data de Envio:</label>
                <input type="date" id="data_envio" name="data_envio" required><br>

                <label for="hora_envio">Hora de Envio:</label>
                <input type="time" id="hora_envio" name="hora_envio" required><br>

                <label for="idusuario">ID do Usuário:</label>
                <input type="number" id="idusuario" name="idusuario" required><br>

                <input type="submit" value="Adicionar Material">
            </form>

            <h1>Todos os Materiais</h1>
            <div class="material-list">
                <?php foreach ($materiais as $material): ?>
                <div class="material-item">
                    <div class="material-info">
                        <h2><?php echo htmlspecialchars($material['titulo']); ?></h2>
                        <p><strong>Descrição:</strong> <?php echo htmlspecialchars($material['descricao']); ?></p>
                        <p><strong>Arquivo:</strong> <?php echo htmlspecialchars($material['arquivo']); ?></p>
                        <p><strong>Data de Envio:</strong> <?php echo htmlspecialchars($material['data_envio']); ?></p>
                        <p><strong>Hora de Envio:</strong> <?php echo htmlspecialchars($material['hora_envio']); ?></p>
                        <p><strong>ID do Usuário:</strong> <?php echo htmlspecialchars($material['idusuario']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <footer>
        <p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p>
    </footer>

    <script src="../../public/js/script.js"></script>
</body>
</html>
