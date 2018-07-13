<?php

include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbProgramaacademico.php");

class TbProgramaacademicoController{


	private $arrayProgramaAcademico = array();

	function __construct(){

	}

	/*Debuelve arreglo asociativo arrayProgramaAcademico*/
	public function getListaProgramaacademico(){

		$tbProgramaacademico = new TbProgramaacademico();

		$result = $tbProgramaacademico->resultProgramaacademico();
		
		$count = 0;

		while ($arrayProg = pg_fetch_assoc($result)) {
			$this->arrayProgramaAcademico[$count]['proaca_codigo'] = $arrayProg['proaca_codigo'];
			$this->arrayProgramaAcademico[$count]['proaca_nombre'] = $arrayProg['proaca_nombre'];
			$count++;
		}		

		return $this->arrayProgramaAcademico;	

	}



}	