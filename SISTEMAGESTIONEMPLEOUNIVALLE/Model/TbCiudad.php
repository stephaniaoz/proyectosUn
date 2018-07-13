<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbCiudad{

	private $ciudadCodigo; 
	private $departamentoCodigo; 
    private $ciudadFechacreacion; 
    private $ciudadFechamodificacion; 
    private $ciudadNombre;
	
	function __construct(){

	}    

    public function resultCiudad(){

        $query = "  SELECT c.ciudad_codigo, c.ciudad_nombre 
                    FROM tb_ciudad c ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }     

	public function resultCiudadPorDpto($dptoCodigo){

		$query = " 	SELECT c.ciudad_codigo, c.ciudad_nombre 
					FROM tb_ciudad c
					WHERE c.departamento_codigo = ".$dptoCodigo." ";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}     

    public function getCiudadCodigo() {
        return $this->ciudadCodigo;
    }

    public function getDepartamentoCodigo() {
        return $this->departamentoCodigo;
    }

    public function getCiudadFechacreacion() {
        return $this->ciudadFechacreacion;
    }

    public function getCiudadFechamodificacion() {
        return $this->ciudadFechamodificacion;
    }

    public function getCiudadNombre() {
        return $this->ciudadNombre;
    }

    public function setCiudadCodigo($ciudadCodigo) {
        $this->ciudadCodigo = $ciudadCodigo;
    }

    public function setDepartamentoCodigo($departamentoCodigo) {
        $this->departamentoCodigo = $departamentoCodigo;
    }

    public function setCiudadFechacreacion($ciudadFechacreacion) {
        $this->ciudadFechacreacion = $ciudadFechacreacion;
    }

    public function setCiudadFechamodificacion($ciudadFechamodificacion) {
        $this->ciudadFechamodificacion = $ciudadFechamodificacion;
    }

    public function setCiudadNombre($ciudadNombre) {
        $this->ciudadNombre = $ciudadNombre;
    }

}

?>