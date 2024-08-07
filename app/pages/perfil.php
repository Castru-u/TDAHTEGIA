<?php

require("../config/validacoes.php");
require_once("cabecalho.php");

?>
<link rel="stylesheet" href="../../public/css/perfil.css">
<title>Perfil</title>
<main>
		<div class="form">
			<form action="../actions/usuario/alterar_usuario.php" method='POST' enctype="multipart/form-data">

				<div id="titulo">

					<?php
						$user = retornaUser($_SESSION['id_usuario']);
						echo "<div><h2>{$user->nome}</h2>
						<p>#{$user->idusuario}</p>
						<p>{$user->email}</p></div>";

						echo "<img src='../../public/uploads/{$user->foto}' id='fotouser'>";


					?>
				</div>	

				

				<div class="input-group">

				<div id="area1" class='none'>
					<div class="input-box">
						<label for="firstname">Nome</label>
						<input id="firstname" type="text" name="nome" placeholder="Digite um nome" value=<?php echo"'{$user->nome}'"; ?> required maxlength="50">
					</div>
					<div class="input-box">
						<label for="foto">Foto</label>
						<input id="foto" type="file" name="foto" placeholder="Escolha uma foto" accept='image/*'>
					</div>

				</div>
					<div class="input-box">
						<label for="descricao">Sobre mim</label>
						<textarea class='none' id="descricao" type="" name="descricao" placeholder="Fale um pouco sobre você!" maxlength="200" ><?php echo"{$user->descricao}"; ?></textarea>
						<p><?php echo"{$user->descricao}"; ?></p>
					</div>

				
				</div>	

				
				<div class="continue-button">
					<button id='editar' type='button'>Editar</button>
					<button id='cancelar' type='button'class='none'>Cancelar</button>
					<button id='salvar' class='none'type='submit'>Salvar</button>
				</div>
				


				
			</form>
	

			
	</div>
</main>


<footer>
	<p>TDAHTÉGIA&copy;2022-2024</p>
</footer>

<!-- Importação do arquivo JavaScript. -->
<script src="../../public/js/perfil.js"></script>


</body>