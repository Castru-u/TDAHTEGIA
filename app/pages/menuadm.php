<?php

require_once("cabecalho.php");
require_once("../actions/adm/listar_requisicoes.php");
require_once("../config/validacoes.php");

if($_SESSION['role']!='admin'){
    header("location: consulta.php?");
}

?>
<link rel="stylesheet" href="../../public/css/menuadm.css">
<title>ADM</title>
<main>

    <div id='requisicoes'>
        <?php

        if(isset($_GET['msg'])){
            echo $_GET['msg'];
        }
        if(!isset($requisicoes)){
            echo "<h3>Não possui requisições no momento.<h3>";
        }else{
        foreach($requisicoes as $req){
            
            echo "<div class='req'>
                    <img src='../../public/uploads/{$req['foto']}' alt='foto' class='foto'>
                    <h3>{$req['nome']}<br>{$req['tipo']}<br> documento:
                    <form action='../actions/adm/download.php' method='post'>
                    <input type='hidden' name='documento' value={$req['formacao']}>
                    <button>
                        <i class='material-symbols-outlined laranja' id='add'>download</i>
                    </button></h3>
                    </form>
                    <form action='../actions/adm/aceitar_requisicao.php' method='post'>
                    <input type='hidden' name='idusuario' value={$req['idusuario']}>
                    <button>Aceitar</button>
                    </form>
                    <form action='../actions/adm/recusar_requisicao.php' method='post'>
                    <input type='hidden' name='idusuario' value={$req['idusuario']}>
                    <input type='hidden' name='formacao' value={$req['formacao']}>
                    <button>Recusar</button>
                    </form>
                </div>";
                };
        };
        ?>
    </div>

</main>
