<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


Class TbModulo{


	public function getListamodulo($paquete_codigo){

		$consulta_listamodulo = "	SELECT m.modulo_url, m.modulo_nombre
						   			FROM tb_modulo m
									WHERE m.paquete_codigo = ".$paquete_codigo.";";

		$resul_listamodulo = pg_query($consulta_listamodulo) or die('La consulta fallo: ' . pg_last_error());;
		
		return $resul_listamodulo;

	}

}

?>