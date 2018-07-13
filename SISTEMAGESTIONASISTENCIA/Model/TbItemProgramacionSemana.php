<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


Class TbItemProgramacionSemana{

	public function insertItemProSem($nombreSemana,$fechaInicialSemana,$fechaFinalSemana,$codigoEncabezado){

		$insert = " INSERT INTO tb_itemprogramacionsemana (iteprosem_nombre,iteprosem_fechainicial,iteprosem_fechafinal,prosem_codigo)
					VALUES ('".$nombreSemana."','".$fechaInicialSemana."','".$fechaFinalSemana."',".$codigoEncabezado.");";

		$result = pg_query($insert) or die('Insert fallo: ' . pg_last_error());

		return $result;

	}

	public function getValidarFechas($fechaI, $fechaF){

		$consultaValidarFechas = "SELECT CASE WHEN
									COUNT(*) > 0 THEN 'EXISTE' ELSE 'NO EXISTE' END AS validacion_fechas
									FROM tb_itemprogramacionsemana
									WHERE iteprosem_fechainicial BETWEEN '".$fechaI."' AND '".$fechaF."' OR iteprosem_fechafinal BETWEEN '".$fechaI."' AND '".$fechaF."';";

		$resultValidarFechas = pg_query($consultaValidarFechas) or die('Consulta fallo: ' . pg_last_error());

		return $resultValidarFechas;

	}

	public function getItemProSemActiva($proSemCodigoActivo){

		$consulta_proSemActiva = "SELECT *
									FROM tb_itemprogramacionsemana
									WHERE prosem_codigo = ".$proSemCodigoActivo.";";

		$resultProSemActiva = pg_query($consulta_proSemActiva) or die('Consulta fallo: ' . pg_last_error());

		return $resultProSemActiva;							

	}

	public function getCodigoIteProSem($itProAca, $fecha){

		$consultaCodigoProSem ="SELECT i.* 
								  FROM tb_itemprogramacionacademica itp
								  JOIN tb_programacionacademica p ON p.proaca_codigo = itp.proaca_codigo
								  JOIN tb_itemprogramacionsemana i ON i.prosem_codigo = p.prosem_codigo
								  WHERE iteproaca_codigo = ".$itProAca." and '".$fecha."' between i.iteprosem_fechainicial and i.iteprosem_fechafinal ";

	  	$resultCodigoProSem = pg_query($consultaCodigoProSem) or die('Consulta fallo: '.pg_last_error());

	  	return $resultCodigoProSem;
	}

	public function getRangoHoraIteProSem($itProAca){

		$consultaRangoHoraIteProSem = "SELECT *
										FROM tb_itemprogramacionacademica
										WHERE iteproaca_codigo = ".$itProAca;

		$resultRangoHoraIteProSem = pg_query($consultaRangoHoraIteProSem) or die ('Consulta fallo'.pg_last_error());

		return $resultRangoHoraIteProSem;

	}

	public function getRangoFechas(){

		$consultaValidarFechas = " 	SELECT min(iteprosem_fechainicial), max(iteprosem_fechafinal)
									FROM tb_itemprogramacionsemana ip
									JOIN tb_programacionsemana p on p.prosem_codigo = ip.prosem_codigo
									WHERE p.estado_codigo = 1 ";

		$resultValidarFechas = pg_query($consultaValidarFechas) or die('Consulta fallo: ' . pg_last_error());

		return $resultValidarFechas;

	}


}

?>