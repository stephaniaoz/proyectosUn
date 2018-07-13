<?php

include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbEstado{

    private $estado_codigo; 
    private $estado_descripcion; 
    private $modulo_codigo; 
    private $estado_fechacreacion; 
    private $estado_fechamodificacion;

	function __construct(){

	}

    public function resultEstadoPorModulo($modulo_codigo){

        $query = "  SELECT e.estado_codigo, e.estado_descripcion
                    FROM tb_estado e
                    WHERE e.modulo_codigo = ".$modulo_codigo."
                    ORDER BY e.estado_descripcion ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function getEstado_codigo() {
        return $estado_codigo;
    }

    public function getEstado_descripcion() {
        return $estado_descripcion;
    }

    public function getModulo_codigo() {
        return $modulo_codigo;
    }

    public function getEstado_fechacreacion() {
        return $estado_fechacreacion;
    }

    public function getEstado_fechamodificacion() {
        return $estado_fechamodificacion;
    }

    public function setEstado_codigo($estado_codigo) {
        $this->estado_codigo = $estado_codigo;
    }

    public function setEstado_descripcion($estado_descripcion) {
        $this->estado_descripcion = $estado_descripcion;
    }

    public function setModulo_codigo($modulo_codigo) {
        $this->modulo_codigo = $modulo_codigo;
    }

    public function setEstado_fechacreacion($estado_fechacreacion) {
        $this->estado_fechacreacion = $estado_fechacreacion;
    }

    public function setEstado_fechamodificacion($estado_fechamodificacion) {
        $this->estado_fechamodificacion = $estado_fechamodificacion;
    }

}    