<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
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
    width: 300px;
    padding: 20px;
    text-align: center;
}
.perfil-foto{
    display: flex;
    align-items: center;
}

.perfil-nome{
    font-size: 18px;
    color: #333;
    margin-left: 10px;
}

.perfil-foto img {
    width: 30px;
    height: 30px;
    border-radius: 100%;
    margin-left: 5px;
}

.descricao p {
    font-size: 14px;
    color: #666;
    margin: 10px 0;
}

.comentarios a {
    text-decoration: none;
    color: #007bff;
    font-size: 14px;
}

.comentarios a:hover {
    text-decoration: underline;
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
            <img src="perfil.jpeg" alt="postagem">
            <p>Descrição da foto aqui. Esta é uma breve descrição sobre o que está na foto.</p>
        </div>
        <div class="comentarios">
            <a href="comentarios.html">Ver Comentários</a>
        </div>
    </div>
</body>
</html>
