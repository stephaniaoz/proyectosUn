<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbItemusuarioexperiencialaboral.php");


class TbItemusuarioexperiencialaboralController{


	public function getListaUsuarioId($id){

		$tbUsurario = new TbItemusuarioexperiencialaboral();

		$result = $tbUsurario->resultListaUsuarioId($id);
		
		$count = 0;

		while ($arrayUsuContact = pg_fetch_assoc($result)) {
			$this->arrayUsuarioContacto[$count]['iteusuexplab_entidad'] = $arrayUsuContact['iteusuexplab_entidad'];
			$this->arrayUsuarioContacto[$count]['iteusuexplab_tiempolaborado'] = $arrayUsuContact['iteusuexplab_tiempolaborado'];
			$this->arrayUsuarioContacto[$count]['iteusuexplab_ocupacion'] = $arrayUsuContact['iteusuexplab_ocupacion'];
			$this->arrayUsuarioContacto[$count]['iteusuexplab_tareas'] = $arrayUsuContact['iteusuexplab_tareas'];

			$count++;
		}		

		return $this->arrayUsuarioContacto;	

	}
	

}

?>