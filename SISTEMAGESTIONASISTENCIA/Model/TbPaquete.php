<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


Class TbPaquete{


	public function getListaPaquete($nombre_perfil_ingreso){

		$consulta_listamenu = "	SELECT p.paquete_codigo, p.paquete_nombre
							   	FROM tb_perfil pe
							   	JOIN tb_itempaqueteperfil i ON i.perfil_codigo = pe.perfil_codigo
							   	JOIN tb_paquete p ON p.paquete_codigo = i.paquete_codigo
								WHERE perfil_nombre='".$nombre_perfil_ingreso."';";

		$resul_listamenu = pg_query($consulta_listamenu);

		return $resul_listamenu;

	}

}

?>