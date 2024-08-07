<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Comunidades</title>
    <link rel="stylesheet" href="../../public/css/crud.css">
</head>
<body>

    <?php require_once 'cabecalho.php';?>

    <?php
    //session_start();
    require_once("../config/validacoes.php");

    if (!isset($_SESSION['id_usuario'])) {
        header("Location: login.php");
        exit();
    }

    $idusuario = $_SESSION['id_usuario'];
    $idcomunidade = isset($_GET['idcomunidade']) ? intval($_GET['idcomunidade']) : 0;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tdahtegia";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $comunidade = null;
    if ($idcomunidade) {
        $stmt = $conn->prepare("SELECT idcomunidade, nome, descricao, categoria, imagem FROM comunidades WHERE idcomunidade = ?");
        $stmt->bind_param('i', $idcomunidade);
        $stmt->execute();
        $result = $stmt->get_result();
        $comunidade = $result->fetch_assoc();
        $stmt->close();
    }

    $categorias = ["matematica", "fisica", "quimica", "biologia", "vestibular"];

    $usuarios = [];
    if ($idcomunidade) {
        $stmt = $conn->prepare("SELECT cu.id AS comunidade_usuario_id, u.idusuario, u.nome AS usuario, cu.role 
                                FROM comunidade_usuario cu 
                                JOIN usuario u ON cu.idusuario = u.idusuario 
                                WHERE cu.idcomunidade = ?");
        $stmt->bind_param('i', $idcomunidade);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        $stmt->close();
    }

    // Verificar se o usuário logado é admin da comunidade
    $isAdmin = false;
    if ($idcomunidade) {
        $stmt = $conn->prepare("SELECT role FROM comunidade_usuario WHERE idcomunidade = ? AND idusuario = ?");
        $stmt->bind_param('ii', $idcomunidade, $idusuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $role = $result->fetch_assoc()['role'];
            if ($role === 'admin') {
                $isAdmin = true;
            }
        }
        $stmt->close();
    }

    $conn->close();
    ?>

    <main class="container">
        <h1 class="titulo-pagina"><?php echo $idcomunidade ? 'Editar Comunidade' : 'Criar Comunidade'; ?></h1>
        <form class="formulario" action="../actions/comunidade/crud_processar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idcomunidade" value="<?php echo htmlspecialchars($comunidade['idcomunidade'] ?? ''); ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($comunidade['nome'] ?? ''); ?>" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($comunidade['descricao'] ?? ''); ?></textarea>

            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo htmlspecialchars($categoria); ?>" <?php echo (isset($comunidade['categoria']) && $comunidade['categoria'] == $categoria) ? 'selected' : ''; ?>>
                        <?php echo ucfirst(htmlspecialchars($categoria)); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem">

            <?php if (isset($comunidade['imagem']) && !empty($comunidade['imagem'])): ?>
                <img class="imagem-comunidade" src="data:image/jpeg;base64,<?php echo base64_encode($comunidade['imagem']); ?>" alt="Imagem da Comunidade">
            <?php endif; ?>

            <button class="botao-enviar" type="submit" name="action" value="<?php echo $idcomunidade ? 'update' : 'create'; ?>">
                <?php echo $idcomunidade ? 'Atualizar' : 'Criar'; ?>
            </button>

            <?php if ($idcomunidade && $isAdmin): ?>
                <button class="botao-deletar" type="submit" name="action" value="delete" onclick="return confirm('Tem certeza de que deseja excluir esta comunidade?');">
                    Excluir Comunidade
                </button>
            <?php endif; ?>
        </form>

        <h2 class="titulo-secao">Gerenciar Usuários da Comunidade</h2>
        <form class="formulario" action="../actions/comunidade/crud_processar.php" method="POST">
            <input type="hidden" name="idcomunidade" value="<?php echo htmlspecialchars($idcomunidade); ?>">
            <label for="idusuario">Adicionar Usuário:</label>
            <select id="idusuario" name="idusuario" required>
                <?php
                // Conecte-se ao banco de dados novamente para buscar os usuários disponíveis
                $conn = new mysqli($servername, $username, $password, $dbname);
                $usuarios_disponiveis = [];
                $result = $conn->query("SELECT idusuario, nome FROM usuario");
                while ($row = $result->fetch_assoc()) {
                    $usuarios_disponiveis[] = $row;
                }
                $conn->close();
                
                foreach ($usuarios_disponiveis as $usuario): ?>
                    <option value="<?php echo htmlspecialchars($usuario['idusuario']); ?>">
                        <?php echo htmlspecialchars($usuario['nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="role">Função:</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="membro">Membro</option>
            </select>
            <button class="botao-enviar" type="submit" name="action" value="add_user">Adicionar Usuário</button>
        </form>

        <h2 class="titulo-secao">Usuários na Comunidade</h2>
        <table class="tabela-dados">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Função</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['role']); ?></td>
                        <td>
                            <?php if ($isAdmin): ?>
                                <a href="../actions/comunidade/deletar.php?action=remove_user&idcomunidade=<?php echo urlencode($idcomunidade); ?>&idusuario=<?php echo urlencode($usuario['idusuario']); ?>" onclick="return confirm('Tem certeza de que deseja remover este usuário?');">
                                    Remover
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <footer><p id="textobaixo">TDAHTÉGIA &#169;<br>77 98251760</p></footer>
    
</body>
</html>
