<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbUsuarioController.php");

$id = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:0;

if(empty($_SESSION['usuario_codigo']) || empty($_SESSION[''])){
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
		<center>
			<h3 class='b_titulo'>Bienvenido <?php echo $_SESSION['usuario_nombrecompleto']?></h3>

			<br>
			<div class="seprarador"></div>

			<?php 

				if($_SESSION['perfil_descripcion'] == 'ADMINISTRADOR'){

			?>
				<table class='t_visita' cellpadding = '18' cellspacing = '0'>
					<tr class='tr_celda_par'>
						<th class='b_visita'>Opciones de modulos <a class='button-link' href="Index.php">cerrar session</a></th>
					</tr>
					<tbody class='b_visita'>				
						<tr class='tr_celda_impar'>
							<td><a href="Modulos/Usuario/Home.php" class="button-link" target='_blank'>Usuario</a></td>
						</tr>	
						<tr class='tr_celda_par'>
							<td><a href='Modulos/Empresa/Home.php' class="button-link" target='_blank'>Empresa</a></td>
						</tr>	
						<tr class='tr_celda_impar'>
							<td><a href='Modulos/Oferta/Home.php' class="button-link" target='_blank'>Oferta</a></td>
						</tr>
						<tr class='tr_celda_par'>
							<td><a href='InformeEmpresaUsuario.php' class="button-link" target='_blank'>Informes</a></td>
						</tr>
						<tr class='tr_celda_impar'>
							<td><a href='#' target='_blank' class="button-link">Perfiles</a></td>
						</tr>
					</tbody>
				</table>
				
			<?php

				}else
					if($_SESSION['perfil_descripcion'] == 'EMPRESA'){

			?>
						<table class='t_visita' cellpadding = '18' cellspacing = '0'>
							<tr class='tr_celda_par'>
								<th class='b_visita'>Opciones de modulos <a href="Index.php" class="button-link">cerrar_session</a></th>
							</tr>
							<tbody class='b_visita'>				
								<tr class='tr_celda_impar'>
									<td><a href="Modulos/Usuario/Home.php" target='_blank' class="button-link">Usuario</a></td>
								</tr>
								<tr class='tr_celda_impar'>
									<td><a href='Modulos/Oferta/Home.php' target='_blank' class="button-link">Oferta</a></td>
								</tr>
								<tr class='tr_celda_par'>
									<td><a href='Modulos/Usuario/ConsultarAreaInteres.php' target='_blank' class="button-link">Consultar Usuario por area de interés</a></td>
								</tr>
							</tbody>
						</table>		
			<?php			

					}else
						if($_SESSION['perfil_descripcion'] == 'CONTACTO'){

			?>
							<table class='t_visita' cellpadding = '18' cellspacing = '0'>
								<tr class='tr_celda_par'>
									<th class='b_visita'>Opciones de modulos <a href="Index.php" class="button-link">cerrar_session</a></th>
								</tr>
								<tbody class='b_visita'>				
									<tr class='tr_celda_impar'>
										<td><a href="Modulos/Usuario/usuarioContactoDetalle.php?usuario_codigo=<?php echo $_SESSION['usuario_codigo']; ?>" target='_blank' class="button-link">Detalles de usuario</a></td>
									</tr>
									<tr class='tr_celda_impar'>
										<td><a href='Modulos/Oferta/Home.php' target='_blank' class="button-link">Oferta</a></td>
									</tr>
									<tr class='tr_celda_par'>
										<td><a href='#' target='_blank'>Informes</a></td>
									</tr>
								</tbody>
							</table>
			<?php

						}else
							if ($_SESSION['perfil_descripcion'] == 'SUPERVISOR') {


			?>
						<table class='t_visita' cellpadding = '18' cellspacing = '0'>
							<tr class='tr_celda_par'>
								<th class='b_visita'>Opciones de modulos <a href="Index.php" class="button-link">cerrar_session</a></th>
							</tr>
							<tbody class='b_visita'>				
								<tr class='tr_celda_impar'>
									<td><a href="Modulos/Usuario/Home.php" target='_blank' class="button-link">Usuario</a></td>
								</tr>
								<tr class='tr_celda_impar'>
									<td><a href='Modulos/Oferta/Home.php' target='_blank' class="button-link">Oferta</a></td>
								</tr>
								<tr class='tr_celda_par'>
									<td><a href='#' target='_blank' class="button-link">Informes</a></td>
								</tr>
							</tbody>
						</table>		
			<?php	
														
						}

			?>
		</center>	
	</body>
</html>