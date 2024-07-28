<?php

require("../config/validacoes.php");
require_once("cabecalho.php");

?>
<link rel="stylesheet" href="../../public/css/perfil.css">

<main>
		<div class="form">
			<form action="#">
				<div class="form-header">
				</div>

				<div id="titulo">

					<?php
						$user = retornaUser($_SESSION['id_usuario']);
						echo "<div><h2>{$user->nome}</h2>
						<p>#{$user->idusuario}</p>
						<p>{$user->email}</p></div>";

						echo "<img src='../../public/uploads/defaultuser.jpg' id='fotouser'>";


					?>
				</div>	

				

				<div class="input-group">

				<div id="area1">
					<div class="input-box">
						<label for="firstname">Primeiro Nome</label>
						<input id="firstname" type="text" name="firstname" placeholder="Digite seu primeiro nome" required>
					</div>

					<div class="input-box">
						<label for="lastname">Sobrenome</label>
						<input id="lastname" type="text" name="lastname" placeholder="Digite seu sobrenome" required>
					</div>
					<div class="input-box">
						<label for="email">E-mail</label>
						<input id="email" type="email" name="email" placeholder="Digite seu e-mail" required>
					</div>

				</div>

				<div id="area2">

					<div class="input-box">
						<label for="number">Celular</label>
						<input id="number" type="tel" name="number" placeholder="(xx) xxxx-xxxx" required> 
					</div>

					<br>

					<div class="input-box">
						<div id="bla">
						<br><label for="">Data de nascimento </label><br>
						<input id="data" type="date" name="data_nasc" id="data_nasc" required>
						</div>
					</div>
		
					<div class="input-box">
						<div id="bla1">
						<br><label>Gênero</label><br>
						<select id="gender">
						<option selected disabled value="">Selecione</option>
						<option>Feminino</option>
						<option>Masculino</option>
						<option>Não identificar</option>
						</select>
						</div>
					</div>

				</div>

				<br>

				<div  id="area3">
						
					<div class="input-box">
						<label  for="endereço">Localização</label>
						<input id="endereço" type="text" name="endereço" placeholder="Nome da cidade - UR" required>
					</div>

				</div>

				</div>

				<div class="button">
				<div class="continue-button">
					<button><a href="inicio.html">Salvar</a> </button>
				</div>
				</div>


				
			</form>
	

			
	</div>
</main>


<footer>
	<p>TDAHTÉGIA&copy;2022-2023</p>
</footer>

<!-- Importação do arquivo JavaScript. -->
<script type="text/javascript" src="js/script.js"></script>


</body>