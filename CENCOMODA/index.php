<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio y registro</title>
    <link rel="stylesheet" href="css/Login-register.css">
</head>
<body>
    <?php
		include("connection/connection.php");
		$index = new Database();
	?>
    <div class="contenedor-form">
        <div class="toggle">
            <span> Crear Cuenta</span>
        </div>
        
        <div class="formulario">
            <h2>Iniciar Sesión</h2>
            <form method="POST">
                <img src="assets/Logo_cencomoda.png" alt="" class="avatar">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                <input type="submit" name="entrar" value="Iniciar Sesión">
            </form>
        </div>
        
        <div class="formulario">
            <h2>Crea tu Cuenta</h2>
            <form method="POST">
                <img src="assets/Logo_cencomoda.png" alt="" class="avatar">
                
                <input type="text" name="usuario2" placeholder="Usuario" required>
                
                <input type="password" name="contraseña2" placeholder="Contraseña" required>
                
                <input type="email" name="correo" placeholder="Correo Electronico" required>
                
                <input type="telephone" name="telefono" placeholder="Teléfono" required>
                
                <input type="submit" name="registrarse" value="Registrarse">
            </form>
            <?php
					if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
                        if ( isset($_POST["entrar"])){
                            if (empty($_POST["usuario"]) ||
                            empty($_POST["contraseña"])) {
                        echo "Todos los campos son obligatorios.";
                    } else {
                        $index->login($_POST["usuario"], $_POST["contraseña"]);
                    }

                        } else if(isset($_POST["registrarse"])) {
                            if (empty($_POST["usuario2"]) ||
                            empty($_POST["contraseña2"]) ||
                            empty($_POST["correo"]) ||
                            empty($_POST["telefono"])) {
                        echo "Todos los campos son obligatorios.";
                    } else {
                        $valores = array($_POST["usuario2"],  md5($_POST["contraseña2"]), $_POST["correo"], $_POST["telefono"]);
                        $index->insertarGestion("tab_registrousu", $valores);
                    }
                        }
					}
				?>	
        </div>
    </div>
    <script src="js/jquery-3.1.1.min.js"></script>    
    <script src="js/login-register.js"></script>
</body>
</html>