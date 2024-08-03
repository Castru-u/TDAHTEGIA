<?php
define('BASE_PATH', __DIR__ . '/../../app/pages');

$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "tdahtegia";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$categorias = ["matematica", "fisica", "quimica", "biologia", "vestibular"];


$categoriaSelecionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

$sql = "SELECT idcomunidade, nome, descricao, imagem FROM comunidades WHERE 1=1";
$params = [];
$types = '';

if ($categoriaSelecionada) {
    $sql .= " AND categoria = ?";
    $params[] = $categoriaSelecionada;
    $types .= 's';
}
if ($pesquisa) {
    $sql .= " AND LOWER(nome) LIKE LOWER(?)";
    $params[] = "%$pesquisa%";
    $types .= 's';
}

$stmt = $conn->prepare($sql);

if ($types) {
    $stmt->bind_param($types, ...$params);
}


$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidades</title>
    <link rel="stylesheet" href="material.css">
</head>
<body>
    <?php require_once(BASE_PATH . '/cabecalho.php'); ?>

    <main>
        <!-- Barra de Pesquisa e Seletor de Categorias -->
        <div class="search-container">
            <input type="text" id="search" class="search-input" placeholder="Pesquisar..." value="<?php echo htmlspecialchars($pesquisa); ?>">
            <select id="category" class="category-select">
                <option value="">Todas as Categorias</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo htmlspecialchars($categoria); ?>" <?php if ($categoria == $categoriaSelecionada) echo 'selected'; ?>>
                        <?php echo ucfirst(htmlspecialchars($categoria)); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Botão Criar Comunidade -->
            <div class="button-container">
                <a href="criar_comunidade.php" class="btn-criar"><img src="../../public/img/MAIS.svg" alt="" class="btn-img"></a>
            </div>
        </div>

        <div class="container_main">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div id="minhasc" class="blococom">
                        <div class="items_imagem">
                            <?php if ($row['imagem']): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagem']); ?>" alt="">
                            <?php else: ?>
                                <img src="../../public/img/placeholder.jpg" alt=""> <!-- Imagem de placeholder -->
                            <?php endif; ?>
                        </div>
                        <div class="nome_da_comunidade">
                            <h2><?php echo htmlspecialchars($row['nome']); ?></h2>
                            <!-- <p><?php echo htmlspecialchars($row['descricao']); ?></p> -->
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhuma comunidade encontrada.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer><p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p></footer>

    <script src="../../public/js/script.js"></script>
    <script>
        function updateQueryStringParameter(uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            }
            else {
                return uri + separator + key + "=" + value;
            }
        }

        function handleInputChange(event) {
            if (event.key === 'Enter' || event.type === 'change') {
                const searchInput = document.getElementById('search').value;
                const categorySelect = document.getElementById('category').value;
                let url = window.location.pathname;

                if (searchInput) {
                    url = updateQueryStringParameter(url, 'pesquisa', searchInput);
                } else {
                    url = updateQueryStringParameter(url, 'pesquisa', '');
                }

                if (categorySelect) {
                    url = updateQueryStringParameter(url, 'categoria', categorySelect);
                } else {
                    url = updateQueryStringParameter(url, 'categoria', '');
                }

                window.location.href = url;
            }
        }

        document.getElementById('search').addEventListener('keydown', handleInputChange);
        document.getElementById('category').addEventListener('change', handleInputChange);
    </script>
</body>
</html>
