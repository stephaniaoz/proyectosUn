<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");


class TbFacultad{

	function __construct(){

	}

	private $facultadCodigo; 
   	private $facultadNombre; 
   	private $facultadDescripcion; 
   	private $facultadFechacreacion; 
   	private $facultadFechamodificacion;

   	public function resultFacultad(){

        $query = "  SELECT *
                    FROM tb_facultad f ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function getFacultadCodigo() {
        return $facultadCodigo;
    }

    public function getFacultadNombre() {
        return $facultadNombre;
    }

    public function getFacultadDescripcion() {
        return $facultadDescripcion;
    }

    public function getFacultadFechacreacion() {
        return $facultadFechacreacion;
    }

    public function getFacultadFechamodificacion() {
        return $facultadFechamodificacion;
    }

    public function setFacultadCodigo($facultadCodigo) {
        $this->facultadCodigo = $facultadCodigo;
    }

    public function setFacultadNombre($facultadNombre) {
        $this->facultadNombre = $facultadNombre;
    }

    public function setFacultadDescripcion($facultadDescripcion) {
        $this->facultadDescripcion = $facultadDescripcion;
    }

    public function setFacultadFechacreacion($facultadFechacreacion) {
        $this->facultadFechacreacion = $facultadFechacreacion;
    }

    public function setFacultadFechamodificacion($facultadFechamodificacion) {
        $this->facultadFechamodificacion = $facultadFechamodificacion;
    }

}	

?>



