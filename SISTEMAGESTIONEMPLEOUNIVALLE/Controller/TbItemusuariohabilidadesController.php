<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbItemusuariohabilidades.php");


class TbItemusuariohabilidadesController{

	public function getListaUsuarioId($id){

		$tbUsurario = new TbItemusuariohabilidades();

		$result = $tbUsurario->resultListaUsuarioId($id);
		
		$count = 0;

		while ($arrayUsuContact = pg_fetch_assoc($result)) {
			$this->arrayUsuarioContacto[$count]['iteusuhab_codigo'] = $arrayUsuContact['iteusuhab_codigo'];
			$this->arrayUsuarioContacto[$count]['iteusuhab_habilidad'] = $arrayUsuContact['iteusuhab_habilidad'];
			$this->arrayUsuarioContacto[$count]['iteusuhab_descripcion'] = $arrayUsuContact['iteusuhab_descripcion'];
			$this->arrayUsuarioContacto[$count]['usuario_codigo'] = $arrayUsuContact['usuario_codigo'];

			$count++;
		}		

		return $this->arrayUsuarioContacto;	

	}

}

?>