<?php

include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbProgramaacademico{


    private $proaca_codigo; 
    private $proaca_nombre; 
    private $proaca_creditos; 
    private $tipfor_codigo; 
    private $proaca_titulootorgado; 
    private $proaca_acreditacion; 
    private $facultad_codigo;

	function __construct(){

	}

    public function resultProgramaacademico(){

        $query = "  SELECT p.proaca_codigo, p.proaca_nombre
                    FROM tb_programaacademico p 
                    ORDER BY p.proaca_nombre ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function getProaca_codigo() {
        return $proaca_codigo;
    }

    public function getProaca_nombre() {
        return $proaca_nombre;
    }

    public function getProaca_creditos() {
        return $proaca_creditos;
    }

    public function getTipfor_codigo() {
        return $tipfor_codigo;
    }

    public function getProaca_titulootorgado() {
        return $proaca_titulootorgado;
    }

    public function getProaca_acreditacion() {
        return $proaca_acreditacion;
    }

    public function getFacultad_codigo() {
        return $facultad_codigo;
    }

    public function setProaca_codigo($proaca_codigo) {
        $this->proaca_codigo = $proaca_codigo;
    }

    public function setProaca_nombre($proaca_nombre) {
        $this->proaca_nombre = $proaca_nombre;
    }

    public function setProaca_creditos($proaca_creditos) {
        $this->proaca_creditos = $proaca_creditos;
    }

    public function setTipfor_codigo($tipfor_codigo) {
        $this->tipfor_codigo = $tipfor_codigo;
    }

    public function setProaca_titulootorgado($proaca_titulootorgado) {
        $this->proaca_titulootorgado = $proaca_titulootorgado;
    }

    public function setProaca_acreditacion($proaca_acreditacion) {
        $this->proaca_acreditacion = $proaca_acreditacion;
    }

    public function setFacultad_codigo($facultad_codigo) {
        $this->facultad_codigo = $facultad_codigo;
    }
    

}    