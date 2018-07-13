<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");


class TbItemusuarioestudios{

	private $iteusuestCodigo; 
    private $iteusuestEntidad; 
    private $iteusuestCarrera; 
    private $iteusuestDescripcion; 
    private $usuarioCodigo;

	function __construct(){

	}

    public function resultListaUsuarioId($id){

        $query  = " SELECT *
                    FROM tb_itemusuarioestudios i 
                    WHERE i.usuario_codigo = ".$id." 
                    ORDER BY 2 ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function getIteusuestCodigo() {
        return $iteusuestCodigo;
    }

    public function getIteusuestEntidad() {
        return $iteusuestEntidad;
    }

    public function getIteusuestCarrera() {
        return $iteusuestCarrera;
    }

    public function getIteusuestDescripcion() {
        return $iteusuestDescripcion;
    }

    public function getUsuarioCodigo() {
        return $usuarioCodigo;
    }

    public function setIteusuestCodigo($iteusuestCodigo) {
        $this->iteusuestCodigo = iteusuestCodigo;
    }

    public function setIteusuestEntidad($iteusuestEntidad) {
        $this->iteusuestEntidad = iteusuestEntidad;
    }

    public function setIteusuestCarrera($iteusuestCarrera) {
        $this->iteusuestCarrera = iteusuestCarrera;
    }

    public function setIteusuestDescripcion($iteusuestDescripcion) {
        $this->iteusuestDescripcion = iteusuestDescripcion;
    }

    public function setUsuarioCodigo($usuarioCodigo) {
        $this->usuarioCodigo = usuarioCodigo;
    }

}	

?>