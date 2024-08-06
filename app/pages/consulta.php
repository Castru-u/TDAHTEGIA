<?php


require_once("cabecalho.php");
require_once("../actions/usuario/listar_consultas.php");
require_once("../config/validacoes.php");

?>
<link rel="stylesheet" href="../../public/css/consultas.css">

<main><?php
	if(isset($_GET['msg'])){
		echo $_GET['msg'];
	}
  ?>

	<div id='blocovirar' class='bloco none'>
		<p>Os especialistas são responsáveis por conduzir consultas com pacientes da nossa plataforma, tratando de assuntos ou dificuldades relacionadas com o estudo ou com o TDAH e outros transtornos na vida cotidiana. Para se tornar especialista é necessário possuir uma formação na área da educação, psicologia ou outra relacionada</p>

		<form action="" method="post" enctype="multipart/form-data">

			<p>Selecione a sua área de formação</p>
			<select name="formacao" id="formacao" required>
				<option value="psicologia">psicologia</option>
				<option value="pedagogia">pedagogia</option>
				<option value="outra">outra</option>
			</select><br>
			<p>Insira documento PDF que comprove formação</p>
			<input type='file' accept='.pdf' required></input><br>
			<button>Avançar</button>
			<button type='button' class='cancelar'>Cancelar</button>
		</form>
		
	</div>


	<div id='blocoadd' class='bloco none'>
		<p>As consultas possibilitam intermediar o contato entre especialistas e pessoas com dificuldades quanto ao estudo ou a vivência com TDAH e outros transtornos no geral, esclarecendo dúvidas e auxiliando a resolver problemas na vida cotidiana.</p>

		<form action="../actions/usuario/criar_consulta.php" method="post">
			<p>Selecione a formação do especialista desejado</p>
			<select name="formacao" id="formacao" required>
				<option value="psicologia">psicologia</option>
				<option value="pedagogia">pedagogia</option>
				<option value="qualquer">qualquer</option>
			</select><br>
			<button>Criar consulta</button>	
			<button type='button' class='cancelar'>Cancelar</button>
		</form>
	</div>

	<div id='botoes'>
<?php
	if($_SESSION['role']=='comum'){
		echo '<p id="virar">Virar especialista</p>
		<i class="material-symbols-outlined" id="add">add</i>';
	}
?>
</div>

	<div id="minhasc" class="blococon">
		<h2>Minhas consultas</h2>
		<div class="items">
			<?php

			if(!isset($listaConsultas)){
				echo "<h3>Você não possui nenhuma consulta.<h3>";
			}else{
			foreach($listaConsultas as $consulta){
				
				if($_SESSION['role']=='especialista'){
					$user = retornaUser($consulta['idusuario']);
				}else{
					$user = retornaUser($consulta['idespecialista']);
				}

				echo "<form action='chat.php' method='post'>
						<button class='item'>
						<img src='../../public/uploads/{$user->foto}' alt='foto' class='foto'>
						<h3>{$consulta['nome']}</h3>
						<input type='hidden' name='idchat' value={$consulta['idchat']}>";
				if($_SESSION['role']=='especialista'){
					echo "<input type='hidden' name='idusuario' value={$consulta['idusuario']}>";
				}else{
					echo "<input type='hidden' name='idusuario' value={$consulta['idespecialista']}>";
				}
						
				echo "	</button></form>";	
					};
			};
			?>

		</div>
	</div>
</main>

<aside>

	<div id="chatcon">
			

	</div>

</aside>

<footer><p id="textobaixo">TDAHTÉGIA	&#169;<br>77 98251760</p></footer>

<script src="../../public/js/consulta.js"></script>

</body>