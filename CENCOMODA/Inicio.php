<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inicio</title>
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
	<!-- Barra superior -->
	<?php
		session_start();
		if (!isset($_SESSION['usuario'])) {
				header('Location:index.php');
		}

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
		<h3 class="text-center tittles">Cencomoda</h3>
		<p> Somos una empresa diseñadora y comercializadora de ropa deportiva para todo público 
			generando desarrollo económico y laboral a nuestros empleados, buscando satisfacer las 
			necesidades de nuestros clientes, siendo competitivos en el mercado del país
		</p>
	</section>
</body>
</html>