<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");

$usuario_codigo = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:'';

$nombre_perfil_ingreso = isset($_SESSION['nombre_perfil_ingreso'])?$_SESSION['nombre_perfil_ingreso']:'';

$lista_carrera = isset($_SESSION['lista_usuario_carrera'])?$_SESSION['lista_usuario_carrera']:'';

$control_retorno = isset($_SESSION['control_retorno'])?$_SESSION['control_retorno']:'0';

if($_REQUEST){

	$control_retorno = isset($_REQUEST['control_retorno'])?$_REQUEST['control_retorno']:'0';
	$_SESSION['nombre_perfil_ingreso']='';
}



if($nombre_perfil_ingreso == '' || $lista_carrera == ''){
	header('Location:panel_ingreso.php');
	die();
}

if(empty($usuario_codigo)||$control_retorno=='1'){
	header('Location:../Index.php');
	die();
}



?>
<!DOCTYPE html>
<html lang="en">
<html id="h">
	<head>
		<meta charset="UTF-8">
		<title>Pagina inicial</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	</head>
	<script type="text/javascript" src="JqueryPanelIngreso.js"></script>
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<body>
		<div class="container">
			<p class="titulo_login_principal">Programa académico</p>
	        <div class="card card-container">
	            <span id="imagenlogin"></span>
	            <form class="form-signin" method="POST" action="../../Controller/TbUsuarioController.php">
	            	<h3 class="mensajelogin">Seleccione el programa académico</h3>
	            	<select type="text" id="inputText" name="select_carrera" class="form-control" required autofocus>
	            		<option value="0">Seleccione una opción</option>
						<?php

							for($i=0; $i<count($_SESSION['lista_usuario_carrera']); $i++){
								echo "<option value='".$_SESSION['lista_usuario_carrera'][$i]."'>".$_SESSION['lista_usuario_carrera'][$i]."</option>";
							}

						?>
	            	</select>	                
	                <button class="btn btn-lg btn-danger btn-block" name="boton_ingresar" value= "Ingresar" type="submit">Ingresar</button>
	                <input type="hidden" name="modulo" value="ingreso_varios_carrera">
	            </form>
	        </div><!-- /card-container -->
	    </div>
	
	</body>

</html>	