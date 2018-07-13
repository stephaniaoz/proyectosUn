<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\View\utilities\utilities.php");

$usuario_codigo = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:'';
$lista_perfil = isset($_SESSION['lista_perfil'])?$_SESSION['lista_perfil']:'';

$control_retorno = isset($_SESSION['control_retorno'])?$_SESSION['control_retorno']:'0';

if($_REQUEST){
	$control_retorno = isset($_REQUEST['control_retorno'])?$_REQUEST['control_retorno']:'0';
	$_SESSION['nombre_perfil_ingreso']='';
}

if(empty($usuario_codigo) || $control_retorno=='1'){
	header('Location:../Index.php');
	die();
}

?>
<!DOCTYPE html>
<html lang="en">
<html>
	
	<?php head("Panel ingreso"); ?>

	<body>
		<div class="container">
			<p class="titulo_login_principal">Perfiles</p>
	        <div class="card card-container">
	            <span id="imagenlogin"></span>
	            <form class="form-signin" method="POST" action="../../Controller/TbUsuarioController.php">
	            	<h3 class="mensajelogin">Seleccione el perfil deseado</h3>
	            	<select type="text" id="inputText" name="select_perfil" class="form-control" required autofocus>
	            		<option value="0">Seleccione una opción</option>
						<?php

							for($i=0; $i<count($_SESSION['lista_perfil']); $i++){
								echo "<option value='".$_SESSION['lista_perfil'][$i]."'>".$_SESSION['lista_perfil'][$i]."</option>";
							}

						?>
	            	</select>	                
	                <button class="btn btn-lg btn-danger btn-block" name="boton_ingresar" value= "Ingresar" type="submit">Ingresar</button>
	                <input type="hidden" name="modulo" value="ingreso_varios">
	            </form>
	        </div><!-- /card-container -->
	    </div>
	
	</body>

</html>	