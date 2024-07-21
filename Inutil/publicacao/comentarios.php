<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentários</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin-top: 10%;
        }
        .voltar {
            color: black;
            position: fixed;
            left: 10%;
            top: 5%;
            font-size: 3rem;
            font-variation-settings:
            'FILL' 0,
            'wght' 1000,
            'GRAD' 300,
            'opsz' 0
        }
        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 40%;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px; /* Espaçamento entre os containers */
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

        .perfil_organizado {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .perfil_organizado img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 5px;
        }

        .comentario {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .comentario h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .comentario p {
            margin-left: 15px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
<a href="publicacao.php"><i class="material-symbols-outlined voltar">
        arrow_back_ios
    </i></a>
    <!-- outra postagem -->
    <div class="container">
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
                <div class="perfil_organizado">
                    <img src="perfil.jpeg" alt="Foto do Usuário">
                    <h3>THWAVERTON</h3>
                </div>
                <p>Interessante! Parece um lugar legal.</p>
            </div>
            <div class="comentario">
                <div class="perfil_organizado">
                    <img src="perfil.jpeg" alt="Foto do Usuário">
                    <h3>THWAVERTON</h3>
                </div>
                <p>Obrigado por compartilhar.</p>
            </div>
            <div class="comentario">
                <div class="perfil_organizado">
                    <img src="perfil.jpeg" alt="Foto do Usuário">
                    <h3>THWAVERTON</h3>
                </div>
                <p>Interessante! Parece um lugar legal.</p>
            </div>
            <div class="comentario">
                <div class="perfil_organizado">
                    <img src="perfil.jpeg" alt="Foto do Usuário">
                    <h3>THWAVERTON</h3>
                </div>
                <p>Interessante! Parece um lugar legal.</p>
            </div>

            <!-- Adicione mais comentários conforme necessário -->
        </div>
    </div>
</body>
</html>
