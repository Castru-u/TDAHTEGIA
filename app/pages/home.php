<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TDAHTÉGIA</title>
    <link rel="stylesheet" href="../../public/css/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi|Kanit">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../public/img/logo.png" type="image/x-icon">
    <style>
        .container p {
          text-align: left;
          top: 145px;
          left: 20px;
          width: 60%;
          margin: 0 auto;
          font-size: 50px;
          font-weight: bold;
          color: white;
        }
        
        .container-2{
            width: 100%;
            flex-direction: column;
            height: auto;
            /* margin-top: 1%; */
            align-items: center;
            background-color:wheat;
        }
        .container-2 h1{
            font-size: 40px;
            margin-top: 50px;
            /* font-family:Paytone One !important; */
            color: blue;
            letter-spacing: 2px; /* Adiciona espaçamento entre as letras */
            font-weight: bold; 
            font-family: Codec,'Arial Narrow Bold', sans-serif;
            line-height: 1.2 !important;
            text-shadow: rgba(0, 0, 0, 0.3) 0px 3px 4px;
        }
        .container-2 p{
            width: 60%;
            font-size: 18px;
            /* font-family:Paytone One !important; */
            color: white;
            margin-bottom: 5%;
            margin-top: 2%;
            letter-spacing: 2px; /* Adiciona espaçamento entre as letras */
            font-weight: bold;
            font-family: Codec,'Arial Narrow Bold', sans-serif;
            line-height: 1.2 !important;
            text-shadow: rgba(0, 0, 0, 0.3) 0px 3px 4px;
        }
        
        .seila{
            margin: 20px;
            border: 2px solid black;
            background-color: blue;
            border-radius: 5px;
        }
        .seila_td{
            margin-top: 4px;
            margin-left: 5px;
        }
        .titulo_main{
            height: 600px;
            width: 100%;
            background-image: url(../../public/img/fundo.png);
        }
        .passagem {
            width: 450px;
            height: 450px;
            background-color: grey;
            margin-top: 3%;
            margin-left: 6%;
            border-radius: 8px;
            overflow: hidden; /* Esconde as imagens que ultrapassam o container */
            position: relative;
        }
        
        .carousel {
            width: 100%;
            height: 100%;
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        
        .carousel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            flex-shrink: 0; /* Impede que as imagens diminuam de tamanho */
        }
        
        .container_depoimentos {
                    display: inline-block;
                    text-align: center;
                    margin-top: 0%;
                    /* margin-bottom: 5%; */
                    height: 400px;
                    padding: 20px;
                    background-color: antiquewhite;
                }
                .container_depoimentos h1 {
                    font-size: 40px;
                    color: #FF914d;
                    letter-spacing: 2px; /* Adiciona espaçamento entre as letras */
                    font-weight: bold; 
                    font-family: Codec, 'Arial Narrow Bold', sans-serif;
                    line-height: 1.2 !important;
                    text-shadow: rgba(0, 0, 0, 0.3) 0px 3px 4px;
                }
                .depoimento {
                    font-size: 12px;
                    color: white;
                    letter-spacing: 2px; /* Adiciona espaçamento entre as letras */
                    font-weight: bold; 
                    font-family: Codec, 'Arial Narrow Bold', sans-serif;
                    line-height: 1.2 !important;
                    text-shadow: rgba(0, 0, 0, 0.3) 0px 3px 4px;
                    gap: 4px;
                }
                .depoimentos_comentarios {
                    display: none; /* Inicialmente todos os depoimentos estão ocultos */
                    flex-direction: column;
                    background-color: #ff914d;
                    color: black;
                    width: 900px;
                    height: 40px;
                    border-radius: 8px;
                    padding: 10px;
                    margin-left: 14%;
                    margin-top: 3%;
                }
                .depoimentos_comentarios.active {
                    display: flex; /* Mostra o depoimento ativo */
                }
            
        .conatiner_sintomas{
            display: flex;
            justify-content: space-between;
            text-align: center;
            /* margin-top: 4px; */
            background-color:wheat;
            height: auto;
            padding: 10px;
            width: 100%;
        }
        .conatiner_sintomas-2{
            width: auto;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            /* background-color: gray; */
            margin-right: 5%;
        }
        .conatiner_sintomas-2 img{
            width: 80%;
        }
        .tipo_de_sitomas{
            display: flex;
            align-items: column;
            width: auto;
            border-radius: 8px;
            height: auto;
            background-color:white;
            margin-left: 1%;
            margin-right: 10px;
            margin-top: 1%;
            margin-bottom: 8%;
        }
        .coluna-1{
            display: flex;
            flex-direction: column;
            text-align: left;
            justify-content: center;
            padding: 20px;
            gap: 30px;
            height: auto;
            /* margin: 10px; */
            /* font-size: 25px; */
        }
        .coluna-1 a{
            margin-bottom: 18px;
            color: black;
            font-weight: bold;
            font-size: 16px; 
            letter-spacing: 2px; /* Adiciona espaçamento entre as letras */
            font-weight: bold; 
            font-family: Arial, sans-serif;
        }
        
        #nome_sintomas{
            text-align: center;
            justify-content: left;
            background-color:wheat;
        }
        #nome_sintomas h1{
            margin-left: 15%;
            color: white;
            font-size: 36px; /* Define um tamanho de fonte grande */
            letter-spacing: 2px;
            font-weight: bold; 
            font-family: Arial, sans-serif; 
        }
        #texto{
            line-height: 1 !important;
        }
            /* Estilo geral para o container */
            .parte_de_cima, .baixo {
              display: flex;
              justify-content: space-between;
              align-items: flex-start;
              width: 100%;
              background-color: #FF914d;
            }
        
            /* Estilo para as divisões internas */
            .parte_de_cima .texo_lado_esquerdo, .parte_de_cima .image,
            .baixo .imagem, .baixo .texo_lado_direito {
              width: 50%;
            }
        
            .image img, .imagem img {
              width: 100%; /* A imagem ocupa todo o espaço da divisão */
              height: auto; /* Mantém a proporção da imagem */
            }
        
            .texo_lado_esquerdo, .texo_lado_direito {
              padding: 10px; /* Espaçamento interno para o texto */
            }
        
            .image, .imagem {
              height: auto; 
              overflow: hidden;
            }
        
            .texo_lado_esquerdo, .texo_lado_direito {
              display: flex;
              flex-direction: column; 
              height: auto; 
              overflow: hidden; 
              margin-bottom: 10%;
            }
        
            .texo_lado_direito h1, .texo_lado_esquerdo h1 {
              font-size: 40px;
              color: white;
              font-weight: bold; 
              font-family: Codec, 'Arial Narrow Bold', sans-serif;
              text-shadow: rgba(0, 0, 0, 0.3) 0px 3px 4px;
              margin: 0; 
            }
        
            .texo_lado_direito p, .texo_lado_esquerdo p {
              font-size: 20px;
              color: whitesmoke;
              letter-spacing: 3px; /* Adiciona espaçamento entre as letras */
              font-weight: bold; 
              font-family: Codec, 'Arial Narrow Bold', sans-serif;
              text-shadow: rgba(0, 0, 0, 0.3) 0px 3px 4px;
              margin-top: 10px;
            }
        .sobre_tdah{
                font-size: 30px;
              color: #FF914d;
              font-weight: bold; 
              font-family: Codec, 'Arial Narrow Bold', sans-serif;
              text-shadow: rgba(0, 0, 0, 0.3) 0px 3px 4px;
              margin-bottom: 20px;
              background-image: url(../../public/img/fundo.png);
              text-align: center;
              justify-content: center;
        }
        </style>
</head>
<body>
    <header>
        <div id="logo">
            <?xml version="1.0" standalone="no"?>
            <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
            "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
            width="500.000000pt" height="363.pt" viewBox="0 0 500.000000 363.000000"
            preserveAspectRatio="xMidYMid meet">

            <g transform="translate(0.000000,363.000000) scale(0.100000,-0.100000)"
            fill="#FFF" stroke="none">
            <path d="M1251 3110 c-678 -280 -1235 -511 -1237 -513 -2 -2 209 -91 469 -198
            l472 -194 0 -965 1 -964 94 -29 c373 -112 813 -198 1168 -228 175 -14 558 -6
            721 15 334 45 683 123 994 222 l107 35 0 957 0 957 147 60 c81 33 150 62 155
            63 4 2 8 -140 8 -317 l0 -320 -53 -53 c-38 -38 -57 -66 -65 -98 -10 -39 -82
            -671 -77 -678 1 -1 134 -1 296 0 l295 3 -33 315 c-18 173 -38 335 -45 360 -9
            33 -26 59 -65 97 l-53 52 2 363 3 363 218 89 c130 54 212 93 205 97 -32 18
            -2471 1019 -2482 1018 -6 0 -566 -229 -1245 -509z m2233 -103 c538 -221 977
            -407 976 -412 -2 -6 -443 -191 -981 -413 l-979 -403 -979 403 c-538 222 -980
            407 -982 412 -3 8 1928 813 1957 815 6 1 451 -180 988 -402z m-1622 -1176
            l638 -263 667 275 668 275 6 -326 c3 -180 7 -447 8 -594 l1 -267 -82 -25
            c-237 -72 -644 -156 -898 -186 -441 -50 -964 1 -1550 153 l-165 42 0 133 c0
            72 1 344 3 602 l2 470 33 -13 c17 -8 319 -132 669 -276z m2606 -330 c9 -6 20
            -65 32 -182 11 -96 22 -195 25 -221 l6 -48 -81 0 -81 0 6 48 c3 26 14 125 25
            221 17 161 25 191 50 191 3 0 11 -4 18 -9z m-618 -925 l0 -143 -107 -32 c-270
            -78 -602 -146 -853 -175 -378 -44 -737 -25 -1200 65 -146 29 -436 97 -507 120
            l-33 11 0 144 c0 79 4 144 8 144 5 0 69 -16 143 -35 703 -180 1262 -213 1867
            -109 158 27 442 91 567 128 126 37 115 48 115 -118z"/>
            </g>
            </svg>
            <p>TDAHTÉGIA</p>
        </div>

        <div class="botoes">
            <a id="botao1" class="botao" style="grid-area: b1;" href="login.php">Entre</a>
            <a id="botao3" class="botao" style="grid-area: b3;" href="cadastro.php">Cadastre-se</a>
            <a id="botao2" class="botao" style="grid-area: b2;" href="saibamais.html">Saiba mais</a>
        </div>
    </header>

    <div class="titulo_main">
        <p id="texto">Uma estratégia<br> para o Estudo</p>
        <div class="passagem">
            <div class="carousel" id="carousel">
                <img src="../../public/img/seila2.png" alt="Imagem 1">
                <img src="../../public/img/testets.jpeg" alt="Imagem 2">
                <img src="../../public/img/saibamais.png" alt="Imagem 3">
            </div>
        </div>
    </div>

    <div class="sobre_tdah">
        <h1>SOBRE O TDAH</h1>
    </div>

    <div class="parte_de_cima">
        <div class="texo_lado_esquerdo">
            <h1>SINTOMAS DO TDAH EM ADOLESCENTES</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci excepturi expedita neque hic eos tempore aspernatur facere quod at nulla nemo dolor saepe, cum quos deleniti soluta minus eius dignissimos!</p>
        </div>
        <div class="image">
            <img src="../../public/img/tdah_menino.jpeg" alt="">
        </div>
    </div>

    <div class="baixo">
        <div class="imagem">
            <img src="../../public/img/tdah_menino.jpeg" alt="">
        </div>
        <div class="texo_lado_direito">
            <h1>DEPRESSÃO E TDAH</h1>
            <p>O que é o TDAH? Antes de olharmos o relacionamento entre o TDAH e a Depressão, é muito importante compreender o que está envolvido individualmente em cada um destes distúrbios. O Transtorno do Déficit de Atenção com...</p>
        </div>
    </div>

    <div class="container-2">
        <h1>O QUE É TDAH ?<br></h1>
        <p>O Transtorno de Déficit de Atenção e Hiperatividade (TDAH) é um transtorno neurobiológico que se manifesta na infância e frequentemente persiste na vida adulta. É caracterizado por sintomas de desatenção, hiperatividade e impulsividade. Pessoas com TDAH podem ter dificuldade em manter o foco, controlar impulsos e organizar tarefas.</p>
    </div>

    <div id="nome_sintomas">
        <h1>SINTOMAS</h1>
    </div>

    <div class="conatiner_sintomas">
        <div class="tipo_de_sitomas">
            <div class="coluna-1">
                <a href="#">Hiperatividade</a>
                <a href="#">Impulsividade</a>
                <a href="#">Desorganização</a>
            </div>
            <div class="coluna-1">
                <a href="#">Desatenção</a>
                <a href="#">Procrastinação</a>
                <a href="#">Inquietação</a>
            </div>
            <div class="coluna-1">
                <a href="#">Esquecimento</a>
                <a href="#">Mudanças de humor</a>
                <a href="#">Problemas de...</a>
            </div>
        </div>
        <div class="conatiner_sintomas-2">
            <img src="../../public/img/seila.png" alt="">
        </div>
    </div>
    <div class="container_depoimentos">
        <h1>DEPOIMENTOS</h1>
        <div class="depoimentos_comentarios active">
            <p class="depoimento">Como pai de uma criança com TDAH, o suporte que encontramos aqui foi essencial para nos ajudar a entender e apoiar nosso filho.” – João Pedro
                <br>Leia Mais Depoimentos</p>
        </div>
        <div class="depoimentos_comentarios">
            <p class="depoimento">A orientação e o apoio da equipe foram fundamentais para o desenvolvimento do meu filho.” – Maria Silva
                <br> <a href="#">Leia Mais Depoimentos</a></p>
        </div>
        <div class="depoimentos_comentarios">
            <p class="depoimento">Os recursos oferecidos são incríveis e têm ajudado muito na nossa jornada.” – Carlos Souza
                <br><a href="#">Leia Mais Depoimentos</a></p>
        </div>
        <div class="depoimentos_comentarios">
            <p class="depoimento">Os recursos oferecidos são incríveis e têm ajudado muito na nossa jornada.” – Carlos Souza
               <br> <a href="#">Leia Mais Depoimentos</a> </p>
        </div>
    </div>
    
    <nav>
        <p id="textobaixo">TDAHTÉGIA	&#169;<br>77 98251760</p>
    </nav>
    <script src="../../public/js/home.js"></script>
</body>
</html>
