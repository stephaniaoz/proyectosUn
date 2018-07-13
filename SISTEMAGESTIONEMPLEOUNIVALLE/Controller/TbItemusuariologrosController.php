<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbItemusuariologros.php");


class TbItemusuariologrosController{

	public function getListaUsuarioId($id){

		$tbUsurario = new TbItemusuariologros();

		$result = $tbUsurario->resultListaUsuarioId($id);
		
		$count = 0;

		while ($arrayUsuContact = pg_fetch_assoc($result)) {
			$this->arrayUsuarioContacto[$count]['iteusulog_logro'] = $arrayUsuContact['iteusulog_logro'];
			$this->arrayUsuarioContacto[$count]['iteusulog_descripcion'] = $arrayUsuContact['iteusulog_descripcion'];

			$count++;
		}		

		return $this->arrayUsuarioContacto;	

	}

}

?>