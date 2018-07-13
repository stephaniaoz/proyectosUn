<?php

include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbTipoformacion{

	private $tipfor_codigo; 
    private $tipfor_descripcion; 
    private $tipfor_fechacreacion; 
    private $tipfor_fechamodificacion;

	function __construct(){

	}

	public function resultTipoFormacion(){

		$query = " 	SELECT t.tipfor_codigo, t.tipfor_descripcion
					FROM tb_tipoformacion t ";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}

    public function getTipfor_codigo() {
        return $tipfor_codigo;
    }

    public function getTipfor_descripcion() {
        return $tipfor_descripcion;
    }

    public function getTipfor_fechacreacion() {
        return $tipfor_fechacreacion;
    }

    public function getTipfor_fechamodificacion() {
        return $tipfor_fechamodificacion;
    }

    public function setTipfor_codigo($tipfor_codigo) {
        $this->tipfor_codigo = $tipfor_codigo;
    }

    public function setTipfor_descripcion($tipfor_descripcion) {
        $this->tipfor_descripcion = $tipfor_descripcion;
    }

    public function setTipfor_fechacreacion($tipfor_fechacreacion) {
        $this->tipfor_fechacreacion = $tipfor_fechacreacion;
    }

    public function setTipfor_fechamodificacion($tipfor_fechamodificacion) {
        $this->tipfor_fechamodificacion = $tipfor_fechamodificacion;
    }
}	