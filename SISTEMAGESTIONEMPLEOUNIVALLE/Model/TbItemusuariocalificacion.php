<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");


class TbItemusuariocalificacion{

	private $iteusucalCodigo; 
    private $usuarioCodigo; 
    private $empresaCodigo; 
    private $iteusucalEstrellas; 
    private $iteusucalDescripcion;

	function __construct(){

	}

    public function save($objetocalificacion){

        $objetocalificacion->setIteusucalCodigo($this->maxIteusucalCodigo());

        $query = "  INSERT INTO tb_itemusuariocalificacion(
                            iteusucal_codigo, usuario_codigo, empresa_codigo, iteusucal_estrellas, 
                            iteusucal_descripcion)
                    VALUES (".$objetocalificacion->getIteusucalCodigo().", ".$objetocalificacion->getUsuarioCodigo().", ".$objetocalificacion->getEmpresaCodigo().", ".$objetocalificacion->getIteusucalEstrellas().", 
                            '".$objetocalificacion->getIteusucalDescripcion()."'); ";

        $result = @pg_query($query);

        $errorquery = @pg_last_error();

        if($errorquery){
            $afectadas = 'La consulta falló. Código: IT01';             
        }else{
            $afectadas = 'Se agregó el usuario exitosamente, filas afectadas: '.pg_affected_rows($result);
        }       

        return $afectadas;

    }	

    public function maxIteusucalCodigo(){

        
        $query  = " SELECT case when max(i.iteusucal_codigo) is null then 0 else (max(i.iteusucal_codigo) + 1) end AS maximo
                    FROM tb_itemusuariocalificacion i ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        $arrayUsuario = pg_fetch_assoc($result);
        $maximo = $arrayUsuario['maximo'];

        if($maximo == 0){
            $maximo = 1;
        }

        return $maximo;
    }

    public function resultListaItemCalificacionId($usuario_codigo){

        $query  = " SELECT i.*, e.empresa_razonsocial
                    FROM tb_itemusuariocalificacion i
                    JOIN tb_empresa e ON e.empresa_codigo = i.empresa_codigo
                    WHERE i.usuario_codigo = ".$usuario_codigo." ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function getIteusucalCodigo() {
        return $this->iteusucalCodigo;
    }

    public function getUsuarioCodigo() {
        return $this->usuarioCodigo;
    }

    public function getEmpresaCodigo() {
        return $this->empresaCodigo;
    }

    public function getIteusucalEstrellas() {
        return $this->iteusucalEstrellas;
    }

    public function getIteusucalDescripcion() {
        return $this->iteusucalDescripcion;
    }

    public function setIteusucalCodigo($iteusucalCodigo) {
        $this->iteusucalCodigo = $iteusucalCodigo;
    }

    public function setUsuarioCodigo($usuarioCodigo) {
        $this->usuarioCodigo = $usuarioCodigo;
    }

    public function setEmpresaCodigo($empresaCodigo) {
        $this->empresaCodigo = $empresaCodigo;
    }

    public function setIteusucalEstrellas($iteusucalEstrellas) {
        $this->iteusucalEstrellas = $iteusucalEstrellas;
    }

    public function setIteusucalDescripcion($iteusucalDescripcion) {
        $this->iteusucalDescripcion = $iteusucalDescripcion;
    }

}

?>