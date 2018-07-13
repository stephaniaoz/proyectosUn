<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbFacultad.php");


class TbFacultadController{

	private $arrayFacultad = array();

	function __construct(){

	}

	/*Debuelve arreglo asociativo arrayFacultad*/

	public function getListaFacultad(){

		$tbFacultad = new TbFacultad();

		$result = $tbFacultad->resultFacultad();
		
		$count = 0;

		while ($arrayFa = pg_fetch_assoc($result)) {
			$this->arrayFacultad[$count]['facultad_codigo'] = $arrayFa['estado_codigo'];
			$this->arrayFacultad[$count]['facultad_nombre'] = $arrayFa['facultad_nombre'];
			$count++;
		}		

		return $this->arrayFacultad;	

	}
	

}

?>