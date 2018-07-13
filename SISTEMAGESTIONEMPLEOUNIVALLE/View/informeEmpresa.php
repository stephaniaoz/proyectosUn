<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEmpresaController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbTipoDocumentoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbPaisController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbDepartamentoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbCiudadController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbPerfilController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEstadoController.php");

?>

<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	<script type="text/javascript">
		
	</script>

</head>
	<body>

		<div class="fillformUsuario">
			<table class='t_visita' cellpadding = '18' cellspacing = '0'>
				<?php
					$arrayEmpresa = array();
					$listaEmpresa = new TbEmpresaController();

					$arrayEmpresa = $listaEmpresa->getListaEmpresa();

					echo "	<tr class='tr_celda_par'>
								<th class='b_visita'>Listado de empresa</th>
							</tr>";

					$tipo_celda = 1;

					foreach ($arrayEmpresa as $posicion => $valor) {
						
						if($tipo_celda % 2 == 0){
							$estilo_celda = "tr_celda_par";
						}else{
							$estilo_celda = "tr_celda_impar";
						}

						echo "	<tbody class='b_visita'>	
									<tr class='".$estilo_celda." filausuario'>
										<td><label>".$valor['empresa_razonsocial']."</label>
										<br>
										<label>Número camara y comercio:</label>
										".$valor['empresa_numerocamaracomercio']."
										<br>
										<label>Descripción:</label> ".$valor['empresa_descripcionactividad']."</td>

									</tr>
								</tbody>";

						$tipo_celda++;

					}
				?>
			</table>

	</body>

</html>

  