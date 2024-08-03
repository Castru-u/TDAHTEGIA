<!DOCTYPE html>
<html>
<head>
  <style>
    /* Estilo geral para o container */
    .parte_de_cima, .baixo {
      display: flex;
      justify-content: space-between;
      align-items: center;
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

    /* Adicionando alguma altura para visualização */
    .image, .imagem {
      height: 100%; /* Altura exemplo, pode ser ajustada conforme necessário */
      overflow: hidden; /* Esconde parte da imagem se necessário */
    }

    .texo_lado_esquerdo, .texo_lado_direito {
      height: auto; /* Altura exemplo, pode ser ajustada conforme necessário */
      overflow: hidden; /* Esconde texto excedente */
      margin-bottom: 10%;
    }
    .texo_lado_direito h1, .texo_lado_esquerdo h1{
            font-size: 40px;
            color: white;
            font-weight: bold; /* Deixa o título em negrito */
            font-family: Codec, 'Arial Narrow Bold', sans-serif;
            /* line-height: 1.2 !important; */
            text-shadow: rgba(0, 0, 0, 0.3) 0px 3px 4px;
    }
    .texo_lado_direito p, .texo_lado_esquerdo p{
            font-size: 20px;
            color: whitesmoke;
            letter-spacing: 3px; /* Adiciona espaçamento entre as letras */
            font-weight: bold; /* Deixa o título em negrito */
            font-family: Codec, 'Arial Narrow Bold', sans-serif;
            text-shadow: rgba(0, 0, 0, 0.3) 0px 3px 4px;
    }
  </style>
</head>
<body>
  <div class="parte_de_cima">
    <div class="texo_lado_esquerdo">
      <h1>
        SINTOMAS DO TDAH EM ADOLESCENTES
      </h1>
<p>    Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci excepturi expedita neque hic eos tempore aspernatur facere quod at nulla nemo dolor saepe, cum quos deleniti soluta minus eius dignissimos!</p>
    </div>
    <div class="image">
      <img src="../../public/img/tdah_menino.jpeg" alt="">
    </div>
  </div>

  <div class="baixo">
    <div class="imagem">
      <img src="../../public/img/menino.jpeg" alt="">
    </div>
    <div class="texo_lado_direito">
    <h1>
          DEPRESSÃO E TDAH
      </h1>
      <p>
      O que é o TDAH? Antes de olharmos o relacionamento entre o TDAH e a Depressão, é muito importante compreender o que está envolvido individualmente em cada um destes distúrbios. O Transtorno do Déficit de Atenção com...      </p>
</div>
  </div>
</body>
</html>
