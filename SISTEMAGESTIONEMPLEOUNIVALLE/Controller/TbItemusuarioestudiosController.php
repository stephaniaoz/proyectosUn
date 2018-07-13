<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbItemusuarioestudios.php");


class TbItemusuarioestudiosController{

	public function getListaUsuarioId($id){

		$tbUsurario = new TbItemusuarioestudios();

		$result = $tbUsurario->resultListaUsuarioId($id);
		
		$count = 0;

		while ($arrayUsuContact = pg_fetch_assoc($result)) {
			$this->arrayUsuarioContacto[$count]['iteusuest_entidad'] = $arrayUsuContact['iteusuest_entidad'];
			$this->arrayUsuarioContacto[$count]['iteusuest_carrera'] = $arrayUsuContact['iteusuest_carrera'];
			$this->arrayUsuarioContacto[$count]['iteusuest_descripcion'] = $arrayUsuContact['iteusuest_descripcion'];

			$count++;
		}		

		return $this->arrayUsuarioContacto;	

	}

}

?>