<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbModulo.php");

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';


}


class TbModuloController{


	private $arraylistamodulos = array();

	public function vistaModulos($paquete_codigo){

		$objmodulo = new TbModulo();
		$resultmodulo = $objmodulo->getListamodulo($paquete_codigo);

		$count = 0;

		while ($arraymodulo = pg_fetch_assoc($resultmodulo)) {
			$this->arraylistamodulos[$count]['modulo_nombre']= $arraymodulo['modulo_nombre'];
			$this->arraylistamodulos[$count]['modulo_url']= $arraymodulo['modulo_url'];
			$count++;
		}

		return $this->arraylistamodulos;	

	}


}



?>