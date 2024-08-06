<?php
define('BASE_PATH', __DIR__ . '/../../app/pages');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Página</title>
    <!-- <link rel="stylesheet" href="material.css"> -->
    <style>
        /* Container principal */
        .container_main {
            display: flex;
            flex-wrap: wrap;
            gap: 40px; 
            justify-content: flex-start; 
            padding: 30px; 
        }

        .minhas_comunidades, .sugestoes_de_comunidade{
            min-height: 400px;
            box-shadow: 0 0 5px black;
            border-radius: 40px;
            max-width: 100%;
            min-width: 100%;
            min-height: 500px;
            max-height: auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 10px;
            box-sizing: border-box;
        }
        .minhas_comunidades h1 , .sugestoes_de_comunidade h1{
            margin-left: 35px;
            font-family: Codec,'Arial Narrow Bold', sans-serif;
            font-size: 1.7rem;
            color: #ee6e1f;
            border-bottom: 10px solid grey;
            max-width: 93.9%;
        }
        .nome_descricao{
            display: flex;
            flex-direction: column;
            max-width: 500px;
        }
        .nome_descricao h6{
            margin-left: 10px;
            color: black;
        }
            /* Bloco de comunidade */
        .blococom {
            min-height: 100px;
            box-shadow: 0 0 5px black;
            border-radius: 8px;
            background-color: #ee6e1f;
            max-width: 95%;
            min-width: 95%;
            max-height: 100px;
            display: flex;
            align-items: center;
            margin-left: 30px;
            margin-right: 30px;
            /* padding: 10px; */
            box-sizing: border-box;
        }
        /* Container de imagem e texto */
        .comunidade {
            display: flex;
            /* align-items: center; */
            background-color: #ee6e1f;
            border-radius: 8px;
            width: 100%;
            max-height: 100px;
        }

        /* Imagem dentro do bloco */
        .comunidade img {
            max-width: 100px; 
            border-radius: 6px;
        }

        /* Título dentro do bloco */
        .comunidade h2 {
            font-family: 'Codec', 'Arial Narrow Bold', sans-serif;
            font-size: 1.7rem;
            color: white;
            text-align: left; /* Alinhe o texto à esquerda */
            margin-left: 8px; 
        }
        .botoes_crud{
            gap: 8px;
            display: flex;
            flex-direction: column;
            margin-right: 2%;
        }
        .btn_entrar_cm{
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #d45d00; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
                /* Estilo para o botão ao passar o mouse */
        .btn_entrar_cm:hover {
            background-color: white;
            color: #d45d00;
        }

        /* Container para a barra de pesquisa e o seletor de categorias */
        .search-container {
            display: flex;
            width: 100%; 
            max-width: 600px; 
            margin: 0 auto;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap; 
            gap: 10px; 
        }

        /* Estilo para a barra de pesquisa */
        .search-input {
            width: 150px; 
            padding: 8px;
            font-size: 0.875rem; 
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; 
        }

        /* Estilo para o seletor de categorias */
        .category-select {
            width: 150px; 
            padding: 8px;
            font-size: 0.875rem; 
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; 
        }

        /* Estilo para a imagem dentro do botão */
        .btn-img {
            width: 45px; 
            height: auto; 
        }

        /* Estilo para os campos de entrada e área de texto */
        input[type="text"],
        textarea {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

    </style>
</head>
<body>
    <?php
    require_once(BASE_PATH . '/cabecalho.php');
    ?>

    <main class="container_main">
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
                <a href="criar_comunidade.php" class="btn-criar"><img src="../../public/img/MAIS.svg" alt="" class="btn-img"></a>
            </div>
        </div>

        <!-- Minhas Comunidades -->
        <div class="minhas_comunidades">
            <h1>MINHAS COMUNIDADES</h1>
            <div class="blococom">
                <div class="comunidade">
                    <img src="../../public/img/menino.jpeg" alt="">
                    <div class="nome_descricao">
                        <h2>MATEMÁTICA</h2>
                        <h6>Essa é uma pequena descrição sobre uma comunidade que esta sendo testada por equipe de desenvolvimentos web e agora estao testnado o front end</h6>
                    </div>
                </div>
                <div class="botoes_crud">
                    <button class="btn_entrar_cm">Entrar</button>
                    <button class="btn_entrar_cm">Editar</button>
                </div>

            </div>

            <div class="blococom">
                <div class="comunidade">
                    <img src="../../public/img/menino.jpeg" alt="">
                    <div class="nome_descricao">
                        <h2>MATEMÁTICA</h2>
                        <h6>Essa é uma pequena descrição sobre uma comunidade que esta sendo testada por equipe de desenvolvimentos web e agora estao testnado o front end</h6>
                    </div>
                </div>
            </div>

            <div class="blococom">
                <div class="comunidade">
                    <img src="../../public/img/menino.jpeg" alt="">
                    <div class="nome_descricao">
                        <h2>MATEMÁTICA</h2>
                        <h6>Essa é uma pequena descrição sobre uma comunidade que esta sendo testada por equipe de desenvolvimentos web e agora estao testnado o front end</h6>
                    </div>
                </div>
            </div>

            <div class="blococom">
                <div class="comunidade">
                    <img src="../../public/img/menino.jpeg" alt="">
                    <div class="nome_descricao">
                        <h2>MATEMÁTICA</h2>
                        <h6>Essa é uma pequena descrição sobre uma comunidade que esta sendo testada por equipe de desenvolvimentos web e agora estao testnado o front end</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sugestões de Comunidades -->
        <div class="sugestoes_de_comunidade">
             <h1>OUTRAS COMUNIDADES</h1>
            <div class="blococom">
                <div class="comunidade">
                    <img src="../../public/img/menino.jpeg" alt="">
                    <h2>MATEMÁTICA</h2>
                </div>
            </div>
        </div>
    </main>

    <footer><p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p></footer>

    <script src="../../public/js/script.js"></script>
</body>
</html>
