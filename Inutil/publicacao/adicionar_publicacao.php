<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Publicação</title>
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
            width: 90%;
            max-width: 600px;
            padding: 20px;
        }
        .form-publicacao h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .form-publicacao input[type="text"],
        .form-publicacao textarea {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .form-publicacao input[type="file"] {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .form-publicacao input[type="submit"] {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .form-publicacao input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-publicacao">
            <h2>Adicionar Publicação</h2>
            <form action="processar_publicacao.php" method="post" enctype="multipart/form-data">
                <input type="text" name="titulo" placeholder="Título da Publicação" required>
                <textarea name="conteudo" placeholder="Conteúdo da Publicação" required></textarea>
                <input type="file" name="imagem" accept="image/*">
                <input type="submit" value="Adicionar Publicação">
            </form>
        </div>
    </div>
</body>
</html>
