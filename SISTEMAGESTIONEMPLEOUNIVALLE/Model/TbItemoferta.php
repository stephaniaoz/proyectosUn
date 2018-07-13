<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");


class TbItemoferta{

	function __construct(){

	}

	
    private $iteofeCodigo; 
    private $ofertaCodigo; 
    private $facultadCodigo; 
    private $iteofeCantidadpersonas; 
    private $iteofeDescripcion; 
    private $iteofeFechacreacion; 
    private $iteofeFechamodificacion;    

    public function save($objetoitemoferta){

        $objetoitemoferta->setIteofeCodigo($this->maxItemOfertaCodigo());

        $query = "  INSERT INTO tb_itemoferta(
                            iteofe_codigo, 
                            oferta_codigo, 
                            facultad_codigo, 
                            iteofe_cantidadpersonas, 
                            iteofe_descripcion)
                    VALUES (".$objetoitemoferta->getIteofeCodigo().",
                            ".$objetoitemoferta->getOfertaCodigo().",
                            ".$objetoitemoferta->getFacultadCodigo().",
                            ".$objetoitemoferta->getIteofeCantidadpersonas().",
                            '".$objetoitemoferta->getIteofeDescripcion()."'); ";

        
        $result = pg_query($query);

        $errorquery = pg_last_error();

        if($errorquery){
            $afectadas = 'La consulta falló. Código: I01';      
        }else{
            $afectadas = 'Se agregó la oferta exitosamente, filas afectadas: '.pg_affected_rows($result);
        }       

        return $afectadas;

    }

    public function maxItemOfertaCodigo(){

        $maximo = 1;

        $query  = " SELECT (max(i.iteofe_codigo) + 1) AS maximo
                    FROM tb_itemoferta i ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        $arrayItemOferta = pg_fetch_assoc($result);
        $maximo = $arrayItemOferta['maximo'];

        return $maximo;
    }

    public function getIteofeCodigo() {
        return $this->iteofeCodigo;
    }

    public function getOfertaCodigo() {
        return $this->ofertaCodigo;
    }

    public function getFacultadCodigo() {
        return $this->facultadCodigo;
    }

    public function getIteofeCantidadpersonas() {
        return $this->iteofeCantidadpersonas;
    }

    public function getIteofeDescripcion() {
        return $this->iteofeDescripcion;
    }

    public function getIteofeFechacreacion() {
        return $this->iteofeFechacreacion;
    }

    public function getIteofeFechamodificacion() {
        return $this->iteofeFechamodificacion;
    }

    public function setIteofeCodigo($iteofeCodigo) {
        $this->iteofeCodigo = $iteofeCodigo;
    }

    public function setOfertaCodigo($ofertaCodigo) {
        $this->ofertaCodigo = $ofertaCodigo;
    }

    public function setFacultadCodigo($facultadCodigo) {
        $this->facultadCodigo = $facultadCodigo;
    }

    public function setIteofeCantidadpersonas($iteofeCantidadpersonas) {
        $this->iteofeCantidadpersonas = $iteofeCantidadpersonas;
    }

    public function setIteofeDescripcion($iteofeDescripcion) {
        $this->iteofeDescripcion = $iteofeDescripcion;
    }

    public function setIteofeFechacreacion($iteofeFechacreacion) {
        $this->iteofeFechacreacion = $iteofeFechacreacion;
    }

    public function setIteofeFechamodificacion($iteofeFechamodificacion) {
        $this->iteofeFechamodificacion = $iteofeFechamodificacion;
    }


}	

?>
