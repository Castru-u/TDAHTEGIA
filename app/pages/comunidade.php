<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicações</title>
    <link rel="stylesheet" href="../../public/css/comunidade.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Seleciona o formulário e o textarea
            const form = document.querySelector('.form-comentario form');
            const textarea = document.querySelector('.form-comentario form textarea');

            // Adiciona um evento keydown ao textarea
            textarea.addEventListener('keydown', function(event) {
                // Verifica se a tecla pressionada é Enter e a tecla Shift não está pressionada
                if (event.key === 'Enter' && !event.shiftKey) {
                    event.preventDefault(); // Impede o comportamento padrão (nova linha)
                    // Envia o formulário
                    form.submit();
                }
            });

            // Adiciona um evento click ao botão de envio
            document.querySelector('.form-comentario .btn-enviar').addEventListener('click', function() {
                form.submit();
            });
        });
    </script>
</head>
<body>
    <?php include('cabecalho.php'); ?>

    <div class="container_pri">
        <!-- Botão Criar Postagem -->
        <div class="button-container">
            <a href="../actions/comunidade/adicionar_postagem.php" class="btn-criar">
                <img src="../../public/img/MAIS.svg" alt="Adicionar Postagem" class="btn-img">
            </a>
        </div>
    </div>

    <?php
    session_start();
    require_once("../config/validacoes.php");
    // Verificar se o usuário está logado
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: login.php");
        exit();
    }

    $idusuario = $_SESSION['id_usuario'];

    // Configurações do banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tdahtegia";

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consulta para obter todas as publicações, ordenadas por data e hora (mais recente primeiro)
    $sql = "SELECT p.idpostagem, p.titulo, p.conteudo, p.data_envio, p.hora_envio, p.arquivo, u.idusuario, u.nome AS nome_usuario, u.email, u.foto
            FROM postagem p
            JOIN usuario u ON p.idusuario = u.idusuario
            ORDER BY p.data_envio DESC, p.hora_envio DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibe as publicações
        while ($row = $result->fetch_assoc()) {
            echo "<div class='container1'>";
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
                    // Se for uma imagem
                    echo "<img src='" . $arquivoPath . "' alt='Postagem' style='max-width: 100%; height: auto;'>";
                } elseif ($extensao === 'pdf') {
                    // Se for um PDF
                    echo "<div class='arquivo-container'>";
                    echo "<img src='../../public/img/pdf-icon.png' alt='PDF' style='max-width: 100px; height: auto;'>";
                    echo "<div class='arquivo-info'>";
                    echo "<p>" . htmlspecialchars($arquivo) . "</p>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    // Para outros tipos de arquivos
                    echo "<div class='arquivo-container'>";
                    echo "<img src='../../public/img/default-file-icon.png' alt='Arquivo' style='max-width: 100px; height: auto;'>";
                    echo "<div class='arquivo-info'>";
                    echo "<p>" . htmlspecialchars($arquivo) . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            }

            echo "<p>" . nl2br(htmlspecialchars($row["conteudo"])) . "</p>";

            // Botões abaixo do conteúdo
            if ($arquivo) {
                if (in_array($extensao, ['jpg', 'jpeg', 'png', 'gif'])) {
                    echo "<a href='" . $arquivoPath . "' class='btn-download' download>Baixar Imagem</a>";
                } elseif ($extensao === 'pdf') {
                    echo "<a href='" . $arquivoPath . "' class='btn-download' target='_blank'>Visualizar PDF</a>";
                } else {
                    echo "<a href='" . $arquivoPath . "' class='btn-download' download>Baixar</a>";
                }
            }

            echo "</div>"; // Fecha .descricao

            // Consulta para obter os 3 comentários mais recentes
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
                // Exibe os comentários
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
            echo "<a href='comentarios.php?publicacao_id=" . $row["idpostagem"] . "'>Ver + Comentários</a>";
            echo "</div>"; // Fecha .comentarios
            // Adiciona o formulário de comentário
            echo "<div class='form-comentario'>";
            echo "<h2>Adicionar Comentário</h2>";
            echo "<form action='../actions/comunidade/adicionar_comentario.php' method='post'>";
            echo "<input type='hidden' name='idusuario' value='" . $idusuario . "'>";
            echo "<input type='hidden' name='publicacao_id' value='" . $row["idpostagem"] . "'>";
            echo "<textarea name='comentario' placeholder='Escreva seu comentário aqui...' required></textarea>";
            echo "<button type='button' class='btn-enviar'>Enviar</button>"; // Botão de envio
            echo "</form>";
            echo "</div>"; // Fecha .form-comentario

            echo "</div>"; // Fecha .container1
        }
    } else {
        echo "<div class='container1'>Nenhuma publicação encontrada.</div>";
    }

    $conn->close();
    ?>

</body>
</html>
