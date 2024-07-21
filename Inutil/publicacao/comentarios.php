<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 500px;
            padding: 20px;
            text-align: center;
        }
        .perfil-foto{
            display: flex;
            align-items: center;
        }
        .perfil-foto img {
            width: 30px;
            height: 30px;
            border-radius: 100%;
            object-fit: cover;
        }

.perfil-nome {
    margin: 10px 0;
    font-size: 24px;
    color: #333;
}

.descricao img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    margin: 10px 0;
}

.descricao p {
    font-size: 14px;
    color: #666;
    margin: 0;
}

.comentarios {
    text-align: left;
    margin-top: 20px;
    
}

.comentarios h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 10px;
}
.perfil_organizado{

    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.comentario {
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    /* display: flex;
    align-items: center; */
}
.comentario img{
    border-radius: 100%;
    width: 30px;
    height: 30px;
    margin-right: 5px;
}

.comentario h3 {
    margin: 0;
    font-size: 16px;
    color: #333;
}

.comentario p {
    margin: 5px 0 0;
    font-size: 14px;
    color: #666;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="perfil-foto">
            <img src="perfil.jpeg" alt="Foto do Usuário">
            <h1 class="perfil-nome">THWAVERTON</h1>
        </div>
        <div class="descricao">
            <img src="perfil.jpeg" alt="Postagem">
            <p>Descrição da foto aqui. Esta é uma breve descrição sobre o que está na foto.</p>
        </div>


        <div class="comentarios">
            <h2>Comentários</h2>
            <div class="comentario">
                <div class="perfil_organizado">
                    <img src="perfil.jpeg" alt="Foto do Usuário">
                    <h3>THWAVERTON</h3>
                </div>
                <p>Ótima foto! Adorei.</p>
            </div>
            <div class="comentario">
                <h3>Usuário2</h3>
                <p>Interessante! Parece um lugar legal.</p>
            </div>
            <div class="comentario">
                <h3>Usuário3</h3>
                <p>Obrigado por compartilhar.</p>
            </div>
            <!-- Adicione mais comentários conforme necessário -->
        </div>
    </div>
</body>
</html>
