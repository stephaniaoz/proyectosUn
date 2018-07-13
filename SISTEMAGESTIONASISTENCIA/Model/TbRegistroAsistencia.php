<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


Class TbRegistroAsistencia{

	public function getProgramacionUsuarioDia($usuarioCodigo, $diaSem){

		$consultaPprogramacion = "	SELECT *
									FROM tb_itemprogramacionacademica i
									JOIN tb_asignatura a on a.asignatura_codigo = i.asignatura_codigo
									JOIN tb_usuario u on u.usuario_codigo = i.usuario_codigo
									JOIN tb_salon s on s.salon_codigo = i.salon_codigo
									JOIN tb_jornada j on j.jornada_codigo = i.jornada_codigo
									JOIN tb_programaacademico p  on p.proaca_codigo = i.proaca_codigo_programa
									WHERE i.".$usuarioCodigo."; ";

	}

	public function setRegistrarAsistencia($arrayRegAsis){

		$insertAsistencia = " INSERT INTO tb_registroasistencia (
            				 iteproaca_codigo, iteprosem_codigo, regasi_cantidadhoras, 
            regasi_fechacreacion, regasi_tema, regasi_observacion, estado_codigo)
    							VALUES (".$arrayRegAsis['itProAca'].",".$arrayRegAsis['codigoItemProSem'].",".$arrayRegAsis['cantMinutos'].",current_date,'".$arrayRegAsis['area_tema']."','".$arrayRegAsis['area_observacion']."',".$arrayRegAsis['estado_codigo'].");";

		$result = pg_query($insertAsistencia) or die('Insert fallo: ' . pg_last_error());

		return $result;

	}

	

	public function getRegistroAsistenciaDocente($usuario_identificacion, $proAcaCodigoActivado){

		$consulta_registro_asistencia_Usuario = "SELECT *
													FROM tb_registroasistencia r
													JOIN tb_itemprogramacionacademica i ON i.iteproaca_codigo = r.iteproaca_codigo
													JOIN tb_usuario u ON u.usuario_codigo = i.usuario_codigo
													JOIN tb_programacionacademica p ON p.proaca_codigo = i.proaca_codigo
													WHERE u.usuario_identificacion = '".$usuario_identificacion."' AND p.proaca_codigo = ".$proAcaCodigoActivado.";";

		$resultRegAsiUsu = pg_query($consulta_registro_asistencia_Usuario) or die('Insert fallo: ' . pg_last_error());

		return $resultRegAsiUsu;

	}


}

/*$obj = new TbRegistroAsistencia();

$obj->getProgramacionUsuarioDia(123,'lunes');*/


?>