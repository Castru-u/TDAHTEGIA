<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicações</title>
    <link rel="stylesheet" href="../../public/css/comunidade.css">
    <script src="../../public/js/publicacoes.js" defer></script>
</head>
<body>
    <?php 
    require_once('cabecalho.php'); 
    require_once('../config/validacoes.php');
    
    session_start();

    if (!isset($_SESSION['id_usuario'])) {
        header("Location: login.php");
        exit();
    }

    $idusuario = $_SESSION['id_usuario'];

    // Captura o idcomunidade da URL
    $idcomunidade = isset($_GET['idcomunidade']) ? intval($_GET['idcomunidade']) : 0;

    // Verifica se o idcomunidade é válido (exemplo de validação, ajuste conforme necessário)
    if ($idcomunidade <= 0) {
        echo "<p>ID da comunidade inválido.</p>";
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tdahtegia";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    echo "<div class='container1'>";
    // Inclua o idcomunidade na URL
    echo "<a href='../actions/comunidade/adicionar_postagem.php?idcomunidade=" . $idcomunidade . "' class='btn-criar'>";
    echo "<img src='../../public/img/MAIS.svg' alt='Adicionar Postagem' class='btn-img'>";
    echo "</a>";
    // Ajuste a consulta para filtrar por idcomunidade
    $sql = "SELECT p.idpostagem, p.titulo, p.conteudo, p.data_envio, p.hora_envio, p.arquivo, u.idusuario, u.nome AS nome_usuario, u.email, u.foto
            FROM postagem p
            JOIN usuario u ON p.idusuario = u.idusuario
            WHERE p.idcomunidade = ?
            ORDER BY p.data_envio DESC, p.hora_envio DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idcomunidade);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='container'>";
            echo "<div class='perfil-foto'>";
            $foto_path = '/TDAHTEGIA/public/uploads/' . htmlspecialchars($row["foto"]);
            echo "<img src='" . $foto_path . "' alt='Foto do Usuário'>";
            echo "<h1 class='perfil-nome'>" . htmlspecialchars($row["nome_usuario"]) . "</h1>";
            echo "</div>";

            echo "<div class='descricao'>";
            echo "<h2 class='postagem-titulo'>" . htmlspecialchars($row["titulo"]) . "</h2>";

            $arquivo = $row["arquivo"];
            $arquivoPath = '/TDAHTEGIA/public/uploads/' . htmlspecialchars($arquivo);

            if ($arquivo) {
                $extensao = strtolower(pathinfo($arquivoPath, PATHINFO_EXTENSION));
                if (in_array($extensao, ['jpg', 'jpeg', 'png', 'gif'])) {
                    echo "<img src='" . $arquivoPath . "' alt='Postagem' style='max-width: 100%; height: auto;'>";
                } elseif ($extensao === 'pdf') {
                    echo "<div class='arquivo-container'>";
                    echo "<img src='../../public/img/pdf-icon.png' alt='PDF' style='max-width: 100px; height: auto;'>";
                    echo "<div class='arquivo-info'>";
                    echo "<p>" . htmlspecialchars($arquivo) . "</p>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<div class='arquivo-container'>";
                    echo "<img src='../../public/img/default-file-icon.png' alt='Arquivo' style='max-width: 100px; height: auto;'>";
                    echo "<div class='arquivo-info'>";
                    echo "<p>" . htmlspecialchars($arquivo) . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            }

            echo "<p>" . nl2br(htmlspecialchars($row["conteudo"])) . "</p>";

            if ($arquivo) {
                if (in_array($extensao, ['jpg', 'jpeg', 'png', 'gif'])) {
                    echo "<a href='" . $arquivoPath . "' class='btn-download' download>Baixar Imagem</a>";
                } elseif ($extensao === 'pdf') {
                    echo "<a href='" . $arquivoPath . "' class='btn-download' target='_blank'>Visualizar PDF</a>";
                } else {
                    echo "<a href='" . $arquivoPath . "' class='btn-download' download>Baixar</a>";
                }
            }

            if ($row['idusuario'] == $idusuario || $_SESSION['role'] == 'admin') {
                echo "<a href='../actions/comunidade/deletar_postagem.php?idpostagem=" . $row["idpostagem"] . "' class='btn-deletar' onclick=\"return confirm('Você tem certeza que deseja deletar esta postagem?');\">Deletar Postagem</a>";
            }
                
            echo "</div>";

            $comentarios_sql = "SELECT c.idusuario, u.nome AS autor, u.foto AS foto_usuario, c.comentario 
                                FROM comentarios_postagem c
                                JOIN usuario u ON c.idusuario = u.idusuario
                                WHERE c.idpostagem = ?
                                ORDER BY c.data_comentario DESC
                                LIMIT 3";
            $stmt = $conn->prepare($comentarios_sql);
            $stmt->bind_param("i", $row["idpostagem"]);
            $stmt->execute();
            $comentarios_result = $stmt->get_result();

            echo "<div class='comentarios'>";
            if ($comentarios_result->num_rows > 0) {
                echo "<h2>Comentários</h2>";
                while ($comentario = $comentarios_result->fetch_assoc()) {
                    echo "<div class='comentario'>";
                    echo "<div class='perfil_organizado'>";
                    $comentario_foto_path = '/TDAHTEGIA/public/uploads/' . htmlspecialchars($comentario["foto_usuario"]);
                    echo "<img src='" . $comentario_foto_path . "' alt='Foto do Usuário'>";
                    echo "<h3>" . htmlspecialchars($comentario["autor"]) . "</h3>";
                    echo "</div>";
                    echo "<p>" . nl2br(htmlspecialchars($comentario["comentario"])) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>Seja o primeiro a comentar!</p>";
            }
            echo "<a href='comentarios.php?publicacao_id=" . $row["idpostagem"] . "&idcomunidade=" . $idcomunidade . "'>Ver + Comentários</a>";
            echo "</div>";

            echo "<div class='form-comentario'>";
            echo "<h2>Adicionar Comentário</h2>";
            echo "<form action='../actions/comunidade/adicionar_comentario.php' method='post'>";
            echo "<input type='hidden' name='idusuario' value='" . $idusuario . "'>";
            echo "<input type='hidden' name='publicacao_id' value='" . $row["idpostagem"] . "'>";
            echo "<input type='hidden' name='idcomunidade' value='" . $idcomunidade . "'>";
            echo "<textarea name='comentario' placeholder='Escreva seu comentário aqui...' required></textarea>";
            echo "<button type='submit' class='btn-enviar'>Enviar</button>";
            echo "</form>";
            echo "</div>";

            echo "</div>";
        }
    } else {
        echo "<div class='container1'>Nenhuma publicação encontrada.</div>";
    }
    echo "</div>";
    $conn->close();
    ?>
        <footer><p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p></footer>
</body>
</html>
