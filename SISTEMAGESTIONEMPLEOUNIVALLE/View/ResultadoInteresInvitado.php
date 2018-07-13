<?php 
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbUsuarioController.php");

$proaca_codigo = isset($_REQUEST['s_programaacademico'])?$_REQUEST['s_programaacademico']:0;


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
					$arrayUsuContact = $listaUsuarioContacto->getListaUsuarioContactoPorPrograma($proaca_codigo);

					if(count($arrayUsuContact) == 0){
						$mensaje = 'No se encontraron resultados';
						print "<script>alert('$mensaje')</script>";
					 	print("<script>window.location.replace('Index.php');</script>");
					}else{

						echo "	<tr class='tr_celda_par'>
								<th class='b_visita'>Listado de contactos</th>
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
