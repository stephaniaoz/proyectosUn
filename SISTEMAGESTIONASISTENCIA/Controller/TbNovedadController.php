<?php
include("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbUsuario.php");
include("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbNovedad.php");
include("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbItemnovedadsolicitudrecuperacion.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\View\utilities\utilities.php");
include("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbSalon.php");



if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';
	$componente = isset($_REQUEST['componente'])?$_REQUEST['componente']:'';
	$usuario_codigo = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:'';

	if($modulo == 'informes'){		

		if($componente == 'listanovdificultades') {
			$obj = new TbNovedadController();
			$obj->listaNovedadDificultades($usuario_codigo);
		}

	}

	if($modulo == 'registrar_novedad'){		

		if($componente == 'listarnovedades') {
			$obj = new TbNovedadController();
			$obj->listaNovedad($usuario_codigo);
		}

	}

	if($modulo == 'autorizarNovedad'){		

		if($componente == 'listarnovedadesFalta') {
			$obj = new TbNovedadController();
			$obj->listaNovedadFaltaAsistencia();
		}

		if($componente == 'listaOtroNovedad') {
			$obj = new TbNovedadController();
			$obj->listaNovedadOtro();
		}

		if($componente == 'updateEstadoFalta') {

			$arrayautorizacionfalta = isset($_REQUEST['arrayautorizacionfalta'])?$_REQUEST['arrayautorizacionfalta']:'';

			if($arrayautorizacionfalta != ''){
				$obj = new TbNovedadController();
				$obj->updateNovedadAutorizaFalta($arrayautorizacionfalta);
			}else{
				echo  "<div class='alert alert-warning'>
					  	<strong>Warning! </strong>No ha seleccionado ningún registro.
					</div>";
			}

			
		}

		if($componente == 'updateEstadoOtro') {

			$arrayautorizacionfalta = isset($_REQUEST['arrayautorizacionfalta'])?$_REQUEST['arrayautorizacionfalta']:'';

			if($arrayautorizacionfalta != ''){

				$obj = new TbNovedadController();
				$obj->updateNovedadAutorizaOtro($arrayautorizacionfalta);

			}else{
				echo  "<div class='alert alert-warning'>
					  	<strong>Warning! </strong>No ha seleccionado ningún registro.
					</div>";
			}	
		}

	}

	if($modulo == 'registrar_novedad1'){

		if($componente == 'grabar_novedad'){
			
			unset($_SESSION['alerta']);
			$tipnov_codigo = isset($_REQUEST['tipnov_codigo'])?$_REQUEST['tipnov_codigo']:'';
			$novedad_fecha = isset($_REQUEST['novedad_fecha'])?$_REQUEST['novedad_fecha']:'';
			$novedad_observaciondificultad = isset($_REQUEST['novedad_observaciondificultad'])?$_REQUEST['novedad_observaciondificultad']:'';
			$iteproaca_codigo = isset($_REQUEST['iteproaca_codigo'])?$_REQUEST['iteproaca_codigo']:'';
			$recuperacion = isset($_REQUEST['recuperacion'])?$_REQUEST['recuperacion']:'';

			if($recuperacion == 'OK'){
				$itenovsolrec_fechasolicitud = isset($_REQUEST['itenovsolrec_fechasolicitud'])?$_REQUEST['itenovsolrec_fechasolicitud']:'';
				$itenovsolrec_horainicioclase = isset($_REQUEST['itenovsolrec_horainicioclase'])?$_REQUEST['itenovsolrec_horainicioclase']:'';
				$itenovsolrec_horafinclase = isset($_REQUEST['itenovsolrec_horafinclase'])?$_REQUEST['itenovsolrec_horafinclase']:'';	

			}

			$obj = new TbNovedadController();
			$obj->grabarNovedad($tipnov_codigo, $novedad_fecha, $novedad_observaciondificultad, $iteproaca_codigo, $usuario_codigo, $recuperacion, $itenovsolrec_fechasolicitud, $itenovsolrec_horainicioclase, $itenovsolrec_horafinclase);	
			//$obj->grabarSolicitudRecuperacion($itenovsolrec_fechasolicitud, $itenovsolrec_horainicioclase, $itenovsolrec_horafinclase, $usuario_codigo);	
			

		}		

	}

}

/**
* 
*/
class TbNovedadController
{

	private $arrayUsuarioPerfil = array();
	private $arrayUsuarioCarrera =array();
	private $arrayListaMenu = array();

	function listaNovedad($usuario_codigo){

		$lista = "	<div class='table-responsive'>
						<table class='table table-striped'>
							<tr>
								<th>Tipo de novedad</th>
								<th>Novedad fecha</th>
								<th>Programación</th>
								<th>Novedad observación</th>								
								<th>Estado</th>
							</tr>
							";
		$detalle = "";
		$objTiponovedad = new TbNovedad();
		$resultTipoNov = $objTiponovedad->listaNovedad($usuario_codigo);


		$count = 0;

		while ($arrayTipNov = pg_fetch_assoc($resultTipoNov)) {

			$csalon = '';

			$this->arrayTipoNovedad[$count]= $arrayTipNov['tipnov_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['novedad_fecha'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['novedad_observaciondificultad'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['estado_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['programacion'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['salon_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['tipnov_codigo'];

			if($arrayTipNov['tipnov_codigo'] == 2 && $arrayTipNov['salon_nombre'] != ''){
				$csalon = " - ".$arrayTipNov['salon_nombre'];
			}

			$detalle .= "<tr><td>".$arrayTipNov['tipnov_nombre']."</td>";
			$detalle .= "<td>".$arrayTipNov['novedad_fecha']."</td>";
			$detalle .= "<td>".$arrayTipNov['programacion']."</td>";
			$detalle .= "<td>".$arrayTipNov['novedad_observaciondificultad']."</td>";
			$detalle .= "<td>".$arrayTipNov['estado_nombre'].$csalon."</td></tr>";

			$count++;
		}

		$final = "			
						</table>
					</div>";

		$cadenacompleta = $lista.$detalle.$final;

		if($count == 0){
			echo "<div class='alert alert-warning'>
					  	<strong>Warning! </strong>No existen novedades.
					</div>";
		}else{
			echo $cadenacompleta;
		}

		

	}

	function listaNovedadDificultades($usuario_codigo){

		$lista = "	<div class='table-responsive'>
						<table class='table table-striped'>
							<tr>
								<th>Tipo de novedad</th>
								<th>Novedad fecha</th>
								<th>Programación</th>
								<th>Novedad observación</th>								
								<th>Estado</th>
								<th>Identificación</th>
								<th>Nombre</th>
							</tr>
							";
		$detalle = "";
		$objTiponovedad = new TbNovedad();
		$resultTipoNov = $objTiponovedad->listaNovedadDificultades($usuario_codigo);


		$count = 0;

		while ($arrayTipNov = pg_fetch_assoc($resultTipoNov)) {

			$csalon = '';

			$this->arrayTipoNovedad[$count]= $arrayTipNov['tipnov_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['novedad_fecha'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['novedad_observaciondificultad'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['estado_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['programacion'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['salon_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['tipnov_codigo'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['usuario_identificacion'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['nombrecompleto'];

			if($arrayTipNov['tipnov_codigo'] == 2 && $arrayTipNov['salon_nombre'] != ''){
				$csalon = " - ".$arrayTipNov['salon_nombre'];
			}

			$detalle .= "<tr><td>".$arrayTipNov['tipnov_nombre']."</td>";
			$detalle .= "<td>".$arrayTipNov['novedad_fecha']."</td>";
			$detalle .= "<td>".$arrayTipNov['programacion']."</td>";
			$detalle .= "<td>".$arrayTipNov['novedad_observaciondificultad']."</td>";
			$detalle .= "<td>".$arrayTipNov['estado_nombre'].$csalon."</td>";
			$detalle .= "<td>".$arrayTipNov['usuario_identificacion'].$csalon."</td>";
			$detalle .= "<td>".$arrayTipNov['nombrecompleto'].$csalon."</td></tr>";

			$count++;
		}

		$final = "			
						</table>
					</div>";

		$cadenacompleta = $lista.$detalle.$final;

		if($count == 0){
			echo "<div class='alert alert-warning'>
					  	<strong>Warning! </strong>No existen novedades.
					</div>";
		}else{
			echo $cadenacompleta;
		}

		

	}

	function listaNovedadFaltaAsistencia(){

		$lista = "	<div class='table-responsive'>
						<table class='table table-striped'>
							<tr>
								<th>Tipo de novedad</th>
								<th>Novedad fecha</th>
								<th>Programación</th>
								<th>Novedad observación</th>								
								<th>Estado</th>
								<th>Identificación</th>
								<th>Nombre docente</th>
							</tr>
							";
		$detalle = "";
		$objTiponovedad = new TbNovedad();
		$resultTipoNov = $objTiponovedad->listaNovedadFalta();


		$count = 0;

		while ($arrayTipNov = pg_fetch_assoc($resultTipoNov)) {

			$csalon = '';

			$this->arrayTipoNovedad[$count]= $arrayTipNov['tipnov_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['novedad_fecha'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['novedad_observaciondificultad'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['estado_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['programacion'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['salon_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['tipnov_codigo'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['usuario_identificacion'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['nombrecompleto'];

			if($arrayTipNov['tipnov_codigo'] == 2 && $arrayTipNov['salon_nombre'] != ''){
				$csalon = " - ".$arrayTipNov['salon_nombre'];
			}

			$detalle .= "<tr><td>".$arrayTipNov['tipnov_nombre']."</td>";
			$detalle .= "<td>".$arrayTipNov['novedad_fecha']."</td>";
			$detalle .= "<td>".$arrayTipNov['programacion']."</td>";
			$detalle .= "<td>".$arrayTipNov['novedad_observaciondificultad']."";
			$detalle .= "<td>".$arrayTipNov['estado_nombre'].$csalon."</td>";
			$detalle .= "<td>".$arrayTipNov['usuario_identificacion']."</td>";
			$detalle .= "<td>".$arrayTipNov['nombrecompleto']."</td>";

			if($arrayTipNov['itenovsolrec_codigo'] != '' && $arrayTipNov['salon_nombre'] == ''){

				$detalle .= "<td><select type='text' name='corte' class='form-control' id='s_programacion".$arrayTipNov['novedad_codigo']."' required>";

				$counta = 0;

				$detalle .= "<option value='0'>Seleccione uno</option>";
				$salones = new TbSalon();
				$resultsalon = $salones->listaSalon();

				while ($arraysalones = pg_fetch_assoc($resultsalon)) {
					$detalle .= "<option value='".$arraysalones['salon_codigo']."'>".$arraysalones['salon_nombre']."</option>";
					$counta++;
				}

				$detalle .= "</select></td>";				

				$detalle .= "<td><input type='checkbox'name='novedadautorizacion[]' value = '".$arrayTipNov['novedad_codigo']."'></input></td></tr>";

			}

			$count++;
			
		}


		$final = "			
						</table>
					</div>";

		$cadenacompleta = $lista.$detalle.$final;

		if($count == 0){
			echo "<div class='alert alert-warning'>
					  	<strong>Warning! </strong>No existen novedades de falta de asistencia.
					</div>";
		}else{
			echo $cadenacompleta;
		}

	}

	function listaNovedadOtro(){

		$lista = "	<div class='table-responsive'>
						<table class='table table-striped'>
							<tr>
								<th>Tipo de novedad</th>
								<th>Novedad fecha</th>
								<th>Programación</th>
								<th>Novedad observación</th>								
								<th>Estado</th>
								<th>Identificación</th>
								<th>Nombre docente</th>
							</tr>
							";
		$detalle = "";
		$objTiponovedad = new TbNovedad();
		$resultTipoNov = $objTiponovedad->listaNovedadOtros();


		$count = 0;
		

		while ($arrayTipNov = pg_fetch_assoc($resultTipoNov)) {

			$csalon = '';

			$this->arrayTipoNovedad[$count]= $arrayTipNov['tipnov_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['novedad_fecha'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['novedad_observaciondificultad'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['estado_nombre'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['programacion'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['tipnov_codigo'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['usuario_identificacion'];
			$this->arrayTipoNovedad[$count]= $arrayTipNov['nombrecompleto'];

			if($arrayTipNov['tipnov_codigo'] == 2 && $arrayTipNov['salon_nombre'] != ''){
				$csalon = " - ".$arrayTipNov['salon_nombre'];
			}

			$detalle .= "<tr><td>".$arrayTipNov['tipnov_nombre']."</td>";
			$detalle .= "<td>".$arrayTipNov['novedad_fecha']."</td>";
			$detalle .= "<td>".$arrayTipNov['programacion']."</td>";
			$detalle .= "<td>".$arrayTipNov['novedad_observaciondificultad']."";
			$detalle .= "<td>".$arrayTipNov['estado_nombre'].$csalon."</td>";
			$detalle .= "<td>".$arrayTipNov['usuario_identificacion']."</td>";
			$detalle .= "<td>".$arrayTipNov['nombrecompleto']."</td>";

			if($arrayTipNov['estado_nombre'] == 'PENDIENTE'){
				$detalle .= "<td><input type='checkbox'name='novedadautorizacion[]' value = '".$arrayTipNov['novedad_codigo']."'></input></td></tr>";
			}

			$count++;
		}


		$final = "			
						</table>
					</div>";

		$cadenacompleta = $lista.$detalle.$final;

		if($count == 0){
			echo "<div class='alert alert-warning'>
					  	<strong>Warning! </strong>No existen novedades.
					</div>";
		}else{
			echo $cadenacompleta;
		}

	}

	function grabarNovedad($tipnov_codigo, $novedad_fecha, $novedad_observaciondificultad, $iteproaca_codigo, $usuario_codigo, $recuperacion, $itenovsolrec_fechasolicitud, $itenovsolrec_horainicioclase, $itenovsolrec_horafinclase){

		$objmod = new TbNovedad();
		$correcto = $objmod->setNovedad($tipnov_codigo, $novedad_fecha, $novedad_observaciondificultad, $iteproaca_codigo, $usuario_codigo);	
		

		if($correcto){

			if($recuperacion == 'OK'){
				$objmodd = new TbNovedad();
				$correcto2 = $objmodd->setSolicitudRecuperacion($itenovsolrec_fechasolicitud, $itenovsolrec_horainicioclase, $itenovsolrec_horafinclase, $usuario_codigo);
			}

			$_SESSION['alerta'] = "	<div class='alert alert-success'>
					  	<strong>Success! </strong>Se guardó la novedad correctamente.
					</div>";
		}else{
			$_SESSION['alerta'] = "	<div class='alert alert-danger'>
					  	<strong>Danger! </strong>La consulta falló, comunicarse con soporte, codigo 1.
					</div>";
		}

		if($correcto){
			echo "	<div class='alert alert-success'>
					  		<strong>Success! </strong>Se guardó la novedad correctamente.
						</div>";
		}else{
			echo "	<div class='alert alert-danger'>
					  		<strong>Danger! </strong>La consulta falló, comunicarse con soporte, codigo 1.
						</div>";
		}

		if($correcto2){
			$_SESSION['alerta'] = "	<div class='alert alert-success'>
					  	<strong>Success! </strong>Se guardó la novedad correctamente.
					</div>";
		}else{
			$_SESSION['alerta'] = "	<div class='alert alert-danger'>
					  	<strong>Danger! </strong>La consulta falló, comunicarse con soporte, codigo 1.
					</div>";
		}

		if($correcto2){
			echo "	<div class='alert alert-success'>
					  		<strong>Success! </strong>Se guardó la novedad correctamente.
						</div>";
		}else{
			echo "	<div class='alert alert-danger'>
					  		<strong>Danger! </strong>La consulta falló, comunicarse con soporte, codigo 1.
						</div>";
		}

	}

	function grabarSolicitudRecuperacion($itenovsolrec_fechasolicitud, $itenovsolrec_horainicioclase, $itenovsolrec_horafinclase, $usuario_codigo){

		$objmod = new TbNovedad();
		$correcto = $objmod->setSolicitudRecuperacion($tipnov_codigo, $novedad_fecha, $novedad_observaciondificultad, $iteproaca_codigo, $usuario_codigo);

		if($correcto){
			echo "	<div class='alert alert-success'>
					  		<strong>Success! </strong>Se guardó la solicitud correctamente.
						</div>";
		}else{
			echo "	<div class='alert alert-danger'>
					  		<strong>Danger! </strong>La consulta falló, comunicarse con soporte, codigo 2.
						</div>";
		}

	}

	function updateNovedadAutorizaFalta($arrayautorizacionfalta){

		for ($i=0; $i < count($arrayautorizacionfalta); $i++) {

			$arreglo = explode(',', $arrayautorizacionfalta[$i]);
			$novedad_codigo = $arreglo[0];
			$salon_codigo = $arreglo[1];

			$objsoli = new TbItemnovedadsolicitudrecuperacion();
			$correctos = $objsoli->updateItemRecuperacion($novedad_codigo, $salon_codigo);

			if($correctos){

				$objnove = new TbNovedad();
				$correcto = $objnove->updateEstadoRecuperacion($novedad_codigo, 4);

				if($correcto){

					echo "	<div class='alert alert-success'>
							  		<strong>Success! </strong>Se actualizó la solicitud correctamente.
								</div>";
				}else{
					echo "	<div class='alert alert-danger'>
							  		<strong>Danger! </strong>La consulta falló, comunicarse con soporte, codigo 3.
								</div>";
				}

			}else{
				echo "	<div class='alert alert-danger'>
						  		<strong>Danger! </strong>La consulta falló, comunicarse con soporte, codigo 4.
							</div>";
			}

		}

	}	

	function updateNovedadAutorizaOtro($arrayautorizacionfalta){

		for ($i=0; $i < count($arrayautorizacionfalta); $i++) {

			$novedad_codigo = $arrayautorizacionfalta[0];

			$objnove = new TbNovedad();
			$correcto = $objnove->updateEstadoRecuperacion($novedad_codigo, 5);

			if($correcto){

				echo "	<div class='alert alert-success'>
						  		<strong>Success! </strong>Se actualizó la solicitud correctamente.
							</div>";
			}else{
				echo "	<div class='alert alert-danger'>
						  		<strong>Danger! </strong>La consulta falló, comunicarse con soporte, codigo 3.
							</div>";
			}

		}

	}


}

?>