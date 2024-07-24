<?php


require_once("cabecalho.php");
require_once("../actions/usuario/listar_consultas.php");

?>
<link rel="stylesheet" href="../../public/css/consultas.css">

<main>

	<div id='botoes'><i class="material-symbols-outlined" id="add">
    add
</i>
<?php
	if($_SESSION['role']=='comum'){
		echo '<p>Virar especialista</p>';
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
			echo "<div class='item'>
				<img src='../../public\img\Thw.jpeg' alt='foto' class='foto'>
				<h3>{$consulta['nome']}</h3>
			</div>";
				};
			};
			?>

		</div>
	</div>
</main>

<aside>

	<div id="chatcon"></div>

</aside>

<footer><p id="textobaixo">TDAHTÉGIA	&#169;<br>77 98251760</p></footer>

<script src="js/script.js"></script>

</body>