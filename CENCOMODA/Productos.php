<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Productos</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery-1.11.2.min.js" ></script>
	<script src="js/material.min.js" ></script>
	<script src="js/sweetalert2.min.js" ></script>
	<script src="js/main.js" ></script>
</head>
<body>
	<?php
		session_start();
		if (!isset($_SESSION['usuario'])) {
				header('Location:index.php');
		}

		include("connection/connection.php");
		$Productos = new Database();
	?>
	<!-- Barra superior -->
	<?php
		include 'impl/barra_superior.html';
	?>
	<!-- Barra lateral -->
	<?php
		include 'impl/barra_lateral.php';
	?>
	<!-- Contendido pagina -->
	<section class="full-width pageContent">
		<section class="full-width text-center" style="padding: 40px 0;">
		</section>
		<h3 class="text-center tittles">Productos</h3>
		<div class="Productos">
			<?php

				$ultimoRegistro = $Productos->consultarGestion("tab_productos");

				echo "<p> Codigo: ". (pg_fetch_result($ultimoRegistro, 0) + 1) ."</p>";

			?>
			<form method="POST">
				<label for="insumos">Tipo Uniforme:</label>
				<select name="Uniforme" id="Uniforme">
				<option value="Sudaderas">Sudaderas</option>
					<option value="Conjuntos">Conjuntos</option>
					<option value="Blusas">Blusas</option>
					<option value="Pantalones">Pantalones</option>
					<option value="Camibusos">Camibusos</option>
					<option value="Jardineras">Jardineras</option>
					<option value="Uniforme escolar">Uniforme escolar</option>
					<option value="Buso">Buso</option>
					<option value="Bicicelteras">Bicicelteras</option>
					<option value="Embones">Embones</option>
					<option value="Sesgos">Sesgos</option>
				</select>
				<br> <br> 
				<label for="color">color:</label>
				<select name="Color" id="Color">
				    <option value="Rojo">Blanco</option>
					<option value="Azul">Negro</option>
					<option value="Verde">Rojo</option>
					<option value="Blanco">Gris</option>
					<option value="Gris">Amarillo</option>
					<option value="Gris">Azul</option>
					<option value="Gris">Azul Oscuro</option>
					<option value="Gris">Azul Bebe</option>
					<option value="Gris">Verde</option>
					<option value="Gris">Verde Cali</option>
					<option value="Gris">Verde Pistacho</option>
					<option value="Gris">Oscuro</option>
					<option value="Gris">Vinotinto</option>
				</select>
				<!--<p>Color: <input type="text" name="Color"/></p> -->
				<p>Cantidad: <input type="text" name="Cantidad"/></p>
				<label for="talla">Talla:</label>
				<select name="Talla" id="Talla">
				<option value="6">6</option>
					<option value="8">8</option>
					<option value="10">10</option>
					<option value="12">12</option>
					<option value="14">14</option>
					<option value="16">16</option>
					<option value="S">S</option>
					<option value="M">M</option>
					<option value="L">L</option>
					<option value="XL">XL</option>
				</select>
				<br>
				<input type="submit" name="submit" value="Guardar">
			</form>
				<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
						if (empty($_POST["Uniforme"]) ||
								empty($_POST["Color"]) ||
								empty($_POST["Cantidad"]) ||
								empty($_POST["Talla"])) {
							echo "Todos los campos son obligatorios.";
						} else {
							$valores = array($_POST["Uniforme"],  $_POST["Color"], $_POST["Cantidad"], $_POST["Talla"]);
							$Productos->insertarGestion("tab_productos", $valores);
						}
					}
				?>	
		</div>
	</section>
</body>
</html>