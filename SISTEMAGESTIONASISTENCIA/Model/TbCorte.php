<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


Class TbCorte{

	public function getCorte(){

		$consulta_corte = "SELECT * FROM tb_corte;";

		$result_corte = pg_query($consulta_corte);

		return $result_corte;

	}

	

}

?>