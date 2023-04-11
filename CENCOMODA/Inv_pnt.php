<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Productos no terminados</title>
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
		$Inv_pnt = new Database();
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
		<h3 class="text-center tittles">Inventario Productos No Terminados</h3>
		<div class="invpnt">
			<?php

				$ultimoRegistro = $Inv_pnt->consultarGestion("tab_inventario_productos_no_terminados");

				echo "<p> Codigo: ". (pg_fetch_result($ultimoRegistro, 0) + 1) ."</p>";

			?>
			<form method="POST">
				<label for="tela">Tipo de tela:</label>
				<select name="tela" id="tela">
				<option value="Gaborolina">Gaborolina</option>
					<option value="Algodon Perchado">Algodon Perchado</option>
					<option value="Polux">Polux</option>
					<option value="Antifluido">Antifludio</option>
					<option value="lacos">lacos</option>
					<option value="Nautica">Nautica</option>
					<option value="800-1">800-1</option>
					<option value="Adidas">Adidas</option>
					<option value="Linoflex">Linoflex</option>
					<option value="Dacron">Dracon</option>
					<option value="Algodon Perchado">Algodon Perchado</option>
					<option value="Poliester">Poliester</option>
					<option value="Popelina">Popelina</option>
					<option value="Licras">Licras</option>
					<option value="piket">Piket</option>
				</select>
				<p>Cantidad: <input type="text" name="Cantidad1"/></p>
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
				<br> <br>
				<label for="insumos">Tipo de Insumos:</label>
				<select name="insumos" id="insumos">
					<option value="Resortes">Resortes</option>
					<option value="Broches">Broches</option>
					<option value="Cremalleras">Cremalleras</option>
					<option value="Hilos">Hilos</option>
					<option value="Hilazas">Hilazas</option>
					<option value="Encajes">Encajes</option>
					<option value="Cuellos">Cuellos</option>
					<option value="Puños">Puños</option>
					<option value="Botones">Botones</option>
				</select>
				<p>Cantidad: <input type="text" name="Cantidad2"/></p>
				<br>
				<label for="start">Fecha:</label>
				<input type="date" name="fechaAgregado"  id="start" 
				name="trip-start">
			   <br>
				<input type="submit" name="submit" value="Guardar">
			  </form>
			  <?php
					if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
						if (empty($_POST["tela"]) ||
								empty($_POST["Cantidad1"]) ||
								empty($_POST["Color"]) ||
								empty($_POST["insumos"]) ||
								empty($_POST["Cantidad2"]) ||
								empty($_POST["fechaAgregado"])) {
							echo "Todos los campos son obligatorios.";
						} else {
							$valores = array($_POST["tela"], $_POST["Cantidad1"],  $_POST["Color"], $_POST["insumos"], $_POST["Cantidad2"], $_POST["fechaAgregado"]);
							$Inv_pnt->insertarGestion("tab_inventario_productos_no_terminados",$valores);
						}
					}
				?>
		</div>
	</section>
</body>
</html>