<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEstadoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbOfertaController.php");

$modulo_codigo = 3;


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
	<link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />

</head>
	<body>

		<?php
			if($_SESSION['perfil_descripcion'] == 'EMPRESA'){
		?>
				<h3>FORMULARIO CREACION OFERTA</h3>

				<form name="fromularioOferta" method="post" action="../../../Controller/TbOfertaController.php"> 
					Empresa que oferta:<input type="text" name="empresa_nombre" value="<?php echo $_SESSION['usuario_nombrecompleto']; ?>" disabled>
					<input type="hidden" name="empresa_codigo" value="<?php echo $_SESSION['usuario_codigo']; ?>">
					<br><br>
					Descripción oferta:
					<textarea name="oferta_descripcion" cols="50" rows="10" id="empresa_descripcionactividad"></textarea>
					<br><br>
					Estado:
					<select class="caja" name="s_estado" required="required">
						<option value='0'>SELECCIONE UNO</option>
						<?php 

							$arrayEstado = array();
							$objEstado = new TbEstadoController();
							$arrayEstado = $objEstado->getListaEstadoPorModulo(MOD_OFERTA);

							foreach ($arrayEstado as $key => $value) {
								echo"<option value='".$value['estado_codigo']."'>".$value['estado_descripcion']."</option>";
							}

						?>	
					</select>
					<br><br>
					<input type="hidden"  name="modulo" value="grabarOferta">
					<input type="submit" value="Grabar">
				</form>
		<?php		

			}
		?>

		<div class="fillformOferta">
			<table class='t_visita' cellpadding = '18' cellspacing = '0'>
				<?php
					$arrayOferta = array();
					$listaOferta = new TbOfertaController();

					$arrayOferta = $listaOferta->getListaOferta();

					echo "	<tr class='tr_celda_par'>
								<th class='b_visita'>Listado de ofertas <a class='button-link' href='../../Index.php'>cerrar_session</a></th>
							</tr>";

					$tipo_celda = 1;

					foreach ($arrayOferta as $posicion => $valor) {
						
						if($tipo_celda % 2 == 0){
							$estilo_celda = "tr_celda_par";
						}else{
							$estilo_celda = "tr_celda_impar";
						}

						echo "	<tbody class='b_visita'>	
									<tr class='".$estilo_celda." filausuario'>
										<td><label>Oferta código: ".$valor['oferta_codigo']."</label>
										<br>
										<label>Empresa interesada:</label>
										".$valor['empresa_razonsocial']."
										<br>
										<label>Descripción:</label> ".$valor['oferta_descripcion']."</td>
										<td><label>Estado de la oferta:</label> ".$valor['estado_descripcion']."</td>
										<td>
											 ";

										if($_SESSION['perfil_descripcion'] == 'CONTACTO'){
											echo " <a class='button-link' href='AplicarOferta.php?empresa_codigo=".$valor['empresa_codigo']."' target='_blank'>Aplicar oferta</a> ";
										}

										if(in_array($_SESSION['perfil_descripcion'], array('ADMINISTRADOR','EMPRESA'))){
											echo "	<a class='button-link' href='diligenciarDetalleOferta.php?empresa_codigo=".$valor['empresa_codigo']."&oferta_codigo=".$valor['oferta_codigo']."' target='_blank'>Detalles</a>
											<a class='button-link' href='#'>Cerrar oferta</a> ";
										}
										
									echo "
										</td>
									</tr>
								</tbody>";

						$tipo_celda++;

					}
				?>
			</table>

	</body>

</html>


