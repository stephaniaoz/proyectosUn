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

$iteentestsed_codigo = isset($_REQUEST['s_itementidadestudio'])?$_REQUEST['s_itementidadestudio']:0;
$ano = isset($_REQUEST['ano'])?$_REQUEST['ano']:'';
$mes = isset($_REQUEST['mes'])?$_REQUEST['mes']:'';


?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />

  	<script>

	</script>

  

</head>
	<body>

		<div class="fillformUsuario">
			<table class='t_visita' cellpadding = '18' cellspacing = '0'>
				<?php
					$arrayUsuContact = array();
					$listaUsuarioContacto = new TbUsuarioController();
					//se recorre arreglo de usuarios contacto
					$arrayUsuContact = $listaUsuarioContacto->getListaConsultaUsuario($iteentestsed_codigo, $ano, $mes);

					if(count($arrayUsuContact) == 0){
						$mensaje = 'No se encontraron resultados';
						print "<script>alert('$mensaje')</script>";
					 	print("<script>window.location.replace('InformeUsario.php');</script>");
					}else{

						echo "	<tr class='tr_celda_par'>
								<th class='b_visita'>Listado de contactos <a href='Index.php'>cerrar_session</a></th>
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
											</td>
										</tr>
									</tbody>";

							$tipo_celda++;

						}

					}

				?>
			</table>
		</div>

	</body>

</html>
