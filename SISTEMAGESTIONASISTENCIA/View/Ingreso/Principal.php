<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\View\utilities\utilities.php");

$usuario_codigo = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:'';
$nombre_perfil_ingreso = isset($_SESSION['nombre_perfil_ingreso'])?$_SESSION['nombre_perfil_ingreso']:'';
$nombre_carrera_ingreso = isset($_SESSION['nombre_carrera_ingreso'])?$_SESSION['nombre_carrera_ingreso']:'';
$listaperfil = isset($_SESSION['lista_perfil'])?$_SESSION['lista_perfil']:'';

if($nombre_perfil_ingreso == ''){
	header('Location:panel_ingreso.php');
	die();
}
/*
if($nombre_carrera_ingreso == ''){
	header('Location:../panel_ingreso_carreras.php');
	die();
}*/

if($usuario_codigo == ''){
	header('Location:../Index.php');
	die();
}

$_SESSION['control_retorno']='1';

?>
<!DOCTYPE html>

<html lang="en">
<html>

	<?php head("Página principal"); ?>
	
		<?php menu($nombre_perfil_ingreso, $listaperfil); ?>		

	</body>

</html>	