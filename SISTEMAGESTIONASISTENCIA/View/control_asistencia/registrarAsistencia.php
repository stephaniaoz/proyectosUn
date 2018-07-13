<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\View\utilities\utilities.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbItemprogramacionacademicaController.php");

$usuario_codigo = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:'';
$nombre_perfil_ingreso = isset($_SESSION['nombre_perfil_ingreso'])?$_SESSION['nombre_perfil_ingreso']:'';
$nombre_carrera_ingreso = isset($_SESSION['nombre_carrera_ingreso'])?$_SESSION['nombre_carrera_ingreso']:'';
$check = isset($_SESSION['checkproaca'])?$_SESSION['checkproaca']:'';

if($nombre_perfil_ingreso == ''){
	header('Location:panel_ingreso.php');
	die();
}

if($usuario_codigo == ''){
	header('Location:../Index.php');
	die();
}

//$_SESSION['control_retorno']='1';

?>
<!DOCTYPE html>

<html lang="en">
<html id="h">
	<head>
		<meta charset="UTF-8">
		<title>Pagina inicial</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css"/>
		<script src="jquery-1.3.2.min.js" type="text/javascript"></script>

		<script type="text/javascript">

			function deshabilitaRetroceso(){
			    window.location.hash="no-back-button";
			    window.location.hash="Again-No-back-button" //chrome
			    window.onhashchange=function(){window.location.hash="no-back-button";}
			}

		</script>
	</head>
	<script type="text/javascript" src="jquery.js"></script>

	<body onload="deshabilitaRetroceso()">

		<p class="titulo_login_principal">Sistema de gesti&oacute;n integral</p>
		<p class="titulo_login_principal">Universidad del valle v1</p>
		<div class="spanconmenu"></div>
		<section id="section_prin"><?php menu($nombre_perfil_ingreso); ?>
			
			<p class='titulo_login'>Bienvenidos</p>

			<div class='seprarador'><?php echo $nombre_perfil_ingreso;?>
			<br><br>

			<div>

				<form action="../../Controller/TbItemprogramacionacademicaController.php" method="post">

					<?php

						for($i=0; $i<count($check); $i++){

							echo "	Código item proaca: <p>".$check[$i]."</p>
									Tema: <p><textarea name='area_tema' rows='4'></textarea></p>
									N&uacute;mero de estudiantes<p><input type='text' name='numero_estudiantes'></p>
									Observaciones<p><textarea name='area_observacion' rows='4'></textarea></p> ";
						}

					?>

										 
					<br>
					<input type="hidden" name = 'modulo' value="registrarAsistencia">
					<button type="submit">Enviar</button>

				</form>

			</div>

		
		</section>	
		
		</div>

	</body>

</html>	