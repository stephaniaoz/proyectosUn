<?php

include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbDepartamento{

	private $departamentoCodigo; 
    private $paisCodigo; 
    private $departamentoFechacreacion; 
    private $departamentoFechamodificacion; 
    private $departamentoNombre;

	function __construct(){

	}

	public function resultDepartamentoPorPais($paisCodigo){

		$query = " 	SELECT d.departamento_codigo, d.departamento_nombre 
					FROM tb_departamento d
					WHERE d.pais_codigo = ".$paisCodigo." ";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}

    public function getDepartamentoCodigo() {
        return $this->departamentoCodigo;
    }

    public function getPaisCodigo() {
        return $this->paisCodigo;
    }

    public function getDepartamentoFechacreacion() {
        return $this->departamentoFechacreacion;
    }

    public function getDepartamentoFechamodificacion() {
        return $this->departamentoFechamodificacion;
    }

    public function getDepartamentoNombre() {
        return $this->departamentoNombre;
    }

    public function setDepartamentoCodigo($departamentoCodigo) {
        $this->departamentoCodigo = $departamentoCodigo;
    }

    public function setPaisCodigo($paisCodigo) {
        $this->paisCodigo = $paisCodigo;
    }

    public function setDepartamentoFechacreacion($departamentoFechacreacion) {
        $this->departamentoFechacreacion = $departamentoFechacreacion;
    }

    public function setDepartamentoFechamodificacion($departamentoFechamodificacion) {
        $this->departamentoFechamodificacion = $departamentoFechamodificacion;
    }

    public function setDepartamentoNombre($departamentoNombre) {
        $this->departamentoNombre = $departamentoNombre;
    }
	
}

?>