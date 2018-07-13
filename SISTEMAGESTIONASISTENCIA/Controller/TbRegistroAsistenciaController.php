<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbRegistroAsistencia.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbItemProgramacionSemanaController.php");

if($_REQUEST){

	$modulo = isset($_POST['modulo'])?$_POST['modulo']:'';
	$componente = isset($_REQUEST['componente'])?$_REQUEST['componente']:'';

	if($modulo == "registrar_asistencia"){

		$arrayRegAsis = array();

	 	$count = isset($_POST['cantIteProaca'])?$_POST['cantIteProaca']:0;

		 for($i = 0; $i<$count; $i++){

		 	$arrayRegAsis[$i]["itProAca"] = $_POST['itProAca'.$i];
		 	$arrayRegAsis[$i]["asig"] = $_POST['asig'.$i];
		 	$arrayRegAsis[$i]["area_tema"] = $_POST['area_tema'.$i];
		 	$arrayRegAsis[$i]["area_observacion"] = $_POST['area_observacion'.$i];

		}

		$objtTbRegAsisC = new TbRegistroAsistenciaController();
		$objtTbRegAsisC -> registrarAsistencia($arrayRegAsis);
		//print_r($arrayRegAsis);		
				
	}

	


}


class TbRegistroAsistenciaController{

	public function registrarAsistencia($arrayRegAsis){
		
		$bandera = false;
		$mensaje = '';
		$fecha = date("Y-m-d");

		$objtTbRegAsisM = new TbRegistroAsistencia();
		
		
		for($i = 0; $i<count($arrayRegAsis); $i++){

			$arrayRegAsis[$i]['codigoItemProSem'] = $this -> obtenerCodigoItemProSema($arrayRegAsis[$i]['itProAca'], $fecha);
			$arrayRegAsis[$i]['cantMinutos'] = $this -> obtenerIntesidadHoraria($arrayRegAsis[$i]['itProAca']);
			$arrayRegAsis[$i]['fechaCreacion'] = $fecha;

			$arrayRegAsis[$i]['estado_codigo'] = 1;

			$res = $objtTbRegAsisM ->setRegistrarAsistencia($arrayRegAsis[$i]);

			if($res){
				$bandera = false;
			}else{

				$bandera = true;
				$mensaje = "Upppss!! Error";
				break;

			}

		}

		if ($bandera) {

			echo $mensaje;

		}else{

			echo "Ingreso Exitoso";
		}

		//print_r($arrayRegAsis);
	}

	public function obtenerCodigoItemProSema($itProAca, $fecha){

		$objtIteProSemC = new TbItemProgramacionSemanaController();
		$codigoIteProSem = $objtIteProSemC -> obtenerCodigoIteProSem($itProAca, $fecha);

		return $codigoIteProSem; 

	}

	public function obtenerIntesidadHoraria($itProAca){

		$objtIteProSemC = new TbItemProgramacionSemanaController();
		$rangoHoras = $objtIteProSemC -> obtenerRangoHoraIteProaca($itProAca);

		$horaInicial = $rangoHoras[0]['iteproaca_horainicio'];
		$horaFinal = $rangoHoras[0]['iteproaca_horafinal'];

		$dif = date("H:i:s", strtotime("00:00:00") + strtotime($horaFinal) - strtotime($horaInicial) );

		list($horas, $minutos, $segundos) = explode(':', $dif);
		$hora_en_minutos = ($horas * 60 ) + $minutos + ($segundos / 60);

		return $hora_en_minutos;

	}

	

	public function listaRegistroAsistenciaDocente($usuario_identificacion, $proAcaCodigoActivado){

		$arrayRegistroAsistenciaUsu = array();

		$objtTbRegAsisM = new TbRegistroAsistencia();
		$resultRegAsiActivoUsu = $objtTbRegAsisM  -> getRegistroAsistenciaDocente($usuario_identificacion, $proAcaCodigoActivado);

		$count = 0;

		while ($arrayRegAsi = pg_fetch_assoc($resultRegAsiActivoUsu)) {

			$arrayRegistroAsistenciaUsu[$count]['regasi_cantidadhoras']= $arrayRegAsi['regasi_cantidadhoras'];
			$arrayRegistroAsistenciaUsu[$count]['iteprosem_codigo']= $arrayRegAsi['iteprosem_codigo'];
			/*$arrayRegistroAsistenciaUsu[$count]['']= $arrayRegAsi[''];*/
					
			$count++;
		}

		return $arrayRegistroAsistenciaUsu;


	}

	
}



?>