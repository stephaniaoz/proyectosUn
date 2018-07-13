<?php

include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");

class TbPerfil{

	private $perfilCodigo; 
    private $perfilDescripcion; 
    private $perfilCreate; 
    private $perfilDelete; 
    private $perfilUpdate; 
    private $perfilSelect; 
    private $perfilFechacreacion; 
    private $perfilFechamodificacion;

	function __construct(){

	}

	public function resultPerfil(){

		$query = " 	SELECT p.perfil_codigo, p.perfil_descripcion
					FROM tb_perfil p 
                    WHERE p.perfil_descripcion <> 'EMPRESA'
					ORDER BY p.perfil_descripcion ";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}


	public function resultPerfilEmpresa(){

		$query = " 	SELECT p.perfil_codigo, p.perfil_descripcion
					FROM tb_perfil p 
					WHERE p.perfil_descripcion = 'EMPRESA'
					ORDER BY p.perfil_descripcion ";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}

    public function getPerfilCodigo() {
        return $perfilCodigo;
    }

    public function getPerfilDescripcion() {
        return $perfilDescripcion;
    }

    public function getPerfilCreate() {
        return $perfilCreate;
    }

    public function getPerfilDelete() {
        return $perfilDelete;
    }

    public function getPerfilUpdate() {
        return $perfilUpdate;
    }

    public function getPerfilSelect() {
        return $perfilSelect;
    }

    public function getPerfilFechacreacion() {
        return $perfilFechacreacion;
    }

    public function getPerfilFechamodificacion() {
        return $perfilFechamodificacion;
    }

    public function setPerfilCodigo($perfilCodigo) {
        $this->perfilCodigo = $perfilCodigo;
    }

    public function setPerfilDescripcion($perfilDescripcion) {
        $this->perfilDescripcion = $perfilDescripcion;
    }

    public function setPerfilCreate($perfilCreate) {
        $this->perfilCreate = $perfilCreate;
    }

    public function setPerfilDelete($perfilDelete) {
        $this->perfilDelete = $perfilDelete;
    }

    public function setPerfilUpdate($perfilUpdate) {
        $this->perfilUpdate = $perfilUpdate;
    }

    public function setPerfilSelect($perfilSelect) {
        $this->perfilSelect = $perfilSelect;
    }

    public function setPerfilFechacreacion($perfilFechacreacion) {
        $this->perfilFechacreacion = $perfilFechacreacion;
    }

    public function setPerfilFechamodificacion($perfilFechamodificacion) {
        $this->perfilFechamodificacion = $perfilFechamodificacion;
    }
    

}