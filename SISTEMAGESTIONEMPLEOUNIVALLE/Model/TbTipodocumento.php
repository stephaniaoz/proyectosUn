<?php

include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbTipoDocumento{


	private $tipdocCodigo; 
    private $tipdocDescripcion; 
    private $tipdocAbreviatura; 
    private $tipdocFechacreacion; 
    private $tipdocFechamodificacion;


	function __construct(){

	}

	public function resultTipoDocumento(){

		$query = " 	SELECT t.tipdoc_codigo, t.tipdoc_descripcion 
					FROM tb_tipodocumento t ";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}

    public function getTipdocCodigo() {
        return $tipdocCodigo;
    }

    public function getTipdocDescripcion() {
        return $tipdocDescripcion;
    }

    public function getTipdocAbreviatura() {
        return $tipdocAbreviatura;
    }

    public function getTipdocFechacreacion() {
        return $tipdocFechacreacion;
    }

    public function getTipdocFechamodificacion() {
        return $tipdocFechamodificacion;
    }

    public function setTipdocCodigo($tipdocCodigo) {
        $this->tipdocCodigo = $tipdocCodigo;
    }

    public function setTipdocDescripcion($tipdocDescripcion) {
        $this->tipdocDescripcion = $tipdocDescripcion;
    }

    public function setTipdocAbreviatura($tipdocAbreviatura) {
        $this->tipdocAbreviatura = $tipdocAbreviatura;
    }

    public function setTipdocFechacreacion($tipdocFechacreacion) {
        $this->tipdocFechacreacion = $tipdocFechacreacion;
    }

    public function setTipdocFechamodificacion($tipdocFechamodificacion) {
        $this->tipdocFechamodificacion = $tipdocFechamodificacion;
    }

}	

?>	