<?php

include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbItementidadestudiosede{


    private $iteentestsed_codigo;
    private $iteentestsed_nombre; 
    private $ciudad_codigo; 
    private $iteentestsed_fechacreacion; 
    private $iteentestsed_fechamodificacion; 
    private $entest_codigo;

	function __construct(){

	}

	public function resultItementidadestudioPorEntidad($id_entidad){

		$query = " 	SELECT i.iteentestsed_codigo, i.iteentestsed_nombre
					FROM tb_itementidadestudiosede i 
                    WHERE i.entest_codigo = ".$id_entidad."
					ORDER BY i.iteentestsed_nombre ";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}

    public function getIteentestsed_codigo() {
        return $iteentestsed_codigo;
    }

    public function getIteentestsed_nombre() {
        return $iteentestsed_nombre;
    }

    public function getCiudad_codigo() {
        return $ciudad_codigo;
    }

    public function getIteentestsed_fechacreacion() {
        return $iteentestsed_fechacreacion;
    }

    public function getIteentestsed_fechamodificacion() {
        return $iteentestsed_fechamodificacion;
    }

    public function getEntest_codigo() {
        return $entest_codigo;
    }

    public function setIteentestsed_codigo($iteentestsed_codigo) {
        $this->iteentestsed_codigo = $iteentestsed_codigo;
    }

    public function setIteentestsed_nombre($iteentestsed_nombre) {
        $this->iteentestsed_nombre = $iteentestsed_nombre;
    }

    public function setCiudad_codigo($ciudad_codigo) {
        $this->ciudad_codigo = $ciudad_codigo;
    }

    public function setIteentestsed_fechacreacion($iteentestsed_fechacreacion) {
        $this->iteentestsed_fechacreacion = $iteentestsed_fechacreacion;
    }

    public function setIteentestsed_fechamodificacion($iteentestsed_fechamodificacion) {
        $this->iteentestsed_fechamodificacion = $iteentestsed_fechamodificacion;
    }

    public function setEntest_codigo($entest_codigo) {
        $this->entest_codigo = $entest_codigo;
    }
}