<?php
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
$stmt = $pdo->query("SELECT * FROM material");
$materiais = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiais</title>
    <link rel="stylesheet" href="material.css">
</head>
<body>
    <?php require_once(BASE_PATH . '/cabecalho.php'); ?>

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
                <a href="postar_material.php" class="btn-criar"><img src="../../public/img/MAIS.svg" alt="" class="btn-img"></a>
            </div>
        </div>

        <div class="container_main">
            <?php foreach ($materiais as $material): ?>
                <div class="blococom">
                    <div class="items_imagem">
                        <img src="../../public/uploads/<?= htmlspecialchars($material['arquivo']) ?>" alt="<?= htmlspecialchars($material['titulo']) ?>">
                    </div>
                    <div class="nome_do_material">
                        <h2><?= htmlspecialchars($material['titulo']) ?></h2>
                        <p><?= htmlspecialchars($material['descricao']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p>
    </footer>
</body>
</html>
