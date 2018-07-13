<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
session_destroy();	

?>
<!DOCTYPE html>

<html lang="en">
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pagina inicial</title>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 
	</head>
	<!-- <script type="text/javascript" src="js/jquery.js"></script>-->

	<body>
		<p class="titulo_login_principal">Sistema de gesti&oacute;n integral</p>
		<p class="titulo_login_principal">Universidad del valle v1</p>

		<div class="container">
	        <div class="card card-container">
	            <span id="imagenlogin"></span>
	            <form class="form-signin" method="POST" action="../Controller/TbUsuarioController.php">
	            	<h3 class="mensajelogin">Bienvenidos</h3>
	                <input type="text" id="inputText" name="usuario_identificacion" class="form-control" placeholder="Usuario" required autofocus>
	                <input type="password" id="inputPassword" name="usuario_password" class="form-control" placeholder="Contraseña" required>
	                <div id="remember" class="checkbox">
	                    <label>
	                        <input type="checkbox" value="remember-me"> Recordarme
	                    </label>
	                </div>
	                <button class="btn btn-lg btn-danger btn-block" name="boton_ingresar" type="submit">Ingresar</button>
	                <input type="hidden" name="modulo" value="ingreso_login">
	            </form>
	            <a href="#" class="forgot-password">
	                ¿Olvidó su contraseña?
	            </a>
	        </div><!-- /card-container -->
	    </div><!-- /container -->
	
	</body>

</html>	