<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbSede.php");

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';


}


class TbSedeController{

	private $arrayListSede = array();

	public function listarSedes(){

		$objtTbSede = new TbSede();
		$resultSede = $objtTbSede -> getSede();

		$count = 0;

		while($arraySede = pg_fetch_assoc($resultSede)){

			$this->arrayListSede[$count]['sede_codigo'] = $arraySede['sede_codigo'];
			$this->arrayListSede[$count]['sede_nombre'] = $arraySede['sede_nombre'];

			$count++;

		}

		return $this->arrayListSede;


	}

	


}



?>