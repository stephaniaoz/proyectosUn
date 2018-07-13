<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


Class TbProgramacionSemana{


	public function validarProgramacionSemana($anno, $corte){

		$consultaValidar = "	SELECT CASE WHEN 
						COUNT(*) > 0 THEN 'EXISTE' ELSE 'NO EXISTE' END AS validacion_programacionsemana
						FROM tb_programacionsemana 
						WHERE prosem_ano ='".$anno."' and corte_codigo =".$corte.";";

		$resultValidar= pg_query($consultaValidar);
		$arrayvalidacion = pg_fetch_assoc($resultValidar);
		$result_validacion = $arrayvalidacion['validacion_programacionsemana'];
		return $result_validacion;
	}

	public function insertProgramacionSemana($anno, $corte,$fechaInicial,$fechaFinal,$numSem){

		$insert = "INSERT INTO tb_programacionsemana (prosem_ano, corte_codigo, prosem_fechainicial, prosem_fechafinal, estado_codigo, prosem_numerosemanas) 
					VALUES ('".$anno."',".$corte.",'".$fechaInicial."','".$fechaFinal."',1,".$numSem.");";

		$resultInsert = pg_query($insert);

		return $resultInsert;
	}

	public function getProgramacionSemana($anno, $corte){

		$consultaprosem = "	SELECT * 
						FROM tb_programacionsemana
						WHERE prosem_ano ='".$anno."' and corte_codigo =".$corte.";";

		$resultprosem = pg_query($consultaprosem);

		return $resultprosem;

	}

	public function getAllProgramacionSemana(){

		$consultaProgramacionSemana = " SELECT p.prosem_codigo, p.prosem_ano, c.corte_nombre, p.prosem_fechainicial, p.prosem_fechafinal, p.prosem_numerosemanas, e.estado_nombre
					 					FROM tb_programacionsemana p
					 					JOIN tb_corte c ON c.corte_codigo = p.corte_codigo 
					 					JOIN tb_estado e ON e.estado_codigo = p.estado_codigo; ";

		$resultProgramacionSemana = pg_query($consultaProgramacionSemana) or die('La consulta fallo: ' . pg_last_error());

		return $resultProgramacionSemana;
	}

	public function update_EstadoProSem(){

		$updateProSem = " UPDATE tb_programacionsemana 
							SET estado_codigo = 2  
							WHERE estado_codigo = 1 ;";

		
		$resultUpdate = pg_query($updateProSem) or die('La consulta fallo: ' . pg_last_error());
		return $resultUpdate;

	}

	public function get_ProSemCodigoActiva(){

		$consultaProSemCodigoActivo = "SELECT prosem_codigo
											FROM tb_programacionsemana 
											WHERE estado_codigo = 1; ";

		$resultProSemCodigo = pg_query($consultaProSemCodigoActivo) or die ('La consulta fallo: ' . pg_last_error());

		return $resultProSemCodigo;
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