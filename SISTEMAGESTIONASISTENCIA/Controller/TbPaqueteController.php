<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbPaquete.php");

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';


}


class TbPaqueteController{


	private $arraylistapaquetes = array();

	public function vistaOpcionesMenu($nombre_perfil_ingreso){

		$objTbPaquete = new TbPaquete($nombre_perfil_ingreso);
		$result_listamenu = $objTbPaquete->getListaPaquete($nombre_perfil_ingreso);

		$count = 0;

		while ($arraylispaquete = pg_fetch_assoc($result_listamenu)) {
			$this->arraylistapaquetes[$count]['paquete_nombre']= $arraylispaquete['paquete_nombre'];
			$this->arraylistapaquetes[$count]['paquete_codigo']= $arraylispaquete['paquete_codigo'];
			$count++;
		}

		return $this->arraylistapaquetes;		

	}


}



?>