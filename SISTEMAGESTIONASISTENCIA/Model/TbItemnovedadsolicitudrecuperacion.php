<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


Class TbItemnovedadsolicitudrecuperacion{


	public function updateItemRecuperacion($novedad_codigo, $salon_codigo){

		$correcto = false;

		$query = "	UPDATE tb_itemnovedadsolicitudrecuperacion SET salon_codigo = ".$salon_codigo." WHERE novedad_codigo = ".$novedad_codigo.";";

		$result = @pg_query($query);
		$errorquery = @pg_last_error();

		if($errorquery){
			$afectadas = "La consulta falló cod 1";
		}else{
			$afectadas = "Se actualizó la solicitud exitosamente, filas afectadas ".pg_affected_rows($result);
			$correcto = true;	
		}

		return $correcto;

	}


}


?>