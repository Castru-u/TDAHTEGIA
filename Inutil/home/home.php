<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TDAHTÉGIA</title>
    <style>
* {
    padding: 0; 
    margin: 0;
}

@font-face {
    font-family: 'Codec';
    src: local('codec pro bold'), local('codec-pro-bold'),
    url(/fonts/codec-pro-bold.ttf) format('truetype');
    font-weight: 700;
    font-style: normal;
}

html, body {
    overflow-x: hidden;
    /* Impede o scroll horizontal */
}

body {
    background-size: cover;
    min-height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
}

header {
    background: #FF7621;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-areas: "logo botoes botoes";
    font-weight: 800;
    width: 100%;
    border-bottom: solid 15px #FF914D;
    padding: 12px;
    box-sizing: border-box;
}

svg {
    width: 90px;
    cursor: pointer;
}

#logo {
    align-items: center;
    font-family: system-ui, Alatsi, 'Arial Narrow Bold', sans-serif;
    font-weight: 700;
    font-size: 33px;
    color: #FFF; 
    margin-left: 30px;
    grid-area: logo;
    display: flex;
    align-items: center;
}

div {
    display: flex;
}

#texto {
    color: #FFF;
    font-weight: bold;
    font-family: Codec, 'Arial Narrow Bold', sans-serif;
    font-size: 70px;
    text-shadow: rgba(0, 0, 0, 0.3) 0px 3px 4px;
    line-height: 5rem;
    color: #ee6e1f;
    margin: 100px 0 100px 30px;
}

.botao {
    border: 2px solid #fff;
    border-radius: 100px;
    min-width: 150px;
    padding: 8px;
    text-align: center;
    margin: auto;
    font-family: Kaniti, 'Arial Narrow Bold', sans-serif;
    font-weight: 600;
    font-size: 20px;
    color: #FFF;
    box-shadow: rgba(0, 0, 0, 0.4) 1px 1px 4px;
}

.botao:hover {
    background-color: #ee6e1f;
}

a {
    text-decoration: none;
}

.botoes {
    display: flex;
    gap: 20px;
    align-items: center;
    justify-content: center;
    grid-area: botoes;
}

.row {
    justify-content: space-between;
}

nav {
    background-image: linear-gradient(#FF914D, #FF7621);
    height: 80px;
    display: flex;
    width: 100%;
    align-items: center;
    position: relative;
    bottom: 0px;
}

.botoes {
    gap: 20px;
    margin-right: 30px;
}

#textobaixo {
    font-family: Kaniti, 'Arial Narrow Bold', sans-serif;
    font-weight: 600;
    font-size: 20px;
    color: #FFF; 
    margin-left: 30px;
    text-shadow: rgba(0, 0, 0, 0.4) 1px 1px 4px;
}

main {
    padding: 20px;
    background-color: #f5f5f5;
    flex: 1; /* Garante que o main ocupe o espaço restante */
    background: url('../../public/img/fundo.png') no-repeat center center fixed;
}

.content-1 {
    max-width: 1200px;
    margin: 0 auto;
}

.content-2 {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    gap: 20px;
}

.info-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.info-section img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 6px;
}

.info-text {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

p {
    font-family: 'Roboto Slab', serif;
    font-size: 1.2rem;
    color: #333;
    line-height: 1.6;
    margin-bottom: 20px;
}

.images {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.images img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 6px;
}

@media only screen and (max-width: 768px) {
    .botao {
        border: none;
        min-width: auto;
        margin: auto 0;
        font-size: 17px; 
        box-shadow: none;
    }

    .botoes {
        gap: none;
        margin-right: none;
        justify-content: space-between;
        width: 100%;
    }

    #logo {
        margin-bottom: 7px;
    }

    svg {
        width: 70px;
        cursor: pointer;
    }

    #texto {
        font-size: 60px;
        line-height: 4rem;
    }

    header {
        background-image: linear-gradient(#FF914D, #FF7621);
    }

    .content-2 {
        flex-direction: column;
    }
}

    </style>
</head>
<body>

    <header>
    <div id="logo">
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
            TDAHTÉGIA
        </div>

        <div class="botoes">
            <a id="botao1" class="botao" href="login.html">Entre</a>
            <a id="botao2" class="botao" href="saibamais.html">Saiba mais</a>
            <a id="botao3" class="botao" href="cadastro.php">Cadastre-se</a>
        </div>
    </header>

    <main>
        <div class="content-1">
            <h1 id="texto">Uma estratégia  <br>PARA O ESTUDO</h1>
            <!-- <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum. Nulla facilisi. Phasellus venenatis, erat in cursus feugiat, risus ex bibendum tortor, id convallis risus ex non orci.
            </p>
            <p>
                Fusce vitae ligula neque. Nam sagittis, nisl at ultrices tempor, elit quam consectetur eros, at scelerisque lectus dolor sit amet eros. Aenean sollicitudin est nec nulla scelerisque, eu consectetur lorem vestibulum.
            </p>
            <div class="images">
                <img src="https://via.placeholder.com/300" alt="Imagem 1">
                <img src="https://via.placeholder.com/300" alt="Imagem 2">
                <img src="https://via.placeholder.com/300" alt="Imagem 3">
            </div> -->
        </div>
    </main>
    <div class="content-2">
        
    <div class="info-section">
        <div class="image-text-container">
            <img src="../../public/img/Thw.jpeg" alt="Imagem sobre TDAH" class="image-left">
            <div class="text-right">
                <p>O Transtorno do Déficit de Atenção e Hiperatividade (TDAH) é um transtorno neuropsiquiátrico
                que afeta a capacidade de uma pessoa de manter a atenção e controlar impulsos. Os sintomas incluem
                dificuldade de concentração, hiperatividade e impulsividade, que podem impactar significativamente
                a vida pessoal e profissional. O TDAH é diagnosticado com base na presença de sintomas persistentes
                e pode ser tratado com uma combinação de terapia, medicação e estratégias comportamentais.</p>
            </div>
        </div>
        <div class="image-text-container">
            <div class="text-left">
            <p>O Transtorno do Déficit de Atenção e Hiperatividade (TDAH) é um transtorno neuropsiquiátrico
                que afeta a capacidade de uma pessoa de manter a atenção e controlar impulsos. Os sintomas incluem
                dificuldade de concentração, hiperatividade e impulsividade, que podem impactar significativamente
                a vida pessoal e profissional. O TDAH é diagnosticado com base na presença de sintomas persistentes
                e pode ser tratado com uma combinação de terapia, medicação e estratégias comportamentais.</p>
            </div>
            <img src="../../public/img/Thw.jpeg" alt="Outra Imagem" class="image-right">
        </div>
    </div>
</div>
    <div class="content-2">
        
    </div>

    <nav>
        <div id="textobaixo">Texto no rodapé</div>
    </nav>

</body>
</html>
