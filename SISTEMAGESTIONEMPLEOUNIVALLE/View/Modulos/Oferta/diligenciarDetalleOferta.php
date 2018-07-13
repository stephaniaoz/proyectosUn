<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbFacultadController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbItemofertaController.php");

$oferta_codigo = isset($_REQUEST['oferta_codigo'])?$_REQUEST['oferta_codigo']:'';

?>

<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<title></title>

</head>
	<body>

		<h3>FORMULARIO DETALLE OFERTA</h3>

		<form name="fromularioOferta" method="POST" action="../../../Controller/TbItemofertaController.php"> 
			<p>Codigo de oferta: <?php echo $oferta_codigo ?></p>
			Facultad código:
			<select name="s_facultad" required="required">
				<option value='0'>SELECCIONE UNO</option>
				<?php 
					$arrayFac = array();
					$objFac = new TbFacultadController();
					$arrayFac = $objFac->getListaFacultad();

					foreach ($arrayFac as $key => $value) {
						echo"<option value='".$value['facultad_codigo']."'>".$value['facultad_nombre']."</option>";
					}
				?>	
			</select>	

			<br><br>		
			Cantidad vacantes:<input type="text" name="iteofe_cantidadpersonas" value="" required="required">
			<br><br>
			Descripción:<textarea name="iteofe_descripcion" cols="50" rows="10" id="empresa_descripcionactividad" required="required"></textarea>
			<br><br>
			<input type="hidden" name="oferta_codigo" value="<?php echo $oferta_codigo ?>">
			<input type="hidden" name="modulo" value="detalleOferta">
			<input type="submit" value="Grabar">
		</form>

	</body>

</html>
