<?php

include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbEntidadestudio{

	private $entest_codigo; 
    private $entest_nombre; 
    private $entest_fechacreacion; 
    private $entest_fechamodificacion;

	function __construct(){

	}

	public function resultEntidadestudio(){

		$query = " 	SELECT e.entest_codigo, e.entest_nombre
					FROM tb_entidadestudio e 
					ORDER BY e.entest_nombre ";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}

    public function getEntest_codigo() {
        return $entest_codigo;
    }

    public function getEntest_nombre() {
        return $entest_nombre;
    }

    public function getEntest_fechacreacion() {
        return $entest_fechacreacion;
    }

    public function getEntest_fechamodificacion() {
        return $entest_fechamodificacion;
    }

    public function setEntest_codigo($entest_codigo) {
        $this->entest_codigo = $entest_codigo;
    }

    public function setEntest_nombre($entest_nombre) {
        $this->entest_nombre = $entest_nombre;
    }

    public function setEntest_fechacreacion($entest_fechacreacion) {
        $this->entest_fechacreacion = $entest_fechacreacion;
    }

    public function setEntest_fechamodificacion($entest_fechamodificacion) {
        $this->entest_fechamodificacion = $entest_fechamodificacion;
    }	

}