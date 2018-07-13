<?php

include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbTipoformacion.php");

class TbTipoformacionController{


	private $arrayTipoFormacion = array();

	function __construct(){

	}


	/*Debuelve arreglo asociativo arrayTipoFormacion*/
	public function getListaTipoFormacion(){

		$tbTipoformacion = new TbTipoformacion();

		$result = $tbTipoformacion->resultTipoFormacion();
		
		$count = 0;

		while ($arrayTipFor = pg_fetch_assoc($result)) {
			$this->arrayTipoFormacion[$count]['tipfor_codigo'] = $arrayTipFor['tipfor_codigo'];
			$this->arrayTipoFormacion[$count]['tipfor_descripcion'] = $arrayTipFor['tipfor_descripcion'];
			$count++;
		}		

		return $this->arrayTipoFormacion;	

	}

}	