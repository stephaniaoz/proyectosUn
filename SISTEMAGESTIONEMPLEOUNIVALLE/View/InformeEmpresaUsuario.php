<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbUsuarioController.php");

$id = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:0;

if(empty($_SESSION['usuario_codigo']) || empty($_SESSION['perfil_descripcion'])){
	header('Location: Index.php');
	die();
}


//var_dump($_SESSION);

?>
<!DOCTYPE html>

<html lang="en">
<html>
	<head>
	<meta charset="UTF-8">
		<title>Pagina inicial</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	</head>
	<body>

		<h3 class="b_titulo">Bienvenido <?php echo $_SESSION['usuario_nombrecompleto']?></h3>

		<br>
		<div class="seprarador"></div>

			<table class='t_visita' cellpadding = '18' cellspacing = '0'>
				<tr class='tr_celda_par'>
					<th class='b_visita'>Opciones de modulos <a class='button-link' href="Index.php">cerrar_session</a></th>
				</tr>
				<tbody class='b_visita'>				
					<tr class='tr_celda_impar'>
						<td><a class='button-link' href="informeEmpresa.php" target='_blank'>Empresa</a></td>
					</tr>	
					<tr class='tr_celda_par'>
						<td><a class='button-link' href='InformeUsuario.php' target='_blank'>Usuario</a></td>
					</tr>	

				</tbody>
			</table>

	</body>
</html>