<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbCorte.php");

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';


}


class TbCorteController{

	private $arraylistacorte = array();

	public function listarCorte(){

		$objtTbCorte = new TbCorte();
		$resultlist = $objtTbCorte->getCorte();

		$count = 0;

		while($arraycorte = pg_fetch_assoc($resultlist)){
			$this->arraylistacorte[$count]['corte_codigo'] = $arraycorte['corte_codigo'];
			$this->arraylistacorte[$count]['corte_nombre'] = $arraycorte['corte_nombre'];
			$count++;
		}

		return $this->arraylistacorte;

	}



}



?>