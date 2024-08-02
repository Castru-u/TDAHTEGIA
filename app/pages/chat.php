<?php

require_once("cabecalho.php");
require_once("../actions/usuario/listar_msg.php");
require_once("../config/validacoes.php");
?>
<link rel="stylesheet" href="../../public/css/chat.css">
<main>

    <div id='caixa'>
        <div id='cabecalho'>
            <a href="consulta.php"><i class="material-symbols-outlined voltar">
                arrow_back_ios
            </i></a>
            <?php

                $idchat = $_POST['idchat'];
                $user = retornaUser($_POST['idusuario']);

                echo "<img src='../../public/uploads/{$user->foto}' alt='foto' class='foto'>
                <p>{$user->nome}</p>"
                

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
            <form action="" method="post">
                <input type="text" name="enviar" id="enviar" placeholder='Digite algo'>

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