<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbCiudad.php");

$id_dpto = isset($_REQUEST['id_dpto'])?$_REQUEST['id_dpto']:0;

$tbCiudad = new TbCiudadController();
$tbCiudad->getListaVarCiudadPorDpto($id_dpto);


class TbCiudadController{

	private $arrayCiudadDpto = array();

	function __construct(){

	}

	/*Debuelve arreglo asociativo arrayCiudadDpto*/
	public function getListaCiudad(){

		$tbCiudad = new TbCiudad();

		$result = $tbCiudad->resultCiudad();
		
		$count = 0;

		while ($arrayCiudad = pg_fetch_assoc($result)) {
			$this->arrayCiudadDpto[$count]['ciudad_codigo'] = $arrayCiudad['ciudad_codigo'];
			$this->arrayCiudadDpto[$count]['ciudad_nombre'] = $arrayCiudad['ciudad_nombre'];
			$count++;
		}		

		return $this->arrayCiudadDpto;	

	}

	public function getListaVarCiudadPorDpto($id_dpto){
		
		if($id_dpto != 0){

			$tbCiudad = new TbCiudad();

			$result = $tbCiudad->resultCiudadPorDpto($id_dpto);

			echo "<option value='0'>SELECCIONE UNO</option>";
			while ($arrayCiudad = pg_fetch_assoc($result)) {
				echo"<option value='".$arrayCiudad['ciudad_codigo']."'>".$arrayCiudad['ciudad_nombre']."</option> \n";
			}

		}

	}

	
}


?>