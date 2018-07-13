<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbPais.php");

/*
$tbPais = new TbPais();
$result = $tbPais->resultPais();

$count = 0;
echo "<option value='0'>SELECCIONE UNO</option>";
while ($arrayDpto = pg_fetch_assoc($result)) {
	echo"<option value='".$arrayDpto['pais_codigo']."'>".$arrayDpto['pais_nombre']."</option> \n";
	$count++;
}		
*/

class TbPaisController{	

	private $arraySelectPais = array();

	function __construct(){

	}

	/*Debuelve arreglo asociativo arraySelectPais*/
	public function getListaUsuarioContacto(){

		$tbPais = new TbPais();

		$result = $tbPais->resultPais();
		
		$count = 0;

		while ($arrayPais = pg_fetch_assoc($result)) {
			$this->arraySelectPais[$count]['pais_codigo'] = $arrayPais['pais_codigo'];
			$this->arraySelectPais[$count]['pais_nombre'] = $arrayPais['pais_nombre'];

			$count++;
		}		

		return $this->arraySelectPais;	

	}


}

?>