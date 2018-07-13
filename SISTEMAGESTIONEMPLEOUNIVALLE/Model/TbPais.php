<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbPais{

	private $paisCodigo; 
    private $paisNombre; 
    private $paisFechacreacion; 
    private $paisFechamodificacion;

    function __construct(){

	}

	public function resultPais(){

		$query = "	SELECT p.pais_codigo, p.pais_nombre
					FROM tb_pais p 
					ORDER BY p.pais_nombre";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}

    public function getPaisCodigo() {
        return $this->paisCodigo;
    }

    public function getPaisNombre() {
        return $this->paisNombre;
    }

    public function getPaisFechacreacion() {
        return $this->paisFechacreacion;
    }

    public function getPaisFechamodificacion() {
        return $this->paisFechamodificacion;
    }

    public function setPaisCodigo($paisCodigo) {
        $this->paisCodigo = $paisCodigo;
    }

    public function setPaisNombre($paisNombre) {
        $this->paisNombre = $paisNombre;
    }

    public function setPaisFechacreacion($paisFechacreacion) {
        $this->paisFechacreacion = $paisFechacreacion;
    }

    public function setPaisFechamodificacion($paisFechamodificacion) {
        $this->paisFechamodificacion = $paisFechamodificacion;
    }

}

?>