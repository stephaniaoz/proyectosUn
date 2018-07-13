<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\db\database_utilities.php");


Class TbTiponovedad{


	public function listaTipoNovedad(){

		$consulta_novedad ="SELECT *
							FROM tb_tiponovedad t
							ORDER BY t.tipnov_nombre ";

		$result_novedad = pg_query($consulta_novedad);

		return $result_novedad;
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