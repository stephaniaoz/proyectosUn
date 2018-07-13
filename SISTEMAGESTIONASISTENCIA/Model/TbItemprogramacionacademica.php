<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';

}

/**
* 
*/
class TbItemprogramacionacademica
{


	public function crearDetalleProgramacion($proaca_codigo,  $asignatura_codigo,  $usuario_codigo,  $dia_semana,  $hora_inicio,  $hora_fin,  $salon_codigo,  $grupo,  $jornada_codigo,  $proaca_codigo_programa,  $fundamentacion_codigo){


		$insert = "		INSERT INTO tb_itemprogramacionacademica (proaca_codigo,  asignatura_codigo,  usuario_codigo,  iteproaca_diasemana,iteproaca_horainicio,  iteproaca_horafinal,  salon_codigo,  iteproaca_grupo,  jornada_codigo,  proaca_codigo_programa,  fundamentacion_codigo) 
						VALUES (".$proaca_codigo.",  ".$asignatura_codigo.",  ".$usuario_codigo.",  '".$dia_semana."',  '".$hora_inicio."',  '".$hora_fin."',  ".$salon_codigo.",  '".$grupo."',  ".$jornada_codigo.",  ".$proaca_codigo_programa.",  ".$fundamentacion_codigo.");";

		$resultInsert = pg_query($insert);

		return $resultInsert;

	}

	public function resultPorgramacionAcademica($usuario_codigo,  $diaSem,  $proAcaCodigoActivado){

		$query = "	SELECT a.asignatura_codigoasignatura,  a.asignatura_nombre ,u.usuario_identificacion,  ip.iteproaca_diasemana,  ip.iteproaca_horainicio,  ip.iteproaca_horafinal,
					s.salon_nombre,  ip.iteproaca_grupo,  j.jornada_nombre,  pra.proaca_codigoprograma,  fn.fundamentacion_nombre,  ip.iteproaca_codigo,  (select count(*) from tb_registroasistencia where iteproaca_codigo = ip.iteproaca_codigo and regasi_fechacreacion = current_date) as chequeo
					FROM tb_itemprogramacionacademica ip 
					JOIN tb_asignatura a ON a.asignatura_codigo = ip.asignatura_codigo
					JOIN tb_usuario u ON u.usuario_codigo = ip.usuario_codigo
					LEFT JOIN tb_salon s ON s.salon_codigo = ip.salon_codigo 
					LEFT JOIN tb_jornada j ON j.jornada_codigo = ip.jornada_codigo
					LEFT JOIN tb_programaacademico pra ON pra.proaca_codigo = ip.proaca_codigo_programa 
					LEFT JOIN tb_fundamentacion fn ON fn.fundamentacion_codigo = ip.fundamentacion_codigo 
					WHERE ip.usuario_codigo = ".$usuario_codigo." /*AND ip.iteproaca_diasemana = '".$diaSem."'*/ AND ip.proaca_codigo = ".$proAcaCodigoActivado." 
					UNION ALL

					SELECT a.asignatura_codigoasignatura,  a.asignatura_nombre ,u.usuario_identificacion,  get_dia_semana(ir.itenovsolrec_fechasolicitud::character varying) as iteproaca_diasemana,  ir.itenovsolrec_horainicioclase,  ir.itenovsolrec_horafinclase,  s.salon_nombre,  ip.iteproaca_grupo,  j.jornada_nombre,  pra.proaca_codigoprograma,  fn.fundamentacion_nombre,  ip.iteproaca_codigo,  (select count(*) from tb_registroasistencia where iteproaca_codigo = ip.iteproaca_codigo and regasi_fechacreacion = current_date) as chequeo
					FROM tb_itemnovedadsolicitudrecuperacion ir
					JOIN tb_novedad n on n.novedad_codigo = ir.novedad_codigo
					JOIN tb_itemprogramacionacademica ip on ip.iteproaca_codigo = n.iteproaca_codigo
					JOIN tb_asignatura a ON a.asignatura_codigo = ip.asignatura_codigo 
					JOIN tb_usuario u ON u.usuario_codigo = ip.usuario_codigo 
					LEFT JOIN tb_salon s ON s.salon_codigo = ir.salon_codigo 
					LEFT JOIN tb_jornada j ON j.jornada_codigo = ip.jornada_codigo 
					LEFT JOIN tb_programaacademico pra ON pra.proaca_codigo = ip.proaca_codigo_programa 
					LEFT JOIN tb_fundamentacion fn ON fn.fundamentacion_codigo = ip.fundamentacion_codigo 
					WHERE ip.usuario_codigo = ".$usuario_codigo." /*AND ip.iteproaca_diasemana = '".$diaSem."'*/ AND ip.proaca_codigo = ".$proAcaCodigoActivado." 
					AND ir.itenovsolrec_fechasolicitud = current_date AND n.estado_codigo = 4;";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;
       

	}

	public function resultBusquedaItemProgramacionSeleccionada(){

		$query = "	SELECT a.asignatura_codigoasignatura,  u.usuario_identificacion,  ip.iteproaca_diasemana,  ip.iteproaca_horainicio,  ip.iteproaca_horafinal,
					s.salon_nombre,  ip.iteproaca_grupo,  j.jornada_nombre,  pra.proaca_codigoprograma,  fn.fundamentacion_nombre,  ip.iteproaca_codigo
					FROM tb_itemprogramacionacademica ip 
					LEFT JOIN tb_asignatura a ON a.asignatura_codigo = ip.asignatura_codigo
					LEFT JOIN tb_usuario u ON u.usuario_codigo = ip.usuario_codigo
					LEFT JOIN tb_salon s ON s.salon_codigo = ip.salon_codigo 
					LEFT JOIN tb_jornada j ON j.jornada_codigo = ip.jornada_codigo
					LEFT JOIN tb_programaacademico pra ON pra.proaca_codigo = ip.proaca_codigo_programa 
					LEFT JOIN tb_fundamentacion fn ON fn.fundamentacion_codigo = ip.fundamentacion_codigo 
					WHERE iteproaca_codigo in (".$cadenacodigo.") ;";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

	}

	public function getProgramacion($fechaproaca,  $usuario_codigo){

		$consulta ="SELECT ip.iteproaca_diasemana,  ip.iteproaca_codigo,  j.jornada_nombre,  ip.iteproaca_grupo,  pa.proaca_codigoprograma,  pa.proaca_nombre,  s.salon_nombre,  u.usuario_identificacion,
					a.asignatura_nombre
							FROM tb_itemprogramacionacademica ip
							JOIN tb_jornada j ON j.jornada_codigo = ip.jornada_codigo
							JOIN tb_programaacademico pa ON pa.proaca_codigo = ip.proaca_codigo_programa
							JOIN tb_asignatura a ON a.asignatura_codigo = ip.asignatura_codigo
							JOIN tb_usuario u ON u.usuario_codigo = ip.usuario_codigo
							JOIN tb_salon s ON s.salon_codigo = ip.salon_codigo
							WHERE ip.iteproaca_diasemana = get_dia_semana('".$fechaproaca."') AND u.usuario_codigo = ".$usuario_codigo."
							ORDER BY j.jornada_nombre ";

		$result = pg_query($consulta);

		return $result;
	}

	public function getAsignaturaProgramadaDocente($proAcaCodigoActivado,  $usuario_identificacion){


		$consulta_asignaturas_docente = "SELECT a.asignatura_codigoasignatura,  a.asignatura_nombre,  a.asignatura_intensidad 
					FROM tb_itemprogramacionacademica ip 
					LEFT JOIN tb_asignatura a ON a.asignatura_codigo = ip.asignatura_codigo
					LEFT JOIN tb_usuario u ON u.usuario_codigo = ip.usuario_codigo
					WHERE ip.proaca_codigo = ".$proAcaCodigoActivado." AND  u.usuario_identificacion = '".$usuario_identificacion."';";

		$result = pg_query($consulta_asignaturas_docente) or die('La consulta fallo: ' . pg_last_error());

        return $result;



	}




}

?>	