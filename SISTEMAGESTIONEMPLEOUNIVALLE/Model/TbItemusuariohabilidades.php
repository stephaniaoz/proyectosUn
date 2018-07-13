<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");


class TbItemusuariohabilidades{

	function __construct(){

	}

	private $iteusuhabCodigo; 
    private $iteusuhabHabilidad; 
    private $iteusuhabDescripcion; 
    private $usuarioCodigo;

    public function resultListaUsuarioId($id){

        $query  = " SELECT *
                    FROM tb_itemusuariohabilidades i 
                    WHERE i.usuario_codigo = ".$id." 
                    ORDER BY 2 ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function getIteusuhabCodigo() {
        return $iteusuhabCodigo;
    }

    public function getIteusuhabHabilidad() {
        return $iteusuhabHabilidad;
    }

    public function getIteusuhabDescripcion() {
        return $iteusuhabDescripcion;
    }

    public function getUsuarioCodigo() {
        return $usuarioCodigo;
    }

    public function setIteusuhabCodigo($iteusuhabCodigo) {
        $this->iteusuhabCodigo = $iteusuhabCodigo;
    }

    public function setIteusuhabHabilidad($iteusuhabHabilidad) {
        $this->iteusuhabHabilidad = $iteusuhabHabilidad;
    }

    public function setIteusuhabDescripcion($iteusuhabDescripcion) {
        $this->iteusuhabDescripcion = $iteusuhabDescripcion;
    }

    public function setUsuarioCodigo($usuarioCodigo) {
        $this->usuarioCodigo = $usuarioCodigo;
    }

}	

?>



