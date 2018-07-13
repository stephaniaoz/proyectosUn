<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbItemProgramacionSemana.php");

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';

}


class TbItemProgramacionSemanaController{

	public function guardarItemProSem($nombreSemana,$fechaInicialSemana,$fechaFinalSemana,$codigoEncabezado){

		$objtItemProSem = new TbItemProgramacionSemana();
		$result = $objtItemProSem->insertItemProSem($nombreSemana,$fechaInicialSemana,$fechaFinalSemana,$codigoEncabezado);

		return $result;

	}

	public function validarItemProSem($fechaInicial, $fechaFinal){

		$objtItemProSem = new TbItemProgramacionSemana();
		$resultValidarFechas = $objtItemProSem -> getValidarFechas($fechaInicial, $fechaFinal);

		$objtBdReg = pg_fetch_assoc($resultValidarFechas);
		
		$validacionFechas = $objtBdReg['validacion_fechas'];

		return $validacionFechas;
	}

	public function obtenerCodigoIteProSem($itProAca, $fecha){

		$arrayIteProSem = array();

		$objtItemProSem = new TbItemProgramacionSemana();
		$resultArrayIteProSem = $objtItemProSem -> getCodigoIteProSem($itProAca, $fecha);

		$count = 0;

		while($arrayIte = pg_fetch_assoc($resultArrayIteProSem)){

			$arrayIteProSem[$count]['codigoIteProSem'] = $arrayIte['iteprosem_codigo'];
			
			$count++;
		}

		return $arrayIteProSem[0]['codigoIteProSem'];

	}

	public function obtenerRangoHoraIteProaca($itProAca){

		$arrayRangoHora  = array();

		$objtItemProSem = new TbItemProgramacionSemana();
		$resultArrayRangoHora = $objtItemProSem -> getRangoHoraIteProSem($itProAca); 
		//$objtItemProSem -> getRangoHoraIteProSem($itProAca);

		$count = 0;

		while($arrayIteProSemRangoHora = pg_fetch_assoc($resultArrayRangoHora)){

			$arrayRangoHora[$count]['iteproaca_horainicio'] =$arrayIteProSemRangoHora['iteproaca_horainicio'];
			$arrayRangoHora[$count]['iteproaca_horafinal'] = $arrayIteProSemRangoHora['iteproaca_horafinal'];
			
			$count++;
		}

		return $arrayRangoHora;
	}

	public function getRangoFechaSemana(){

		$array = array();
		$obj = new TbItemProgramacionSemana();
		$result = $obj->getRangoFechas();

		while ($row = pg_fetch_row($result)) {
			$array[0] = $row[0]; 
			$array[1] = $row[1];
		}

		return $array;

	}

	public function obtenerItemProgramacionSemanaActiva($proSemCodigoActivo){

		$objtItemProSemM = new TbItemProgramacionSemana();
		$resultProSemActiva = $objtItemProSemM->getItemProSemActiva($proSemCodigoActivo);

		$arrayItemProgramacionSemanaActiva  = array();

		$count = 0;

		while($arrayIteProSemActiva = pg_fetch_assoc($resultProSemActiva)){

			$arrayItemProgramacionSemanaActiva[$count]['iteprosem_codigo'] =$arrayIteProSemActiva['iteprosem_codigo'];
			$arrayItemProgramacionSemanaActiva[$count]['iteprosem_nombre'] = $arrayIteProSemActiva['iteprosem_nombre'];
			
			$count++;
		}

		return $arrayItemProgramacionSemanaActiva; 

	}
	

}



?>