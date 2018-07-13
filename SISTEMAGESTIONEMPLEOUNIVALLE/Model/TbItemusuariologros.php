<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");


class TbItemusuariologros{

	function __construct(){

	}

    public function resultListaUsuarioId($id){

        $query  = " SELECT *
                    FROM tb_itemusuariologros i 
                    WHERE i.usuario_codigo = ".$id." 
                    ORDER BY 2 ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

	private $iteusulogCodigo; 
   	private $iteusulogLogro; 
   	private $iteusulogDescripcion; 
   	private $usuarioCodigo;

    public function getIteusulogCodigo() {
        return $iteusulogCodigo;
    }

    public function getIteusulogLogro() {
        return $iteusulogLogro;
    }

    public function getIteusulogDescripcion() {
        return $iteusulogDescripcion;
    }

    public function getUsuarioCodigo() {
        return $usuarioCodigo;
    }

    public function setIteusulogCodigo($iteusulogCodigo) {
        $this->iteusulogCodigo = $iteusulogCodigo;
    }

    public function setIteusulogLogro($iteusulogLogro) {
        $this->iteusulogLogro = $iteusulogLogro;
    }

    public function setIteusulogDescripcion($iteusulogDescripcion) {
        $this->iteusulogDescripcion = $iteusulogDescripcion;
    }

    public function setUsuarioCodigo($usuarioCodigo) {
        $this->usuarioCodigo = $usuarioCodigo;
    }

}	

?>