<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


Class TbNovedad{

	public function listaNovedad($usuario_codigo){

		$consulta_novedad ="	SELECT t.tipnov_nombre, n.novedad_fecha, n.novedad_observaciondificultad, e.estado_nombre, (ip.iteproaca_diasemana||' - '||a.asignatura_nombre||' - grupo:'||ip.iteproaca_grupo) as programacion, sl.salon_nombre, n.tipnov_codigo
								FROM tb_novedad n
								JOIN tb_tiponovedad t ON t.tipnov_codigo = n.tipnov_codigo 
								JOIN tb_itemprogramacionacademica ip ON ip.iteproaca_codigo = n.iteproaca_codigo
								LEFT JOIN tb_itemnovedadsolicitudrecuperacion iso ON iso.novedad_codigo = n.novedad_codigo
								LEFT JOIN tb_salon sl ON sl.salon_codigo = iso.salon_codigo
								JOIN tb_asignatura a ON a.asignatura_codigo = ip.asignatura_codigo
								JOIN tb_estado e ON e.estado_codigo = n.estado_codigo
								WHERE n.usuario_codigo = ".$usuario_codigo."
								ORDER BY n.novedad_fecha  ";

		$result_novedad = pg_query($consulta_novedad);

		return $result_novedad;
	}

	public function listaNovedadDificultades($usuario_codigo){

		$consulta_novedad ="	SELECT t.tipnov_nombre, n.novedad_fecha, n.novedad_observaciondificultad, e.estado_nombre, (ip.iteproaca_diasemana||' - '||a.asignatura_nombre||' - grupo:'||ip.iteproaca_grupo) as programacion, sl.salon_nombre, n.tipnov_codigo,  u.usuario_identificacion, (u.usuario_nombre||' '||u.usuario_apellidos) AS nombrecompleto
								FROM tb_novedad n
								JOIN tb_tiponovedad t ON t.tipnov_codigo = n.tipnov_codigo 
								JOIN tb_itemprogramacionacademica ip ON ip.iteproaca_codigo = n.iteproaca_codigo
								LEFT JOIN tb_itemnovedadsolicitudrecuperacion iso ON iso.novedad_codigo = n.novedad_codigo
								LEFT JOIN tb_salon sl ON sl.salon_codigo = iso.salon_codigo
								JOIN tb_asignatura a ON a.asignatura_codigo = ip.asignatura_codigo
								JOIN tb_estado e ON e.estado_codigo = n.estado_codigo
								JOIN tb_usuario u ON u.usuario_codigo = n.usuario_codigo
								WHERE  n.tipnov_codigo = 1
								ORDER BY n.novedad_fecha  ";

		$result_novedad = pg_query($consulta_novedad);

		return $result_novedad;
	}

	public function listaNovedadFalta(){

		$consulta_novedad ="	SELECT t.tipnov_nombre, n.novedad_fecha, n.novedad_observaciondificultad, e.estado_nombre, (ip.iteproaca_diasemana||' - '||a.asignatura_nombre||' - grupo:'||ip.iteproaca_grupo) as programacion, sl.salon_nombre, n.tipnov_codigo, u.usuario_identificacion, (u.usuario_nombre||' '||u.usuario_apellidos) AS nombrecompleto, n.novedad_codigo, iso.itenovsolrec_codigo
								FROM tb_novedad n
								JOIN tb_tiponovedad t ON t.tipnov_codigo = n.tipnov_codigo 
								JOIN tb_itemprogramacionacademica ip ON ip.iteproaca_codigo = n.iteproaca_codigo
								LEFT JOIN tb_itemnovedadsolicitudrecuperacion iso ON iso.novedad_codigo = n.novedad_codigo
								LEFT JOIN tb_salon sl ON sl.salon_codigo = iso.salon_codigo
								JOIN tb_asignatura a ON a.asignatura_codigo = ip.asignatura_codigo
								JOIN tb_estado e ON e.estado_codigo = n.estado_codigo
								JOIN tb_usuario u ON u.usuario_codigo = n.usuario_codigo
								where n.tipnov_codigo = 2
								ORDER BY u.usuario_codigo, n.novedad_fecha  ";

		$result_novedad = pg_query($consulta_novedad);

		return $result_novedad;
	}

	public function listaNovedadOtros(){

		$consulta_novedad ="	SELECT t.tipnov_nombre, n.novedad_fecha, n.novedad_observaciondificultad, e.estado_nombre, (ip.iteproaca_diasemana||' - '||a.asignatura_nombre||' - grupo:'||ip.iteproaca_grupo) as programacion, n.tipnov_codigo, u.usuario_identificacion, (u.usuario_nombre||' '||u.usuario_apellidos) AS nombrecompleto, n.novedad_codigo
								FROM tb_novedad n
								JOIN tb_tiponovedad t ON t.tipnov_codigo = n.tipnov_codigo 
								JOIN tb_itemprogramacionacademica ip ON ip.iteproaca_codigo = n.iteproaca_codigo
								JOIN tb_asignatura a ON a.asignatura_codigo = ip.asignatura_codigo
								JOIN tb_estado e ON e.estado_codigo = n.estado_codigo
								JOIN tb_usuario u ON u.usuario_codigo = n.usuario_codigo
								where n.tipnov_codigo <> 2
								ORDER BY u.usuario_codigo, n.novedad_fecha  ";

		$result_novedad = pg_query($consulta_novedad);

		return $result_novedad;
	}

	public function setNovedad($tipnov_codigo, $novedad_fecha, $novedad_observaciondificultad, $iteproaca_codigo, $usuario_codigo){

		$correcto = false;

		$query = "	INSERT INTO tb_novedad(
				            tipnov_codigo, novedad_fecha, novedad_observaciondificultad, 
				            iteproaca_codigo, novedad_fecacreacion, novedad_fechamodificacion, 
				            estado_codigo, usuario_codigo)
				    VALUES (".$tipnov_codigo.", '".$novedad_fecha."', '".$novedad_observaciondificultad."', 
				            ".$iteproaca_codigo.", current_date, current_date, 
				            3, ".$usuario_codigo.");";

		$result = @pg_query($query);
		$errorquery = @pg_last_error();

		if($errorquery){
			$afectadas = "La consulta falló cod 1";
		}else{
			$afectadas = "Se guardó la novedad exitosamente, filas afectadas ".pg_affected_rows($result);
			$correcto = true;	
		}

		return $correcto;

	}

	public function updateEstadoRecuperacion($novedad_codigo, $tipo){

		$correcto = false;

		$query = "	UPDATE tb_novedad SET estado_codigo = ".$tipo." WHERE novedad_codigo = ".$novedad_codigo." "; /*SALON AUTORIZADO*/

		$result = @pg_query($query);
		$errorquery = @pg_last_error();

		if($errorquery){
			$afectadas = "La consulta falló cod 1";
		}else{
			$afectadas = "Se actualizó la novedad exitosamente, filas afectadas ".pg_affected_rows($result);
			$correcto = true;	
		}

		return $correcto;

	}

	public function setSolicitudRecuperacion($itenovsolrec_fechasolicitud, $itenovsolrec_horainicioclase, $itenovsolrec_horafinclase, $usuario_codigo){

		$correcto = false;
/*(select max(novedad_codigo) from tb_novedad where usuario_codigo = ".$usuario_codigo.")*/
		$query = "	INSERT INTO tb_itemnovedadsolicitudrecuperacion(
				            novedad_codigo, itenovsolrec_fechasolicitud, 
				            itenovsolrec_horainicioclase, itenovsolrec_horafinclase, itenovsolrec_fechacreacion, 
				            itenovsolrec_fechamodificacion, usuario_codigo, salon_codigo)
				    VALUES ((select max(novedad_codigo) from tb_novedad where usuario_codigo = ".$usuario_codigo."), '".$itenovsolrec_fechasolicitud."', 
				            '".$itenovsolrec_horainicioclase."', '".$itenovsolrec_horafinclase."', current_date, 
				            current_date, ".$usuario_codigo.", null); ";

		$result = @pg_query($query);
		$errorquery = @pg_last_error();

		if($errorquery){
			$afectadas = "La consulta falló cod 1";
		}else{
			$afectadas = "Se guardó la solicitud de recuperación exitosamente, filas afectadas ".pg_affected_rows($result);
			$correcto = true;	
		}

		return $correcto;

	}

	function validarUsuario($identificacion,$password){

		$user = false;
		$pass = false;

		$consulta = "SELECT CASE WHEN 
						COUNT(*) > 0 THEN 'EXISTE' ELSE 'NO EXISTE' END AS validacion_usuario
						FROM tb_usuario 
						WHERE usuario_identificacion ='".$identificacion."';";

		$result = pg_query($consulta) or die('La consulta fallo: ' . pg_last_error());

		$arrayUsuario = pg_fetch_assoc($result);

		$validacionUsuario = $arrayUsuario['validacion_usuario'];

		if($validacionUsuario == 'EXISTE'){

			$user = true;

			$consulta_pass = "SELECT CASE WHEN
							COUNT(*) > 0 THEN usuario_codigo ELSE 0 END AS validacion_password
							FROM tb_usuario
							WHERE usuario_identificacion = '".$identificacion."' AND usuario_password = '".$password."' ". 
							"GROUP BY usuario_codigo; ";


			$result_pass = pg_query($consulta_pass) or die('La consulta fallo: '.pg_last_error());

			$arraypass = pg_fetch_assoc($result_pass);

			$validacionPass = $arraypass['validacion_password'];

			if($validacionPass != 0 || !(is_null($validacionPass))){
				$pass = true;				
			}

		}

		if ($user == true && $pass == true) {
			return $validacionPass;

		}else{

			if($user){
                print "<script>alert('CONTRASEÑA INCORRECTA')</script>";
                print("<script>window.location.replace('../View/Index.php');</script>");
            }elseif($pass){
                print "<script>alert('USUARIO INCORRECTO')</script>";
                print("<script>window.location.replace('../View/Index.php');</script>");
            }elseif($user==false && $pass==false){
                print "<script>alert('USUARIO NO EXISTE')</script>";
                print("<script>window.location.replace('../View/Index.php');</script>");
            }

		}


	}

	public function getUsuarioPerfil($usuario_codigo){

		$consulta_perfil ="SELECT p.perfil_nombre
							FROM tb_itemusuarioperfil iu 
							JOIN tb_perfil p ON p.perfil_codigo = iu.perfil_codigo
							WHERE iu.usuario_codigo =".$usuario_codigo.";";

		$result_perfil = pg_query($consulta_perfil);

		return $result_perfil;
	}

	public function getUsuarioCarrera($usuario_codigo){

		$consulta_usuario_carrera = " SELECT p.proaca_codigoprograma , p.proaca_nombre 
									  FROM tb_itemusuarioprogramaacademico i
									  JOIN tb_programaacademico p ON p.proaca_codigo = i.proaca_codigo
									  WHERE usuario_codigo=".$usuario_codigo.";";

		$result_usuario_carrera = pg_query($consulta_usuario_carrera);
		
		return $result_usuario_carrera;

	}





}


?>