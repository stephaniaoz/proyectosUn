<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");

/**
* 
*/
class TbProgramacionacademica
{
	
	
	public function validaCampoCargue($campo_select, $tabla, $campo, $valor){


		$consulta = " 	SELECT CASE WHEN ".$campo_select."::text IS NULL THEN '0' ELSE ".$campo_select." END AS codigo 
						FROM ".$tabla." 
						WHERE ".$campo." = '".$valor."' ";

		$result = pg_query($consulta) or die('La consulta fallo: ' .$consulta. pg_last_error());

		echo $consulta."<br>";

		$arrayproaca = pg_fetch_assoc($result);

		$codigo = $arrayproaca['codigo'];

		if(is_null($codigo) || $codigo == ""){
			$codigo = '0';
		}

		return $codigo;

	}

	public function crearEncabezadoProgramacion($sede_codigo, $prosem_codigo, $proaca_observacion){

		$insert = "	INSERT INTO tb_programacionacademica (sede_codigo, prosem_codigo, proaca_observaciones) 
					VALUES (".$sede_codigo.",".$prosem_codigo.",'".$proaca_observacion."');";

		$resultInsert = pg_query($insert);

		return $resultInsert;

	}

	public function validaEncabezadoProgramacion($sede_codigo, $prosem_codigo){

		$consultaValidar = "	SELECT case when proaca_codigo is null then 0 else proaca_codigo end as proaca_codigo
								FROM tb_programacionacademica
								WHERE prosem_codigo ='".$prosem_codigo."' and sede_codigo =".$sede_codigo.";";

		$resultValidar= pg_query($consultaValidar);
		$arrayvalidacion = pg_fetch_assoc($resultValidar);
		$proaca_codigo = $arrayvalidacion['proaca_codigo'];

		if(is_null($proaca_codigo) || $proaca_codigo == ""){
			$proaca_codigo = 0;
		}

		return $proaca_codigo;

	}

	public function getProAcaActiva($proSemCodigoActivo){

		$consultaProAcaActiva = " SELECT proaca_codigo
									FROM tb_programacionacademica
									WHERE prosem_codigo = ".$proSemCodigoActivo.";";

		
		$resultProAcaActiva = pg_query($consultaProAcaActiva) or die('La consulta fallo: ' .$consulta. pg_last_error());

		return $resultProAcaActiva;

	}

}

?>