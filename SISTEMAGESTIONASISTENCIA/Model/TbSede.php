<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


Class TbSede{


	public function getSede(){

		$consulta = " SELECT *
					  FROM tb_sede; ";

	  	$result = pg_query($consulta)or die('La consulta fallo: ' . pg_last_error());

	  	return $result;
	}


}

?>