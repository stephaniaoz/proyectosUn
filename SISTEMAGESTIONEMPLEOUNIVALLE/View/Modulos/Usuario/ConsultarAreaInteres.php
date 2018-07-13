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

$resultado = isset($_REQUEST['algo'])?$_REQUEST['algo']:'';

if(empty($_SESSION['usuario_codigo']) || empty($_SESSION['perfil_descripcion'])){
	header('Location: Index.php');
	die();
}


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

		<form name="form" method="POST" action="Resultadointeres.php">
			Programa academico:
			<select name="s_programaacademico">
				<option value='0'>SELECCIONE UNO</option>
				<?php 
					$arrayProgAca = array();
					$objProgAca = new TbProgramaacademicoController();
					$arrayProgAca = $objProgAca->getListaProgramaacademico();

					foreach ($arrayProgAca as $key => $value) {
						echo"<option value='".$value['proaca_codigo']."'>".$value['proaca_nombre']."</option>";
					}
				?>	
			</select>
			<input type="submit" value="Buscar">
		</form>

		<div class="fillformUsuario">
			<table class='t_visita' cellpadding = '18' cellspacing = '0'>
				<?php
					$arrayUsuContact = array();
					$listaUsuarioContacto = new TbUsuarioController();
					//se recorre arreglo de usuarios contacto
					$arrayUsuContact = $listaUsuarioContacto->getListaUsuario();

					echo "	<tr class='tr_celda_par'>
								<th class='b_visita'>Listado de contactos <a href='../../Index.php'>cerrar_session</a></th>
							</tr>";

					$tipo_celda = 1;

					foreach ($arrayUsuContact as $posicion => $valor) {
						
						if($tipo_celda % 2 == 0){
							$estilo_celda = "tr_celda_par";
						}else{
							$estilo_celda = "tr_celda_impar";
						}

						echo "	<tbody class='b_visita'>	
									<tr class='".$estilo_celda." filausuario'>
										<td><label>".$valor['usuario_nombres']." ".$valor['usuario_apellidos']."</label>
										<br>
										".$valor['entest_nombre']."
										<br>
										<label>Titulo otorgado:</label> ".$valor['usuario_titulootorgado']."</td>
										<br>
										<td><label>Perfil:</label> ".$valor['perfil_descripcion']."</td>
										<td>
											<a href='DetalleUsuario.php?usuario_codigo=".$valor['usuario_codigo']."&nombre=".$valor['usuario_nombres']."' target='_blank'>Detalles</a> ";


								if(in_array($_SESSION['perfil_descripcion'], array('ADMINISTRADOR','SUPERVISOR'))){

								
									echo "	<a href='UpdateUsuario.php?usuario_codigo=".$valor['usuario_codigo']."' target='_blank'>Modificar</a> ";

									if($_SESSION['perfil_descripcion'] == 'ADMINISTRADOR'){
										echo "	<a href='javascript:deleteUser(".$valor['usuario_codigo'].")' target='_blank'>Eliminar</a>";
									}								

								}

								echo "		
										</td>
									</tr>
								</tbody>";

						$tipo_celda++;

					}
				?>
			</table>
		</div>

	</body>

</html>
