<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbUsuarioController.php");

$usuario_codigo = isset($_REQUEST['usuario_codigo'])?$_REQUEST['usuario_codigo']:0;
$usuario_nombres = isset($_REQUEST['nombre'])?$_REQUEST['nombre']:0;

if(empty($_SESSION['usuario_codigo']) || empty($_SESSION['perfil_descripcion'])){
	header('Location: Index.php');
	die();
}

?>
<!DOCTYPE html>

<html lang="en">
<html>
	<head>
	<meta charset="UTF-8">
		<title>Pagina inicial</title>
		<link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
	</head>
	<body>

		<h3>DETALLES DE USUARIO <?php echo $usuario_codigo." - ".$usuario_nombres;  ?></h3>

		<?php

			if($_SESSION['perfil_descripcion'] != 'EMPRESA'){
		?>
				<table class='t_visita' cellpadding = '18' cellspacing = '0'>
					<tr class='tr_celda_par'>
						<th class='b_visita'>Opciones  <a class='button-link' href="../../Index.php">cerrar_session</a></th>
					</tr>
					<tbody class='b_visita'>

						<tr class='tr_celda_impar'>
								<td><a class='button-link' href="calificarUsuario.php?usuario_codigo=<?php echo $usuario_codigo; ?>" target='_blank'>Calificación usuario</a></td>
							</tr>
	
						<tr class='tr_celda_par'>
							<td><a class='button-link' href='diligenciarEstudios.php?usuario_codigo=<?php echo $usuario_codigo; ?>' target='_blank'>Diligenciar estudios</a></td>
						</tr>
						<tr class='tr_celda_impar'>
							<td><a class='button-link' href='diligenciarExperiencialaboral.php?usuario_codigo=<?php echo $usuario_codigo; ?>' target='_blank'>Diligenciar experiencia laboral</a></td>
						</tr>
						<tr class='tr_celda_par'>
							<td><a class='button-link' href='diligenciarHabilidades.php?usuario_codigo=<?php echo $usuario_codigo; ?>' target='_blank'>Diligenciar habilidades</a></td>
						</tr>
						<tr class='tr_celda_impar'>
							<td><a class='button-link' href='diligenciarLogros.php?usuario_codigo=<?php echo $usuario_codigo; ?>' target='_blank'>Diligenciar logros</a></td>
						</tr>
					</tbody>
				</table>

		<?php
			}else{

		?>
					<table class='t_visita' cellpadding = '18' cellspacing = '0'>
						<tr class='tr_celda_par'>
							<th class='b_visita'>Opciones  <a class='button-link' href="../../Index.php">cerrar_session</a></th>
						</tr>
						<tbody class='b_visita'>

							<tr class='tr_celda_impar'>
								<td><a class='button-link' href="calificarUsuario.php?usuario_codigo=<?php echo $usuario_codigo; ?>" target='_blank'>Calificar usuario</a></td>
							</tr>
							<tr class='tr_celda_impar'>
								<td><a class='button-link' href="PerfilUsuario.php?usuario_codigo=<?php echo $usuario_codigo; ?>" target='_blank'>Ver perfil</a></td>
							</tr>		
					
						</tbody>
					</table>
		<?php			

				}

		?>

	</body>
</html>