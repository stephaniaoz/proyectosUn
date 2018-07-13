<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbDepartamento.php");

$id_pais = isset($_REQUEST['id_pais'])?$_REQUEST['id_pais']:0;

$tbDepartamento = new TbDepartamentoController();
$tbDepartamento->getListaVarDepartamentoPorPais($id_pais);


class TbDepartamentoController{

	private $arrayDeptoPais = array();

	function __construct(){

	}

	/*Debuelve arreglo asociativo arrayDeptoPais*/
	public function getListaDepartamentoPorPais($pais){

		$tbDepartamento = new TbDepartamento();

		$result = $tbDepartamento->resultDepartamentoPorPais($pais);
		
		$count = 0;

		while ($arrayDpto = pg_fetch_assoc($result)) {
			$this->arrayDeptoPais[$count]['departamento_codigo'] = $arrayDpto['departamento_codigo'];
			$this->arrayDeptoPais[$count]['departamento_nombre'] = $arrayDpto['departamento_nombre'];
			$count++;
		}		

		return $this->arrayDeptoPais;	

	}

	public function getListaVarDepartamentoPorPais($id_pais){

		if($id_pais != 0){

			$tbDepartamento = new TbDepartamento();

			$result = $tbDepartamento->resultDepartamentoPorPais($id_pais);

			echo "<option value='0'>SELECCIONE UNO</option>";
			while ($arrayDpto = pg_fetch_assoc($result)) {
				echo"<option value='".$arrayDpto['departamento_codigo']."'>".$arrayDpto['departamento_nombre']."</option> \n";
			}

		}		

	}

	
}

?>