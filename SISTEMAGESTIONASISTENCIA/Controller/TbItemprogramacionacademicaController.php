<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbItemprogramacionacademica.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbProgramacionSemanaController.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbProgramacionacademicaController.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbItemProgramacionSemanaController.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbRegistroAsistenciaController.php");



if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';

	$componente = isset($_REQUEST['componente'])?$_REQUEST['componente']:'';
	$usuario_codigo = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:'';

	if($modulo == 'cargar_programacion'){

		if ($componente == 'cargaselectprogramacion') {
			$fechaproaca = isset($_REQUEST['fechaproaca'])?$_REQUEST['fechaproaca']:'';

			$obj = new TbItemprogramacionacademicaController();
			$obj->getSelectProgramacion(trim($fechaproaca), $usuario_codigo);
			
		}	

	}

	if($modulo == "listarInforme"){

		if($componente == 'infHorasTrabajas') {

			//echo "ENTRO";
			$usuario_identificacion =  isset($_REQUEST['usuario_identificacion'])?$_REQUEST['usuario_identificacion']:'';
			
			$objtTbItProAcaC = new TbItemprogramacionacademicaController();
			$objtTbItProAcaC -> listarInformeHoraTrabajadasDocente($usuario_identificacion);
		}


	}


	/*if($modulo == 'listarAsistencia'){

		$arregloAsistencia = isset($_REQUEST['registroasistencia'])?$_REQUEST['registroasistencia']:'';


		//print_r($arregloAsistencia);
		//die();
		/*if($arregloAsistencia != ''){
			echo "<pre>";
			print_r($_REQUEST['registroasistencia']);
			$_SESSION['checkproaca'] = $_REQUEST['registroasistencia'];


			$mensaje = "otroooo";
			print "<script>alert('$mensaje')</script>";
	 		print("<script>window.location.replace('../View/control_asistencia/registrarAsistencia.php');</script>");
		}
		if($arregloAsistencia != ''){
			//echo "<pre>";
			//print_r($_REQUEST['registroasistencia']);
			$_SESSION['checkproaca'] = $_REQUEST['registroasistencia'];


			//$mensaje = "otroooo";
			//print "<script>alert('$mensaje')</script>";
	 		print("<script>window.location.replace('../View/control_asistencia/listarAsistencia.php');</script>");
		}
		
	}*/

}

/**
* 
*/
class TbItemprogramacionacademicaController
{

	
	private $arrayProgramacionAcademica = array();
	private $arraySelectAcademica = array();

	public function getSelectProgramacion($fechaproaca, $usuario_codigo){

		$cadena = "";
		$lista = "<option value='0'>Seleccione uno</option>";
		$obj = new TbItemprogramacionacademica();
		$result = $obj->getProgramacion($fechaproaca, $usuario_codigo);

		$count = 0;

		while ($arrayProgram = pg_fetch_assoc($result)) {			
			$this->arraySelectAcademica[$count]= $arrayProgram['iteproaca_codigo'];
			$this->arraySelectAcademica[$count]= $arrayProgram['jornada_nombre'];
			$this->arraySelectAcademica[$count]= $arrayProgram['iteproaca_diasemana'];
			$this->arraySelectAcademica[$count]= $arrayProgram['iteproaca_grupo'];
			$this->arraySelectAcademica[$count]= $arrayProgram['proaca_codigoprograma'];
			$this->arraySelectAcademica[$count]= $arrayProgram['proaca_nombre'];
			$this->arraySelectAcademica[$count]= $arrayProgram['asignatura_nombre'];
			$this->arraySelectAcademica[$count]= $arrayProgram['salon_nombre'];
			$this->arraySelectAcademica[$count]= $arrayProgram['usuario_identificacion'];

			$cadena = $arrayProgram['proaca_codigoprograma']." - ".$arrayProgram['proaca_nombre']." - ".$arrayProgram['asignatura_nombre'].", GRUPO ".$arrayProgram['iteproaca_grupo']." - ".$arrayProgram['iteproaca_diasemana']." - ".$arrayProgram['jornada_nombre']." - ".$arrayProgram['salon_nombre'];

			$lista .= "<option value='".$arrayProgram['iteproaca_codigo']."'>".$cadena."</option>";
			
			$count++;
		}

		echo $lista;

	}



	/*Debuelve arreglo asociativo arrayUsuarioContacto*/
	public function getListaProgramacion($usuario_codigo){

		$fecha = date("y-m-d");
		$fechaSem = strtotime($fecha);
		$diaSem = "";

		switch (date('N',($fechaSem))) {

			case 1:
				$diaSem = "LUNES";
				break;
			
			case 2:
				$diaSem = "MARTES";
				break;
			
			case 3:
				$diaSem = "MIERCOLES";
				break;
			
			case 4:
				$diaSem = "JUEVES";
				break;
			
			case 5:
				$diaSem = "VIERNES";
				break;
			
			case 6:
				$diaSem = "SABADO";
				break;
			
			case 7:
				$diaSem = "DOMINGO";
				break;
		}

		$objtProSemCon = new TbProgramacionSemanaController();
		$proSemCodigoActivo = $objtProSemCon->buscarProgramacionSemanaActiva();

		$objtProAca = new TbProgramacionacademicaController();
		$proAcaCodigoActivado = $objtProAca -> getcodigoProAcaActiva($proSemCodigoActivo);

		if(empty($proAcaCodigoActivado)){
				return $this->arrayProgramacionAcademica;
		}else{
			
			$iteproaca = new TbItemprogramacionacademica();
			$result = $iteproaca->resultPorgramacionAcademica($usuario_codigo, $diaSem,$proAcaCodigoActivado);
			
			$count = 0;

			while ($arrayProgramacion = pg_fetch_assoc($result)) {
				$this->arrayProgramacionAcademica[$count]['asignatura_codigoasignatura'] = $arrayProgramacion['asignatura_codigoasignatura']."-".$arrayProgramacion['asignatura_nombre'];
				$this->arrayProgramacionAcademica[$count]['usuario_identificacion'] = $arrayProgramacion['usuario_identificacion'];
				$this->arrayProgramacionAcademica[$count]['iteproaca_diasemana'] = $arrayProgramacion['iteproaca_diasemana'];
				$this->arrayProgramacionAcademica[$count]['iteproaca_horainicio'] = $arrayProgramacion['iteproaca_horainicio'];
				$this->arrayProgramacionAcademica[$count]['iteproaca_horafinal'] = $arrayProgramacion['iteproaca_horafinal'];
				$this->arrayProgramacionAcademica[$count]['salon_nombre'] = $arrayProgramacion['salon_nombre'];
				$this->arrayProgramacionAcademica[$count]['iteproaca_grupo'] = $arrayProgramacion['iteproaca_grupo'];
				$this->arrayProgramacionAcademica[$count]['jornada_nombre'] = $arrayProgramacion['jornada_nombre'];
				$this->arrayProgramacionAcademica[$count]['proaca_codigoprograma'] = $arrayProgramacion['proaca_codigoprograma'];
				$this->arrayProgramacionAcademica[$count]['iteproaca_codigo'] = $arrayProgramacion['iteproaca_codigo'];
				$this->arrayProgramacionAcademica[$count]['chequeo'] = $arrayProgramacion['chequeo'];
				$count++;
			}

			return $this->arrayProgramacionAcademica;


		}

		
		//return $proSemCodigoActivo;

	}

	public function getListaRegistrarAsistencia($arrayLista){



	}

	public function listarInformeHoraTrabajadasDocente($usuario_identificacion){

		//echo $usuario_identificacion;

		$lista = "	<div class='table-responsive'>
						<table class='table table-striped'>
							<tr>
								<th>Nombre Semana</th>
								<th>Horas Acumuladas</th>
								<th>Horas Faltantes</th>
								<th>Horas Total Por Semana</th>								
							</tr>
					";

		$detalle = "";
		$final = "";

		$arrayInformeHorasTrabajadasUsu = array();

		$arrayReporteHoras  = array();
		$arrayAsignaturasDocente = array();
		$cantHorasSemana = 0;


		$objtProSemCon = new TbProgramacionSemanaController();
		$proSemCodigoActivo = $objtProSemCon->buscarProgramacionSemanaActiva();

		$objtProAca = new TbProgramacionacademicaController();
		$proAcaCodigoActivado = $objtProAca -> getcodigoProAcaActiva($proSemCodigoActivo);


		$iteproaca = new TbItemprogramacionacademica();

		$resultAsgProDoc= $iteproaca -> getAsignaturaProgramadaDocente($proAcaCodigoActivado, $usuario_identificacion);

		//echo $resultAsgProDoc;
		//die();
		$count = 0;

		while ($arrayAsigDoc = pg_fetch_assoc($resultAsgProDoc)) {

			$arrayAsignaturasDocente[$count]['asignatura_codigoasignatura']= $arrayAsigDoc['asignatura_codigoasignatura'];
			$arrayAsignaturasDocente[$count]['asignatura_nombre']= $arrayAsigDoc['asignatura_nombre'];
			$arrayAsignaturasDocente[$count]['asignatura_intensidad']= $arrayAsigDoc['asignatura_intensidad'];
		
			$cantHorasSemana += $arrayAsigDoc['asignatura_intensidad'];
			$count++;
		}


		//echo $cantHorasSemana;
		//print_r( $arrayAsignaturasDocente);

		$objtItemProSemM = new TbItemProgramacionSemanaController();
		$arrayItemProgramacionSemanaActiva  = $objtItemProSemM  -> obtenerItemProgramacionSemanaActiva($proSemCodigoActivo);

		$objtRegAsisC = new TbRegistroAsistenciaController();

		$arrayRegistroAsistenciaUsu = $objtRegAsisC->listaRegistroAsistenciaDocente($usuario_identificacion,$proAcaCodigoActivado); 

		//print_r($arrayRegistroAsistenciaUsu);
		//print_r($arrayItemProgramacionSemanaActiva );

		$bandera = false;
		$horasTrabajadas = 0;

		for ($i=0; $i <count($arrayItemProgramacionSemanaActiva); $i++) { 
		
			$codigoSem = $arrayItemProgramacionSemanaActiva[$i]['iteprosem_codigo'];

			for ($a=0; $a <count($arrayRegistroAsistenciaUsu); $a++) { 
				
				if($codigoSem == $arrayRegistroAsistenciaUsu[$a]['iteprosem_codigo'] ){

					$horasTrabajadas += $arrayRegistroAsistenciaUsu[$a]['regasi_cantidadhoras'];

				}
				
			}

			$horasTrabajadasPorSemana = $horasTrabajadas/60;
			$horasFaltantePorSemana = $cantHorasSemana - $horasTrabajadasPorSemana ;

			$arrayInformeHorasTrabajadasUsu[$i]['nombre_semana'] = "SEMANA ".$i;
			$arrayInformeHorasTrabajadasUsu[$i]['horas_trabajadas'] = $horasTrabajadasPorSemana;

			$arrayInformeHorasTrabajadasUsu[$i]['horas_faltante'] = $horasFaltantePorSemana;
			$arrayInformeHorasTrabajadasUsu[$i]['horas_semana'] = $cantHorasSemana;

			$detalle .="<tr><td>".$arrayInformeHorasTrabajadasUsu[$i]['nombre_semana']."</td>";
			$detalle .="<td>".$arrayInformeHorasTrabajadasUsu[$i]['horas_trabajadas']."</td>";
			$detalle .="<td>".$arrayInformeHorasTrabajadasUsu[$i]['horas_faltante']."</td>";
			$detalle .="<td>".$arrayInformeHorasTrabajadasUsu[$i]['horas_semana']."</td><tr>";

			$horasTrabajadas = 0;
		}

		$final = "			
						</table>
					</div>";

		$cadenacompleta = $lista.$detalle.$final;
		//echo $cantHorasSemana;
		//echo "HOLA";
		echo $cadenacompleta;
		/*if(empty($arrayRegistroAsistenciaUsu)){

		}else{

		}*/
		//print_r($arrayInformeHorasTrabajadasUsu);


	}


}

?>	