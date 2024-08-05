<?php
define('BASE_PATH', __DIR__ . '/../../app/pages');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Página</title>
    <link rel="stylesheet" href="material.css">
</head>
<body>
    <?php
    require_once(BASE_PATH . '/cabecalho.php');
    ?>

    <main>
        <!-- Barra de Pesquisa e Seletor de Categorias -->
        <div class="search-container">

            <input type="text" id="search" class="search-input" placeholder="Pesquisar...">
            <select id="category" class="category-select">
                <option value="">LISTA</option>
                <option value="matematica">Matemática</option>
                <option value="fisica">Física</option>
                <option value="quimica">Química</option>
                <option value="biologia">Biologia</option>
                
            </select>

                <!-- Botão Criar Comunidade -->
            <div class="button-container">
                <a href="postagem.php" class="btn-criar"><img src="../../public/img/MAIS.svg" alt="" class="btn-img"></a>
                
            </div>

        </div>

        <div class="container_main">

            <div id="postagem" class="blococom">
                <!-- <h2>FISICA</h2> -->
                <div class="items_postagem">
                    <img src="../../public/img/menino.jpeg" alt="">
                </div>
                <div class="nome_da_comunidade">
                    <h2>MATEMÁTICA</h2>
                </div>
            </div>

        </div>
    </main>

    <footer><p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p></footer>

    <script src="../../public/js/script.js"></script>
</body>
</html>
