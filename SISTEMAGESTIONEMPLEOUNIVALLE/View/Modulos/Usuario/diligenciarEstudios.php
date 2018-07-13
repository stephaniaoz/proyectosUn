<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbUsuarioController.php");

$usuario_codigo = isset($_REQUEST['usuario_codigo'])?$_REQUEST['usuario_codigo']:0;

?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<title></title>

</head>
	<body>

		<h3>FORMULARIO DILIGENCIAR ESTUDIOS</h3>

		<form name="fromularioEstudio" method="post" action="#"> 
			<p>Codigo:<?php echo $usuario_codigo;  ?></p>
			Nombre entidad:<input type="text" name="iteusuest_entidad" value="" required="required">
			<br><br>
			Nombre carrera:<input type="text" name="iteusuest_carrera" value="" required="required">
			<br><br>
			Descripción:
			<textarea name="iteusuest_descripcion" cols="50" rows="10" id="iteusuest_descripcion" required="required"></textarea>
			<br><br>			
			<input type="submit" value="Grabar">
		</form>
		
	</body>

</html>
