<?php
session_start();
require_once("../config/validacoes.php");
require_once("../config/conecta.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$idusuario = $_SESSION['id_usuario']; 
$usuario = $_SESSION['email']; 
$nome = $_SESSION['nome']; 

define('BASE_PATH', __DIR__ . '/../../app/pages');

conecta(); 
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

$stmt_minhas = $mysqli->prepare($sql_minhas); 
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

$stmt_outros = $mysqli->prepare($sql_outros); 
if ($types_outros) {
    $stmt_outros->bind_param($types_outros, ...$params_outros);
}
$stmt_outros->execute();
$result_outros = $stmt_outros->get_result();

desconecta();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidades</title>
    <link rel="stylesheet" href="../../public/css/mostrar.css">
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
                <button id="createCommunity" class="btn-criar"><img src="../../public/img/MAIS.svg" alt="" class="btn-img"></button>
            </div>
        </div>

        <!-- Minhas Comunidades -->
        <div class="minhas_comunidades">
            <?php
                if (isset($_SESSION['message'])) {
                    echo "<p>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);
                }
            ?>
            <h1>MINHAS COMUNIDADES</h1>
            <?php if ($result_minhas->num_rows > 0): ?>
                <?php while($row_minhas = $result_minhas->fetch_assoc()): ?>
                    <div class="blococom" >
                        <div class="comunidade" id="redirectDiv_<?php echo $row_minhas['idcomunidade']; ?>">
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

        <!-- Outras Comunidades -->
        <div class="sugestoes_de_comunidade">
            <h1>OUTRAS COMUNIDADES</h1>
            <?php if ($result_outros->num_rows > 0): ?>
                <?php while($row_outros = $result_outros->fetch_assoc()): ?>
                    <?php
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
                            <div class="comunidade">
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
                                <button class="btn_entrar_cm" data-id="<?php echo $row_outros['idcomunidade']; ?>" data-acao="entrar">Participar</button>
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

    <script src="../../public/js/mostrar.js"></script>
</body>
</html>
