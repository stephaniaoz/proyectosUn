<?php

include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbPerfil.php");

class TbPerfilController{


	private $arrayPerfil = array();

	function __construct(){

	}

	/*Debuelve arreglo asociativo arrayPerfil*/
	public function getListaPerfil(){

		$tbPerfil = new TbPerfil();

		$result = $tbPerfil->resultPerfil();
		
		$count = 0;

		while ($arrayPer = pg_fetch_assoc($result)) {
			$this->arrayPerfil[$count]['perfil_codigo'] = $arrayPer['perfil_codigo'];
			$this->arrayPerfil[$count]['perfil_descripcion'] = $arrayPer['perfil_descripcion'];
			$count++;
		}		

		return $this->arrayPerfil;	

	}
	/*Debuelve arreglo asociativo arrayPerfil*/
	public function getListaPerfilEmpresa(){

		$tbPerfil = new TbPerfil();

		$result = $tbPerfil->resultPerfilEmpresa();
		
		$count = 0;

		while ($arrayPer = pg_fetch_assoc($result)) {
			$this->arrayPerfil[$count]['perfil_codigo'] = $arrayPer['perfil_codigo'];
			$this->arrayPerfil[$count]['perfil_descripcion'] = $arrayPer['perfil_descripcion'];
			$count++;
		}		

		return $this->arrayPerfil;	

	}

}