<?php
// define('BASE_PATH', __DIR__ . '/../../app/pages');
require_once(BASE_PATH . '/cabecalho.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tdahtegia";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Mensagem de status
$mensagem = "";

// Processar o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $categoria = $conn->real_escape_string($_POST['categoria']);
    
    // Processar arquivo
    $arquivo = null;
    $tipoArquivo = null;
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == UPLOAD_ERR_OK) {
        // Verificar o tipo de arquivo
        $tipoArquivo = $_FILES['arquivo']['type'];
        $tiposPermitidos = [
            'application/pdf',
            'image/jpeg',
            'image/png',
            'image/gif',
            'audio/mpeg',
            'audio/wav',
            'audio/ogg',
            'video/mp4',
            'video/webm',
            'video/ogg',
            'application/zip',
            'application/gzip',
            'application/x-tar',
            'application/x-bzip2',
            'application/x-sh',
            'application/x-python',
            'font/woff',
            'font/woff2',
            'font/otf',
            'font/ttf',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' // Para XLSX
        ];
        
        if (in_array($tipoArquivo, $tiposPermitidos)) {
            $arquivo = file_get_contents($_FILES['arquivo']['tmp_name']);
        } else {
            $mensagem = "Tipo de arquivo não suportado.";
        }
    } else {
        $mensagem = "Nenhum arquivo enviado ou erro no envio.";
    }

    // Inserir dados no banco de dados
    if ($arquivo !== null) {
        $sql = "INSERT INTO materiais (nome, descricao, categoria, tipo_arquivo, arquivo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        // Bind dos parâmetros. LONGBLOB requer o tipo 'b' para binário
        $stmt->bind_param('sssss', $nome, $descricao, $categoria, $tipoArquivo, $arquivo);

        if ($stmt->execute()) {
            $mensagem = "Material criado com sucesso!";
        } else {
            $mensagem = "Erro: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Filtros
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
$categoriaSelecionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Consultar categorias
$categorias = ['matematica', 'fisica', 'quimica', 'biologia', 'vestibular'];

// Construir consulta com filtros
$sql = "SELECT id, nome, descricao, categoria, tipo_arquivo, arquivo FROM materiais WHERE 1=1";
if (!empty($pesquisa)) {
    $pesquisa = $conn->real_escape_string($pesquisa);
    $sql .= " AND nome LIKE '%$pesquisa%'";
}
if (!empty($categoriaSelecionada)) {
    $categoriaSelecionada = $conn->real_escape_string($categoriaSelecionada);
    $sql .= " AND categoria = '$categoriaSelecionada'";
}
$result = $conn->query($sql);

// Fechar conexão
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar e Mostrar Materiais</title>
    <link rel="stylesheet" href="material.css">
</head>
<body>
    <main>
        <!-- Barra de Pesquisa e Seletor de Categorias -->
        <div class="search-container">
            <input type="text" id="search" class="search-input" placeholder="Pesquisar..." value="<?php echo htmlspecialchars($pesquisa); ?>">
            <select id="category" class="category-select">
                <option value="">Todas as Categorias</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo htmlspecialchars($categoria); ?>" <?php if ($categoria == $categoriaSelecionada) echo 'selected'; ?>>
                        <?php echo ucfirst(htmlspecialchars($categoria)); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Botão Criar Comunidade -->
            <div class="button-container">
                <a href="criar_materias.php" class="btn-criar"><img src="../../public/img/MAIS.svg" alt="" class="btn-img"></a>
            </div>
        </div>

        <div class="container_main">
            <!-- Exibição dos materiais -->
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="blococom">
                        <div class="items_imagem">
                            <?php
                            if ($row['tipo_arquivo'] == 'application/pdf') {
                                $fileData = base64_encode($row['arquivo']);
                                $fileUrl = 'data:application/pdf;base64,' . $fileData;
                                echo '<a href="' . htmlspecialchars($fileUrl) . '" download><img src="../../public/img/pdf.png" alt="Download PDF" class="pdf-icon"></a>';
                            } elseif ($row['tipo_arquivo'] == 'application/zip') {
                                $fileData = base64_encode($row['arquivo']);
                                $fileUrl = 'data:application/zip;base64,' . $fileData;
                                echo '<a href="' . htmlspecialchars($fileUrl) . '" download><img src="../../public/img/zip.jpeg" alt="Download ZIP" class="zip-icon"></a>';
                            } elseif (in_array($row['tipo_arquivo'], ['image/jpeg', 'image/png', 'image/gif'])) {
                                $imgData = base64_encode($row['arquivo']);
                                $imgUrl = 'data:' . htmlspecialchars($row['tipo_arquivo']) . ';base64,' . $imgData;
                                echo '<img src="' . htmlspecialchars($imgUrl) . '" alt="Imagem" style="max-width: 100%; max-height: 100%;">';
                            } elseif (in_array($row['tipo_arquivo'], ['audio/mpeg', 'audio/wav', 'audio/ogg'])) {
                                $audioData = base64_encode($row['arquivo']);
                                $audioUrl = 'data:' . htmlspecialchars($row['tipo_arquivo']) . ';base64,' . $audioData;
                                echo '<audio class="audio-player" controls>
                                        <source src="' . htmlspecialchars($audioUrl) . '" type="' . htmlspecialchars($row['tipo_arquivo']) . '">
                                        Seu navegador não suporta o elemento de áudio.
                                      </audio>';
                            } elseif (in_array($row['tipo_arquivo'], ['video/mp4', 'video/webm', 'video/ogg'])) {
                                $videoData = base64_encode($row['arquivo']);
                                $videoUrl = 'data:' . htmlspecialchars($row['tipo_arquivo']) . ';base64,' . $videoData;
                                echo '<video class="video-viewer" controls>
                                        <source src="' . htmlspecialchars($videoUrl) . '" type="' . htmlspecialchars($row['tipo_arquivo']) . '">
                                        Seu navegador não suporta o elemento de vídeo.
                                      </video>';
                            } elseif (in_array($row['tipo_arquivo'], ['application/gzip', 'application/x-tar', 'application/x-bzip2', 'application/x-sh', 'application/x-python'])) {
                                $fileData = base64_encode($row['arquivo']);
                                $fileUrl = 'data:' . htmlspecialchars($row['tipo_arquivo']) . ';base64,' . $fileData;
                                echo '<a href="' . htmlspecialchars($fileUrl) . '" download>Download do Arquivo</a>';
                            } elseif ($row['tipo_arquivo'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                                $fileData = base64_encode($row['arquivo']);
                                $fileUrl = 'data:' . htmlspecialchars($row['tipo_arquivo']) . ';base64,' . $fileData;
                                echo '<a href="' . htmlspecialchars($fileUrl) . '" download>Download do Arquivo XLSX</a>';
                            } elseif (in_array($row['tipo_arquivo'], ['font/woff', 'font/woff2', 'font/otf', 'font/ttf'])) {
                                $fileData = base64_encode($row['arquivo']);
                                $fileUrl = 'data:' . htmlspecialchars($row['tipo_arquivo']) . ';base64,' . $fileData;
                                echo '<a href="' . htmlspecialchars($fileUrl) . '" download>Download da Fonte</a>';
                            } else {
                                $fileData = base64_encode($row['arquivo']);
                                $fileUrl = 'data:' . htmlspecialchars($row['tipo_arquivo']) . ';base64,' . $fileData;
                                echo '<a href="' . htmlspecialchars($fileUrl) . '" download>Download do Arquivo</a>';
                            }
                            ?>
                        </div>
                        <div class="nome_da_comunidade">
                            <h2><?php echo htmlspecialchars($row['nome']); ?></h2>
                            <!-- <p><?php echo htmlspecialchars($row['descricao']); ?></p> -->
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhum material encontrado.</p>
            <?php endif; ?>
        </div>
    </main>
    <script>
        function updateQueryStringParameter(uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            }
            else {
                return uri + separator + key + "=" + value;
            }
        }

        function handleInputChange(event) {
            if (event.key === 'Enter' || event.type === 'change') {
                const searchInput = document.getElementById('search').value;
                const categorySelect = document.getElementById('category').value;
                let url = window.location.pathname;

                if (searchInput) {
                    url = updateQueryStringParameter(url, 'pesquisa', searchInput);
                } else {
                    url = updateQueryStringParameter(url, 'pesquisa', '');
                }

                if (categorySelect) {
                    url = updateQueryStringParameter(url, 'categoria', categorySelect);
                } else {
                    url = updateQueryStringParameter(url, 'categoria', '');
                }

                window.location.href = url;
            }
        }

        document.getElementById('search').addEventListener('keydown', handleInputChange);
        document.getElementById('category').addEventListener('change', handleInputChange);
    </script>
</body>
</html>
