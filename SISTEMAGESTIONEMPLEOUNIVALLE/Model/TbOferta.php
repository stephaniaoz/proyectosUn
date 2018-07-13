<?php

include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbOferta{

    private $ofertaCodigo; 
    private $empresaCodigo; 
    private $ofertaCescripcion; 
    private $estadoCodigo;

	function __construct(){

	}

    public function resultOferta(){

        $query = "  SELECT o.*, e.empresa_razonsocial, es.estado_descripcion
                    FROM tb_oferta o
                    JOIN tb_empresa e ON e.empresa_codigo = o.empresa_codigo 
                    JOIN tb_estado es ON es.estado_codigo = o.estado_codigo ";
                    //echo $query;
        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function save($objetooferta){

        $objetooferta->setOfertaCodigo($this->maxOfertaCodigo());

        $query = "  INSERT INTO tb_oferta(
                            oferta_codigo, empresa_codigo, oferta_descripcion, estado_codigo)
                    VALUES (".$objetooferta->getOfertaCodigo().", ".$objetooferta->getEmpresaCodigo().", '".$objetooferta->getOfertaDescripcion()."', ".$objetooferta->getEstadoCodigo()."); ";

        $result = pg_query($query);

        $errorquery = pg_last_error();

        if($errorquery){
            $afectadas = 'La consulta falló. Código: e01';   die();          
        }else{
            $afectadas = 'Se agregó la oferta exitosamente, filas afectadas: '.pg_affected_rows($result);
        }       

        return $afectadas;

    }

    public function maxOfertaCodigo(){

        $maximo = 1;

        $query  = " SELECT (max(o.oferta_codigo) + 1) AS maximo
                    FROM tb_oferta o ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        $arrayOferta = pg_fetch_assoc($result);
        $maximo = $arrayOferta['maximo'];

        return $maximo;
    }

    public function getOfertaCodigo() {
        return $this->ofertaCodigo;
    }

    public function getEmpresaCodigo() {
        return $this->empresaCodigo;
    }

    public function getOfertaDescripcion() {
        return $this->ofertaDescripcion;
    }

    public function getEstadoCodigo() {
        return $this->estadoCodigo;
    }

    public function setOfertaCodigo($ofertaCodigo) {
        $this->ofertaCodigo = $ofertaCodigo;
    }

    public function setEmpresaCodigo($empresaCodigo) {
        $this->empresaCodigo = $empresaCodigo;
    }

    public function setOfertaDescripcion($ofertaDescripcion) {
        $this->ofertaDescripcion = $ofertaDescripcion;
    }

    public function setEstadoCodigo($estadoCodigo) {
        $this->estadoCodigo = $estadoCodigo;
    }

}