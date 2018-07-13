<?php

include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbEntidadestudio.php");

class TbEntidadestudioController{


	private $arrayEntidadestudio = array();

	function __construct(){

	}

	/*Debuelve arreglo asociativo arrayEntidadestudio*/
	public function getListaEntidadEstdio(){

		$tbEntidadestudio = new TbEntidadestudio();

		$result = $tbEntidadestudio->resultEntidadestudio();
		
		$count = 0;

		while ($arrayEntEst = pg_fetch_assoc($result)) {
			$this->arrayEntidadestudio[$count]['entest_codigo'] = $arrayEntEst['entest_codigo'];
			$this->arrayEntidadestudio[$count]['entest_nombre'] = $arrayEntEst['entest_nombre'];
			$count++;
		}		

		return $this->arrayEntidadestudio;	

	}

}