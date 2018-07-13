<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbUsuarioController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbPaisController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbDepartamentoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbCiudadController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbTipoDocumentoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbPerfilController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbTipoformacionController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbProgramaacademicoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEntidadEstudioController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbItementidadestudiosedeController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEstadoController.php");

include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbItemusuarioestudiosController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbItemusuarioexperiencialaboralController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbItemusuariohabilidadesController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbItemusuariologrosController.php");


$usuario_codigo = isset($_REQUEST['usuario_codigo'])?$_REQUEST['usuario_codigo']:'';

if(empty($_SESSION['usuario_codigo']) || empty($_SESSION['perfil_descripcion'])){
	header('Location: Index.php');
	die();
}

$arrayUsuario = array();
$getUsuario = new TbUsuarioController();
$arrayUsuario = $getUsuario->getListaUsuarioId($usuario_codigo)[0];

echo $arrayUsuario['tipdoc_codigo'];

					var_dump($arrayUsuario);


//tb_itemusuarioestudios
$arrayitemusuarioestudios = array();
$getUsuarioitemusuarioestudios = new TbItemusuarioestudiosController();
$arrayitemusuarioestudios = $getUsuarioitemusuarioestudios->getListaUsuarioId($usuario_codigo);

//tb_itemusuarioexperiencialaboral
$arrayitemusuarioexperiencialaboral = array();
$getitemusuarioexperiencialaboral = new TbItemusuarioexperiencialaboralController();
$arrayitemusuarioexperiencialaboral = $getitemusuarioexperiencialaboral->getListaUsuarioId($usuario_codigo);

//tb_itemusuariohabilidades
$arrayUsuarioitemusuariohabilidades = array();
$getUsuarioitemusuariohabilidades = new TbItemusuariohabilidadesController();
$arrayUsuarioitemusuariohabilidades = $getUsuarioitemusuariohabilidades->getListaUsuarioId($usuario_codigo);

//tb_itemusuariologros
$arrayUsuarioitemusuariologros = array();
$getUsuarioitemusuariologros = new TbItemusuariologrosController();
$arrayUsuarioitemusuariologros = $getUsuarioitemusuariologros->getListaUsuarioId($usuario_codigo);

?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />

  	<script>
	</script>

  

</head>
	<body>

		<h3>FORMULARIO PERFIL USUARIO <?php echo $arrayUsuario['usuario_nombres']." ".$arrayUsuario['usuario_apellidos']; ?></h3>

		<table class='t_visita' cellpadding = '18' cellspacing = '0'>
			<tr class='tr_celda_par'>
				<th class='b_visita'>Perfil de usuario <a href="../../Index.php">cerrar_session</a></th>
			</tr>
			<tbody class='b_visita'>				
				<tr class='tr_celda_impar'>
					<td>
						<label><strong>Nombres:&nbsp;</strong></label><?php echo $arrayUsuario['usuario_nombres']; ?></br>
						<label><strong>Apellidos:&nbsp;</strong></label><?php echo $arrayUsuario['usuario_apellidos']; ?><br>
						<label><strong>Fecha nacimiento:&nbsp;</strong></label><?php echo $arrayUsuario['usuario_fechanacimiento']; ?><br>
						<label><strong>Sexo:&nbsp;</strong></label><?php echo $arrayUsuario['usuario_sexo']; ?><br>

					</td>
				</tr>

				<tr class='tr_celda_par'>
					<td>
						<label><strong>Teléfono:&nbsp;</strong></label><?php echo $arrayUsuario['usuario_telefono']; ?><br>
						<label><strong>Celular:&nbsp;</strong></label><?php echo $arrayUsuario['usuario_celular']; ?><br>
						<label><strong>Email:&nbsp;</strong></label><?php echo $arrayUsuario['usuario_email']; ?><br>
					</td>
				</tr>

				<tr class='tr_celda_impar'>
					<td>
						<label><strong>Universidad:&nbsp;</strong></label><?php echo $arrayUsuario['entest_nombre']; ?><br>
						<label><strong>Sede:&nbsp;</strong></label><?php echo $arrayUsuario['iteentestsed_nombre']; ?><br>
						<label><strong>Tipo formación:&nbsp;</strong></label><?php echo $arrayUsuario['tipfor_descripcion']; ?><br>
					</td>
				</tr>

				<tr class='tr_celda_par'>
					<td>
						<label><strong>Celular:&nbsp;</strong></label><?php echo $arrayUsuario['usuario_celular']; ?><br>
						<label><strong>Email:&nbsp;</strong></label><?php echo $arrayUsuario['usuario_email']; ?><br>
					</td>
				</tr>

				<tr class='tr_celda_impar'>
					<td>
						<label><strong>Ciudad actual:&nbsp;</strong></label><?php echo $arrayUsuario['ciudad_nombre']; ?><br>
						<?php

							if($arrayUsuario['usuario_hojadevida'] != ''){
								echo "<label><strong>Hoja de vida:&nbsp;</strong></label><?php echo <a href='#'>".$arrayUsuario['usuario_hojadevida']."</a> ?><br>";
							}

						?>
						
						<label><strong>Descripción:&nbsp;</strong></label><?php echo $arrayUsuario['usuario_descripcionperfil']; ?><br>
					</td>
				</tr>

			</tbody>
		</table>


		<br><br>

		<table class='t_visita' cellpadding = '18' cellspacing = '0'>
			<tr class='tr_celda_par'>
				<th class='b_visita'>Estudios </th>
			</tr>
			<tbody class='b_visita'>				
				<tr class='tr_celda_impar'>
					<td>

						<?php
							foreach ($arrayitemusuarioestudios as $posicion => $valor) {

								echo " 	<label><strong>Entidad:&nbsp;</strong></label>".$valor['iteusuest_entidad']." </br>
										<label><strong>Carrera::&nbsp;</strong></label>".$valor['iteusuest_carrera']."<br>
										<label><strong>Descripción:&nbsp;</strong></label>".$valor['iteusuest_descripcion']."<br><br> ";

							}
						?>
					
					</td>
				</tr>

			</tbody>
		</table>

		<br><br>

		<table class='t_visita' cellpadding = '18' cellspacing = '0'>
			<tr class='tr_celda_par'>
				<th class='b_visita'>Experiencia laboral </th>
			</tr>
			<tbody class='b_visita'>				
				<tr class='tr_celda_impar'>
					<td>

						<?php
							foreach ($arrayitemusuarioexperiencialaboral as $posicion => $valor) {

								echo " 	<label><strong>Entidad:&nbsp;</strong></label>".$valor['iteusuexplab_entidad']."</br>
										<label><strong>Tiempo laborado:&nbsp;</strong></label>".$valor['iteusuexplab_tiempolaborado']."<br>
										<label><strong>Ocupación:&nbsp;</strong></label>".$valor['iteusuexplab_ocupacion']."<br>
										<label><strong>Tareas:&nbsp;</strong></label>".$valor['iteusuexplab_tareas']."<br> <br>";

							}
						?>
						
					</td>
				</tr>

			</tbody>
		</table>

		<br><br>

		<table class='t_visita' cellpadding = '18' cellspacing = '0'>
			<tr class='tr_celda_par'>
				<th class='b_visita'>Habilidades </th>
			</tr>
			<tbody class='b_visita'>				
				<tr class='tr_celda_impar'>
					<td>

						<?php
							foreach ($arrayUsuarioitemusuariohabilidades as $posicion => $valor) {

								echo " 	<label><strong>Habilidad:&nbsp;</strong></label>".$valor['iteusuhab_habilidad']."</br>
										<label><strong>Descripción:&nbsp;</strong></label>".$valor['iteusuhab_descripcion']."<br><br>";

							}
						?>
						
					</td>
				</tr>
			</tbody>
		</table>


		<br><br>

		<table class='t_visita' cellpadding = '18' cellspacing = '0'>
			<tr class='tr_celda_par'>
				<th class='b_visita'>Logros </th>
			</tr>
			<tbody class='b_visita'>				
				<tr class='tr_celda_impar'>
					<td>

						<?php
							foreach ($arrayUsuarioitemusuariologros as $posicion => $valor) {

								echo " 	<label><strong>Logro:&nbsp;</strong></label>". $valor['iteusulog_logro']."</br>
										<label><strong>Descripción:&nbsp;</strong></label>".$valor['iteusulog_descripcion']."<br><br> ";

							}
						?>
						
					</td>
				</tr>

			</tbody>
		</table>

	</body>

</html>
