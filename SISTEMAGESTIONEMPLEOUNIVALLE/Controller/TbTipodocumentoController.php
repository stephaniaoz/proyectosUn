<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbTipoDocumento.php");

class TbTipoDocumentoController{


	private $arrayTipoDocumento = array();


	function __construct(){

	}


	/*Debuelve arreglo asociativo arrayTipoDocumento*/
	public function getListaTipoDocumento(){

		$tbTipoDocumento = new TbTipoDocumento();

		$result = $tbTipoDocumento->resultTipoDocumento();
		
		$count = 0;

		while ($arrayTipoDoc = pg_fetch_assoc($result)) {
			$this->arrayTipoDocumento[$count]['tipdoc_codigo'] = $arrayTipoDoc['tipdoc_codigo'];
			$this->arrayTipoDocumento[$count]['tipdoc_descripcion'] = $arrayTipoDoc['tipdoc_descripcion'];
			$count++;
		}		
		
		return $this->arrayTipoDocumento;	

	}

}

?>	