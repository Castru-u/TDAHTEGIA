<?php

require_once("cabecalho.php");
require_once("../actions/usuario/listar_msg.php");
require_once("../config/validacoes.php");
require_once("../actions/usuario/enviar_msg.php")
?>
<link rel="stylesheet" href="../../public/css/chat.css">
<main>

    <div id='caixa'>
        <div id='cabecalho'>
            <a href="consulta.php"><i class="material-symbols-outlined voltar">
                arrow_back_ios
            </i></a>
            <?php
                
                if (isset($_POST['enviar'])) {
                    $_SESSION['idchat'] = $_POST['idchat'];
                    $_SESSION['idctt'] = $_POST['idusuario'];
                    if (strlen($_POST['enviar']) > 0) {
                        set_msg($_POST['enviar'], $_POST['idchat']);
                    }     
                    header("Location:chat.php");
                }
                

                if (isset($_SESSION['idchat']) && isset($_SESSION['idctt'])) {
                    $idchat = $_SESSION['idchat'];
                    $idctt = $_SESSION['idctt'];
                } else {
                    $idchat = $_POST['idchat'];
                    $idctt = $_POST['idusuario'];
                }
                $user = retornaUser($idctt);

                echo "<img src='../../public/uploads/{$user->foto}' alt='foto' class='foto'>
                <p>{$user->nome}</p>";
                

            ?>
            
        </div>

        <div id='msgs'>
            <?php

                if(isset($msgs)){
                    foreach($msgs as $msg){

                        if($msg['idusuario']==$_SESSION['id_usuario']){
                            echo "<p class='user msg'>{$msg['conteudo']}</p>";
                        }else{
                            echo "<p class='outro msg'>{$msg['conteudo']}</p>";
                        }

                    }
                }

            ?>  

        </div>
        
        <div id='caixatexto'>
            <form action="chat.php" method="post">
                <input type="text" name="enviar" id="enviar" placeholder='Digite algo' required>
                <input type="hidden" name="idchat" value=<?php echo"{$idchat}"; ?>>
                <input type='hidden' name='idusuario' value=<?php echo"{$idctt}"; ?>>

                <button type="submit"><i class="material-symbols-outlined enviar">
                send
            </i></button>
            </form>

        </div>
    </div>

</main>


<footer>
	<p>TDAHTÉGIA&copy;2022-2024</p>
</footer>

