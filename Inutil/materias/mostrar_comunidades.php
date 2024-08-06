<?php
session_start();
require_once("../../app/config/validacoes.php");

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../app/pages/login.php");
    exit();
}
// Acessar informações do usuário
$idusuario = $_SESSION['id_usuario']; 
$usuario = $_SESSION['email']; 
$nome = $_SESSION['nome']; 

define('BASE_PATH', __DIR__ . '/../../app/pages');

$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "tdahtegia";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$categorias = ["matematica", "fisica", "quimica", "biologia", "vestibular"];

$categoriaSelecionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

// Consulta para buscar as comunidades nas quais o usuário participa
$sql_minhas = "
    SELECT c.idcomunidade, c.nome, c.descricao, c.imagem
    FROM comunidades c
    INNER JOIN comunidade_usuario cu ON c.idcomunidade = cu.idcomunidade
    WHERE cu.idusuario = ?";

$params_minhas = [$idusuario];
$types_minhas = 'i';

if ($categoriaSelecionada) {
    $sql_minhas .= " AND c.categoria = ?";
    $params_minhas[] = $categoriaSelecionada;
    $types_minhas .= 's';
}
if ($pesquisa) {
    $sql_minhas .= " AND LOWER(c.nome) LIKE LOWER(?)";
    $params_minhas[] = "%$pesquisa%";
    $types_minhas .= 's';
}

$stmt_minhas = $conn->prepare($sql_minhas);
$stmt_minhas->bind_param($types_minhas, ...$params_minhas);
$stmt_minhas->execute();
$result_minhas = $stmt_minhas->get_result();

// Consulta para buscar todas as comunidades
$sql_outros = "SELECT idcomunidade, nome, descricao, imagem FROM comunidades";
$params_outros = [];
$types_outros = '';

if ($categoriaSelecionada) {
    $sql_outros .= " WHERE categoria = ?";
    $params_outros[] = $categoriaSelecionada;
    $types_outros .= 's';
}
if ($pesquisa) {
    $sql_outros .= $types_outros ? " AND " : " WHERE ";
    $sql_outros .= "(LOWER(nome) LIKE LOWER(?) OR LOWER(descricao) LIKE LOWER(?))";
    $params_outros[] = "%$pesquisa%";
    $params_outros[] = "%$pesquisa%";
    $types_outros .= 'ss';
}

$stmt_outros = $conn->prepare($sql_outros);
if ($types_outros) {
    $stmt_outros->bind_param($types_outros, ...$params_outros);
}
$stmt_outros->execute();
$result_outros = $stmt_outros->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidades</title>
    <link rel="stylesheet" href="mostra.css">
</head>
<body>
    <?php require_once(BASE_PATH . '/cabecalho.php'); ?>

    <main class="container_main">
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
                <a href="criar_comunidade.php" class="btn-criar"><img src="../../public/img/MAIS.svg" alt="" class="btn-img"></a>
            </div>
        </div>

        <!-- Minhas Comunidades -->
        <div class="minhas_comunidades">
            <?php
                session_start();
                if (isset($_SESSION['message'])) {
                    echo "<p>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);
                }
            ?>
            <h1>MINHAS COMUNIDADES</h1>
            <?php if ($result_minhas->num_rows > 0): ?>
                <?php while($row_minhas = $result_minhas->fetch_assoc()): ?>
                    <div class="blococom">
                        <div class="comunidade" id="redirectDiv">
                            <?php if ($row_minhas['imagem']): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row_minhas['imagem']); ?>" alt="">
                            <?php else: ?>
                                <img src="../../public/img/menino.jpeg" alt="">
                            <?php endif; ?>
                            <div class="nome_descricao">
                                <h2><?php echo htmlspecialchars($row_minhas['nome']); ?></h2>
                                <h6><?php echo htmlspecialchars($row_minhas['descricao']); ?></h6>
                            </div>
                        </div>
                        <div class="botoes_crud">
                            <button class="btn_entrar_cm" data-id="<?php echo $row_minhas['idcomunidade']; ?>" data-acao="sair">Sair</button> 
                            <button class="btn_entrar_cm" onclick="redirectToEdit(<?php echo $row_minhas['idcomunidade']; ?>)">Editar</button>

                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhuma comunidade encontrada.</p>
            <?php endif; ?>
        </div>

        <!-- Sugestões de Comunidades -->
        <div class="sugestoes_de_comunidade">
            <h1>OUTRAS COMUNIDADES</h1>
            <?php if ($result_outros->num_rows > 0): ?>
                <?php while($row_outros = $result_outros->fetch_assoc()): ?>
                    <?php
                        // Verifica se a comunidade já foi exibida
                        $already_displayed = false;
                        if ($result_minhas->num_rows > 0) {
                            $result_minhas->data_seek(0); 
                            while ($row_minhas = $result_minhas->fetch_assoc()) {
                                if ($row_outros['idcomunidade'] == $row_minhas['idcomunidade']) {
                                    $already_displayed = true;
                                    break;
                                }
                            }
                        }
                    ?>
                    <?php if (!$already_displayed): ?>
                        <div class="blococom">
                            <div class="comunidade" id="redirectDiv">
                                <?php if ($row_outros['imagem']): ?>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row_outros['imagem']); ?>" alt="">
                                <?php else: ?>
                                    <img src="../../public/img/menino.jpeg" alt="">
                                <?php endif; ?>
                                <div class="nome_descricao">
                                    <h2><?php echo htmlspecialchars($row_outros['nome']); ?></h2>
                                    <h6><?php echo htmlspecialchars($row_outros['descricao']); ?></h6>
                                </div>
                            </div>
                            <div class="botoes_crud">
                                <button class="btn_entrar_cm" data-id="<?php echo $row_outros['idcomunidade']; ?>" data-acao="entrar">Entrar</button>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhuma comunidade sugerida encontrada.</p>
            <?php endif; ?>
        </div>
    </main>
    <footer><p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p></footer>

    <script>
    function redirectToEdit(comunidadeId) {
        window.location.href = 'crud.php?idcomunidade=' + comunidadeId;
    }

    document.querySelectorAll('.btn_entrar_cm').forEach(button => {
        button.addEventListener('click', function() {
            const comunidadeId = this.getAttribute('data-id');
            const acao = this.getAttribute('data-acao');

            if (acao) {
                fetch('entrar_e_sair_comunidade.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        'idcomunidade': comunidadeId,
                        'acao': acao
                    })
                })
                .then(response => response.text())
                .then(result => {
                    alert(result); // Exibe o resultado do PHP
                    location.reload(); // Atualiza a página
                })
                .catch(error => console.error('Erro:', error));
            }
        });
    });

    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    }

    function handleInputChange(event) {
        if (event.key === 'Enter' || event.type === 'change') {
            event.preventDefault();
            const searchInput = document.getElementById('search').value.trim();
            const categorySelect = document.getElementById('category').value;
            let url = window.location.pathname;

            // Atualiza o parâmetro da pesquisa
            if (searchInput) {
                url = updateQueryStringParameter(url, 'pesquisa', searchInput);
            } else {
                url = updateQueryStringParameter(url, 'pesquisa', '');
            }

            // Atualiza o parâmetro da categoria
            if (categorySelect) {
                url = updateQueryStringParameter(url, 'categoria', categorySelect);
            } else {
                url = updateQueryStringParameter(url, 'categoria', '');
            }

            // Redireciona para a nova URL
            window.location.href = url;
        }
    }

    document.getElementById('search').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            handleInputChange(event);
        }
    });

    document.getElementById('category').addEventListener('change', handleInputChange);

     // JavaScript para redirecionamento
     document.getElementById('redirectDiv').addEventListener('click', function() {
            window.location.href = 'http://localhost/TDAHTEGIA/Inutil/materias/comunidade.php'; // URL para onde será redirecionado
        });
</script>

</body>
</html>
