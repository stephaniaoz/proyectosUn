<?php

include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbEstado.php");

class TbEstadoController{


	private $arrayEstado = array();

	function __construct(){

	}

	/*Debuelve arreglo asociativo arrayEstado*/
	public function getListaEstadoPorModulo($modulo_codigo){

		$tbEstado = new TbEstado();

		$result = $tbEstado->resultEstadoPorModulo($modulo_codigo);
		
		$count = 0;

		while ($arrayEst = pg_fetch_assoc($result)) {
			$this->arrayEstado[$count]['estado_codigo'] = $arrayEst['estado_codigo'];
			$this->arrayEstado[$count]['estado_descripcion'] = $arrayEst['estado_descripcion'];
			$count++;
		}		

		return $this->arrayEstado;	

	}

}