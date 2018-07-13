<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");


class TbItemusuarioexperiencialaboral{

	function __construct(){

	}

	private $iteusuexplabEntidad; 
    private $iteusuexplabTiempolaborado; 
    private $iteusuexplabOcupacion; 
    private $iteusuexplabTareas; 
    private $usuarioCodigo;

    public function resultListaUsuarioId($id){

        $query  = " SELECT *
                    FROM tb_itemusuarioexperiencialaboral i 
                    WHERE i.usuario_codigo = ".$id." 
                    ORDER BY 2 ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function getIteusuexplabEntidad() {
        return $iteusuexplabEntidad;
    }

    public function getIteusuexplabTiempolaborado() {
        return $iteusuexplabTiempolaborado;
    }

    public function getIteusuexplabOcupacion() {
        return $iteusuexplabOcupacion;
    }

    public function getIteusuexplabTareas() {
        return $iteusuexplabTareas;
    }

    public function getUsuarioCodigo() {
        return $usuarioCodigo;
    }

    public function setIteusuexplabEntidad($iteusuexplabEntidad) {
        $this->iteusuexplabEntidad = $iteusuexplabEntidad;
    }

    public function setIteusuexplabTiempolaborado($iteusuexplabTiempolaborado) {
        $this->iteusuexplabTiempolaborado = $iteusuexplabTiempolaborado;
    }

    public function setIteusuexplabOcupacion($iteusuexplabOcupacion) {
        $this->iteusuexplabOcupacion = $iteusuexplabOcupacion;
    }

    public function setIteusuexplabTareas($iteusuexplabTareas) {
        $this->iteusuexplabTareas = $iteusuexplabTareas;
    }

    public function setUsuarioCodigo($usuarioCodigo) {
        $this->usuarioCodigo = $usuarioCodigo;
    }
    

}	

?>



