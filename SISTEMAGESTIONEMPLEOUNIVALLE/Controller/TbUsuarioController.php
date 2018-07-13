<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbUsuario.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbEmpresa.php");

//var_dump($_REQUEST);

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';

	if($modulo == 'grabarUsuario' || $modulo == 'updateUsuario'){

		$tipdoc_codigo = isset($_REQUEST['s_tipodocumento'])?$_REQUEST['s_tipodocumento']:0;
		$usuario_numeroidentificacion = isset($_REQUEST['usuario_numeroidentificacion'])?$_REQUEST['usuario_numeroidentificacion']:'';
		$usuario_nombres = isset($_REQUEST['usuario_nombres'])?$_REQUEST['usuario_nombres']:'';
		$usuario_apellidos = isset($_REQUEST['usuario_apellidos'])?$_REQUEST['usuario_apellidos']:'';
		$usuario_fechanacimiento = isset($_REQUEST['usuario_fechanacimiento'])?date('Y-m-d',strtotime($_REQUEST['usuario_fechanacimiento'])):'';
		$ciudad_codigo_nacimiento = isset($_REQUEST['ciudad_codigo_nacimiento'])?$_REQUEST['ciudad_codigo_nacimiento']:0;
		$usuario_sexo = isset($_REQUEST['usuario_sexo'])?$_REQUEST['usuario_sexo']:'';
		$usuario_telefono = isset($_REQUEST['usuario_telefono'])?$_REQUEST['usuario_telefono']:'';
		$usuario_celular = isset($_REQUEST['usuario_celular'])?$_REQUEST['usuario_celular']:'';
		$usuario_email = isset($_REQUEST['usuario_email'])?$_REQUEST['usuario_email']:'';
		$estado_codigo = isset($_REQUEST['s_estado'])?$_REQUEST['s_estado']:0;
		$perfil_codigo = isset($_REQUEST['s_perfil'])?$_REQUEST['s_perfil']:0;
		$usuario_usuario_login = isset($_REQUEST['usuario_usuario_login'])?$_REQUEST['usuario_usuario_login']:'';
		$usuario_password = isset($_REQUEST['usuario_password'])?$_REQUEST['usuario_password']:'';
		$tipfor_codigo = isset($_REQUEST['s_tipoformacion'])?$_REQUEST['s_tipoformacion']:0;
		$usuario_estudiantehabilitado = isset($_REQUEST['usuario_estudiantehabilitado'])?$_REQUEST['usuario_estudiantehabilitado']:0;
		$proaca_codigo = isset($_REQUEST['s_programaacademico'])?$_REQUEST['s_programaacademico']:0;
		$iteentestsed_codigo = isset($_REQUEST['s_itementidadestudio'])?$_REQUEST['s_itementidadestudio']:0;
		$ciudad_codigo = isset($_REQUEST['s_ciudad'])?$_REQUEST['s_ciudad']:0;
		$usuario_descripcionperfil = isset($_REQUEST['usuario_descripcionperfil'])?$_REQUEST['usuario_descripcionperfil']:'';
		$usuario_hojadevida = isset($_REQUEST['usuario_hojadevida'])?$_REQUEST['usuario_hojadevida']:'';
		$usuario_codigoestudiante = isset($_REQUEST['usuario_codigoestudiante'])?$_REQUEST['usuario_codigoestudiante']:0;
		 
		if($tipfor_codigo == '4' && $usuario_estudiantehabilitado == 'off'){//ESTUDIANTE ACTUAL

			$mensaje = "Si es estudiante debe estar en los últimos tres semestres ";
			print "<script>alert('$mensaje')</script>";
		 	print("<script>window.location.replace('../View/Modulos/Usuario/Home.php');</script>");

		}else{

			$nuevoUsuario = new TbUsuarioController();

			if($modulo == 'grabarUsuario'){
				$usuario_estudiantehabilitado = $nuevoUsuario->validaUsuarioHabilitado($usuario_estudiantehabilitado);
				$nuevoUsuario->setUsuario($tipdoc_codigo, $usuario_numeroidentificacion,
				            $usuario_nombres, $usuario_apellidos, $usuario_fechanacimiento,
				            $ciudad_codigo_nacimiento, $usuario_sexo, $usuario_telefono, $usuario_celular,
				            $usuario_email, $estado_codigo, $perfil_codigo, $usuario_usuario_login,
				            $usuario_password, $tipfor_codigo, $usuario_estudiantehabilitado,
				            $proaca_codigo, $iteentestsed_codigo, $ciudad_codigo, $usuario_descripcionperfil,
				            $usuario_hojadevida, $usuario_codigoestudiante);
			}

			if($modulo == 'updateUsuario'){

				$usuario_codigo = isset($_REQUEST['usuario_codigo'])?$_REQUEST['usuario_codigo']:0;
				$usuario_estudiantehabilitado = $nuevoUsuario->validaUsuarioHabilitado($usuario_estudiantehabilitado);
				$nuevoUsuario->updateUsuario($usuario_codigo, $tipdoc_codigo, $usuario_numeroidentificacion,
				            $usuario_nombres, $usuario_apellidos, $usuario_fechanacimiento,
				            $ciudad_codigo_nacimiento, $usuario_sexo, $usuario_telefono, $usuario_celular,
				            $usuario_email, $estado_codigo, $perfil_codigo, $usuario_usuario_login,
				            $usuario_password, $tipfor_codigo, $usuario_estudiantehabilitado,
				            $proaca_codigo, $iteentestsed_codigo, $ciudad_codigo, $usuario_descripcionperfil,
				            $usuario_hojadevida, $usuario_codigoestudiante);
			}

		}


	}	

	if($modulo == 'deleteUsuario'){

		$usuario_codigo = isset($_REQUEST['usuario_codigo'])?$_REQUEST['usuario_codigo']:0;
		$usuario = new TbUsuarioController();
		$usuario->deleteUsuario($usuario_codigo);

	}

	if($modulo == 'ingresoLogin'){

		$usuario_usuario_login = isset($_REQUEST['usuario_usuario_login'])?$_REQUEST['usuario_usuario_login']:0;
		$usuario_password = isset($_REQUEST['usuario_password'])?$_REQUEST['usuario_password']:'';
		$tipo_perfil = isset($_REQUEST['s_perfil_inicio'])?$_REQUEST['s_perfil_inicio']:'';
		$usuario_descripcionperfil = isset($_REQUEST['usuario_descripcionperfil'])?$_REQUEST['usuario_descripcionperfil']:'';

		$usuario = new TbUsuarioController();
		$usuario->validaLogin($usuario_usuario_login, $usuario_password, $tipo_perfil);


	}

	if($modulo == 'updateUsuarioContacto'){

		$usuario_codigo = isset($_REQUEST['usuario_codigo'])?$_REQUEST['usuario_codigo']:0;
		$usuario_telefono = isset($_REQUEST['usuario_telefono'])?$_REQUEST['usuario_telefono']:'';
		$usuario_celular = isset($_REQUEST['usuario_celular'])?$_REQUEST['usuario_celular']:'';
		$usuario_email = isset($_REQUEST['usuario_email'])?$_REQUEST['usuario_email']:'';
		$usuario_usuario_login = isset($_REQUEST['usuario_usuario_login'])?$_REQUEST['usuario_usuario_login']:'';
		$usuario_password = isset($_REQUEST['usuario_password'])?$_REQUEST['usuario_password']:'';
		
		$usuario = new TbUsuarioController();
		$usuario->updateUsuarioContactoSesion($usuario_codigo, $usuario_telefono, $usuario_celular, $usuario_email, $usuario_usuario_login, $usuario_password);

	}

	
}

class TbUsuarioController{

	private $arrayUsuarioContacto = array();


	function __construct(){

	}


	/*Debuelve arreglo asociativo arrayUsuarioContacto*/
	public function getListaUsuarioContacto(){

		$tbUsurario = new TbUsuario();

		$result = $tbUsurario->resultListaUsuarioContacto();
		
		$count = 0;

		while ($arrayUsuContact = pg_fetch_assoc($result)) {
			$this->arrayUsuarioContacto[$count]['usuario_codigo'] = $arrayUsuContact['usuario_codigo'];
			$this->arrayUsuarioContacto[$count]['usuario_nombres'] = $arrayUsuContact['usuario_nombres'];
			$this->arrayUsuarioContacto[$count]['usuario_apellidos'] = $arrayUsuContact['usuario_apellidos'];
			$this->arrayUsuarioContacto[$count]['usuario_titulootorgado'] = $arrayUsuContact['usuario_titulootorgado'];
			$this->arrayUsuarioContacto[$count]['entest_nombre'] = $arrayUsuContact['entest_nombre'];
			$count++;
		}		

		return $this->arrayUsuarioContacto;	

	}
	/*Debuelve arreglo asociativo arrayUsuarioContacto*/
	public function getListaUsuarioContactoPorPrograma($proaca_codigo){

		$tbUsurario = new TbUsuario();

		$result = $tbUsurario->resultListaUsuarioContactoPorPrograma($proaca_codigo);
		
		$count = 0;

		while ($arrayUsuContact = pg_fetch_assoc($result)) {
			$this->arrayUsuarioContacto[$count]['usuario_codigo'] = $arrayUsuContact['usuario_codigo'];
			$this->arrayUsuarioContacto[$count]['usuario_nombres'] = $arrayUsuContact['usuario_nombres'];
			$this->arrayUsuarioContacto[$count]['usuario_apellidos'] = $arrayUsuContact['usuario_apellidos'];
			$this->arrayUsuarioContacto[$count]['usuario_titulootorgado'] = $arrayUsuContact['usuario_titulootorgado'];
			$this->arrayUsuarioContacto[$count]['entest_nombre'] = $arrayUsuContact['entest_nombre'];
			$count++;
		}		

		return $this->arrayUsuarioContacto;	

	}

	public function getListaConsultaUsuario($iteentestsed_codigo, $ano, $mes){

		$tbUsurario = new TbUsuario();

		$result = $tbUsurario->resultListaConsultaUsuario($iteentestsed_codigo, $ano, $mes);
		
		$count = 0;

		while ($arrayUsuContact = pg_fetch_assoc($result)) {
			$this->arrayUsuarioContacto[$count]['usuario_codigo'] = $arrayUsuContact['usuario_codigo'];
			$this->arrayUsuarioContacto[$count]['usuario_nombres'] = $arrayUsuContact['usuario_nombres'];
			$this->arrayUsuarioContacto[$count]['usuario_apellidos'] = $arrayUsuContact['usuario_apellidos'];
			$this->arrayUsuarioContacto[$count]['usuario_titulootorgado'] = $arrayUsuContact['usuario_titulootorgado'];
			$this->arrayUsuarioContacto[$count]['entest_nombre'] = $arrayUsuContact['entest_nombre'];
			$count++;
		}		

		return $this->arrayUsuarioContacto;	

	}

	public function getListaUsuarioSesion($perfilsesion){

		$tbUsurario = new TbUsuario();

		if($perfilsesion == 'ADMINISTRADOR'){

			$result = $tbUsurario->resultListaUsuario();
			//resultListaUsuarioPerfilsesion
			$count = 0;

			while ($arrayUsuContact = pg_fetch_assoc($result)) {
				$this->arrayUsuarioContacto[$count]['usuario_codigo'] = $arrayUsuContact['usuario_codigo'];
				$this->arrayUsuarioContacto[$count]['usuario_nombres'] = $arrayUsuContact['usuario_nombres'];
				$this->arrayUsuarioContacto[$count]['usuario_apellidos'] = $arrayUsuContact['usuario_apellidos'];
				$this->arrayUsuarioContacto[$count]['usuario_titulootorgado'] = $arrayUsuContact['usuario_titulootorgado'];
				$this->arrayUsuarioContacto[$count]['entest_nombre'] = $arrayUsuContact['entest_nombre'];
				$this->arrayUsuarioContacto[$count]['perfil_descripcion'] = $arrayUsuContact['perfil_descripcion'];
				$count++;
			}		

			return $this->arrayUsuarioContacto;	

		}else{

			$result = $tbUsurario->resultListaUsuarioPerfilsesion();
			//resultListaUsuarioPerfilsesion
			$count = 0;

			while ($arrayUsuContact = pg_fetch_assoc($result)) {
				$this->arrayUsuarioContacto[$count]['usuario_codigo'] = $arrayUsuContact['usuario_codigo'];
				$this->arrayUsuarioContacto[$count]['usuario_nombres'] = $arrayUsuContact['usuario_nombres'];
				$this->arrayUsuarioContacto[$count]['usuario_apellidos'] = $arrayUsuContact['usuario_apellidos'];
				$this->arrayUsuarioContacto[$count]['usuario_titulootorgado'] = $arrayUsuContact['usuario_titulootorgado'];
				$this->arrayUsuarioContacto[$count]['entest_nombre'] = $arrayUsuContact['entest_nombre'];
				$this->arrayUsuarioContacto[$count]['perfil_descripcion'] = $arrayUsuContact['perfil_descripcion'];
				$count++;
			}		

			return $this->arrayUsuarioContacto;	

		}

	}


	/*Debuelve arreglo asociativo arrayUsuarioContacto*/
	public function getListaUsuario(){

		$tbUsurario = new TbUsuario();

		$result = $tbUsurario->resultListaUsuario();
		
		$count = 0;

		while ($arrayUsuContact = pg_fetch_assoc($result)) {
			$this->arrayUsuarioContacto[$count]['usuario_codigo'] = $arrayUsuContact['usuario_codigo'];
			$this->arrayUsuarioContacto[$count]['usuario_nombres'] = $arrayUsuContact['usuario_nombres'];
			$this->arrayUsuarioContacto[$count]['usuario_apellidos'] = $arrayUsuContact['usuario_apellidos'];
			$this->arrayUsuarioContacto[$count]['usuario_titulootorgado'] = $arrayUsuContact['usuario_titulootorgado'];
			$this->arrayUsuarioContacto[$count]['entest_nombre'] = $arrayUsuContact['entest_nombre'];
			$this->arrayUsuarioContacto[$count]['perfil_descripcion'] = $arrayUsuContact['perfil_descripcion'];
			$count++;
		}		

		return $this->arrayUsuarioContacto;	

	}

	public function getListaUsuarioId($id){

		$tbUsurario = new TbUsuario();

		$result = $tbUsurario->resultListaUsuarioId($id);
		
		$count = 0;

		while ($arrayUsuContact = pg_fetch_assoc($result)) {
			$this->arrayUsuarioContacto[$count]['tipdoc_codigo'] = $arrayUsuContact['tipdoc_codigo'];
			$this->arrayUsuarioContacto[$count]['usuario_numeroidentificacion'] = $arrayUsuContact['usuario_numeroidentificacion'];
			$this->arrayUsuarioContacto[$count]['usuario_nombres'] = $arrayUsuContact['usuario_nombres'];
			$this->arrayUsuarioContacto[$count]['usuario_apellidos'] = $arrayUsuContact['usuario_apellidos'];
			$this->arrayUsuarioContacto[$count]['usuario_fechanacimiento'] = $arrayUsuContact['usuario_fechanacimiento'];
			$this->arrayUsuarioContacto[$count]['ciudad_codigo_nacimiento'] = $arrayUsuContact['ciudad_codigo_nacimiento'];
			$this->arrayUsuarioContacto[$count]['usuario_sexo'] = $arrayUsuContact['usuario_sexo'];
			$this->arrayUsuarioContacto[$count]['usuario_telefono'] = $arrayUsuContact['usuario_telefono'];
			$this->arrayUsuarioContacto[$count]['usuario_celular'] = $arrayUsuContact['usuario_celular'];
			$this->arrayUsuarioContacto[$count]['usuario_email'] = $arrayUsuContact['usuario_email'];
			$this->arrayUsuarioContacto[$count]['estado_codigo'] = $arrayUsuContact['estado_codigo'];
			$this->arrayUsuarioContacto[$count]['perfil_codigo'] = $arrayUsuContact['perfil_codigo'];
			$this->arrayUsuarioContacto[$count]['usuario_usuario_login'] = $arrayUsuContact['usuario_usuario_login'];
			$this->arrayUsuarioContacto[$count]['usuario_password'] = $arrayUsuContact['usuario_password'];
			$this->arrayUsuarioContacto[$count]['tipfor_codigo'] = $arrayUsuContact['tipfor_codigo'];
			$this->arrayUsuarioContacto[$count]['usuario_estudiantehabilitado'] = $arrayUsuContact['usuario_estudiantehabilitado'];
			$this->arrayUsuarioContacto[$count]['proaca_codigo'] = $arrayUsuContact['proaca_codigo'];
			$this->arrayUsuarioContacto[$count]['iteentestsed_codigo'] = $arrayUsuContact['iteentestsed_codigo'];
			$this->arrayUsuarioContacto[$count]['ciudad_codigo'] = $arrayUsuContact['ciudad_codigo'];
			$this->arrayUsuarioContacto[$count]['usuario_descripcionperfil'] = $arrayUsuContact['usuario_descripcionperfil'];
			$this->arrayUsuarioContacto[$count]['usuario_hojadevida'] = $arrayUsuContact['usuario_hojadevida'];
			$this->arrayUsuarioContacto[$count]['usuario_codigoestudiante'] = $arrayUsuContact['usuario_codigoestudiante'];
			$this->arrayUsuarioContacto[$count]['entest_codigo'] = $arrayUsuContact['entest_codigo'];
			$this->arrayUsuarioContacto[$count]['pais_codigo'] = $arrayUsuContact['pais_codigo'];
			$this->arrayUsuarioContacto[$count]['departamento_codigo'] = $arrayUsuContact['departamento_codigo'];
			$this->arrayUsuarioContacto[$count]['departamento_nombre'] = $arrayUsuContact['departamento_nombre'];
			$this->arrayUsuarioContacto[$count]['iteentestsed_nombre'] = $arrayUsuContact['iteentestsed_nombre'];
			$this->arrayUsuarioContacto[$count]['ciudad_nombre'] = $arrayUsuContact['ciudad_nombre'];
			$this->arrayUsuarioContacto[$count]['proaca_nombre'] = $arrayUsuContact['proaca_nombre'];
			$this->arrayUsuarioContacto[$count]['entest_nombre'] = $arrayUsuContact['entest_nombre'];
			$this->arrayUsuarioContacto[$count]['tipfor_descripcion'] = $arrayUsuContact['tipfor_descripcion'];
			$count++;
		}		

		return $this->arrayUsuarioContacto;	

	}

	public function setUsuario($tipdoc_codigo, $usuario_numeroidentificacion,
            $usuario_nombres, $usuario_apellidos, $usuario_fechanacimiento,
            $ciudad_codigo_nacimiento, $usuario_sexo, $usuario_telefono, $usuario_celular,
            $usuario_email, $estado_codigo, $perfil_codigo, $usuario_usuario_login,
            $usuario_password, $tipfor_codigo, $usuario_estudiantehabilitado,
            $proaca_codigo, $iteentestsed_codigo, $ciudad_codigo, $usuario_descripcionperfil,
            $usuario_hojadevida, $usuario_codigoestudiante){

		$usuario = new TbUsuario();

		$usuario->setTipdocCodigo($tipdoc_codigo); 
		$usuario->setUsuarioNumeroidentificacion($usuario_numeroidentificacion);
        $usuario->setUsuarioNombres($usuario_nombres); 
        $usuario->setUsuarioApellidos($usuario_apellidos); 
        $usuario->setUsuarioFechanacimiento($usuario_fechanacimiento);
        $usuario->setCiudadCodigoNacimiento($ciudad_codigo_nacimiento); 
        $usuario->setUsuarioSexo($usuario_sexo); 
        $usuario->setUsuarioTelefono($usuario_telefono); 
        $usuario->setUsuarioCelular($usuario_celular);
        $usuario->setUsuarioEmail($usuario_email); 
        $usuario->setEstadoCodigo($estado_codigo); 
        $usuario->setPerfilCodigo($perfil_codigo); 
        $usuario->setUsuarioUsuarioLogin($usuario_usuario_login);
        $usuario->setUsuarioPassword($usuario_password); 
        $usuario->setTipforCodigo($tipfor_codigo);
        $usuario->setUsuarioEstudiantehabilitado($usuario_estudiantehabilitado);
        $usuario->setProacaCodigo($proaca_codigo); 
        $usuario->setIteentestsedCodigo($iteentestsed_codigo); 
        $usuario->setCiudadCodigo($ciudad_codigo); 
        $usuario->setUsuarioDescripcionperfil($usuario_descripcionperfil);
        $usuario->setUsuarioHojadevida($usuario_hojadevida); 
        $usuario->setUsuarioCodigoestudiante($usuario_codigoestudiante);
        $set = $usuario->save($usuario);

        $mensaje = $set;
		print "<script>alert('$mensaje')</script>";
	 	print("<script>window.location.replace('../View/Modulos/Usuario/Home.php');</script>");

	}

	public function updateUsuario($usuario_codigo, $tipdoc_codigo, $usuario_numeroidentificacion,
            $usuario_nombres, $usuario_apellidos, $usuario_fechanacimiento,
            $ciudad_codigo_nacimiento, $usuario_sexo, $usuario_telefono, $usuario_celular,
            $usuario_email, $estado_codigo, $perfil_codigo, $usuario_usuario_login,
            $usuario_password, $tipfor_codigo, $usuario_estudiantehabilitado,
            $proaca_codigo, $iteentestsed_codigo, $ciudad_codigo, $usuario_descripcionperfil,
            $usuario_hojadevida, $usuario_codigoestudiante){

		$usuario = new TbUsuario();

		$usuario->setUsuarioCodigo($usuario_codigo); 
		$usuario->setTipdocCodigo($tipdoc_codigo); 
		$usuario->setUsuarioNumeroidentificacion($usuario_numeroidentificacion);
        $usuario->setUsuarioNombres($usuario_nombres); 
        $usuario->setUsuarioApellidos($usuario_apellidos); 
        $usuario->setUsuarioFechanacimiento($usuario_fechanacimiento);
        $usuario->setCiudadCodigoNacimiento($ciudad_codigo_nacimiento); 
        $usuario->setUsuarioSexo($usuario_sexo); 
        $usuario->setUsuarioTelefono($usuario_telefono); 
        $usuario->setUsuarioCelular($usuario_celular);
        $usuario->setUsuarioEmail($usuario_email); 
        $usuario->setEstadoCodigo($estado_codigo); 
        $usuario->setPerfilCodigo($perfil_codigo); 
        $usuario->setUsuarioUsuarioLogin($usuario_usuario_login);
        $usuario->setUsuarioPassword($usuario_password); 
        $usuario->setTipforCodigo($tipfor_codigo);
        $usuario->setUsuarioEstudiantehabilitado($usuario_estudiantehabilitado);
        $usuario->setProacaCodigo($proaca_codigo); 
        $usuario->setIteentestsedCodigo($iteentestsed_codigo); 
        $usuario->setCiudadCodigo($ciudad_codigo); 
        $usuario->setUsuarioDescripcionperfil($usuario_descripcionperfil);
        $usuario->setUsuarioHojadevida($usuario_hojadevida); 
        $usuario->setUsuarioCodigoestudiante($usuario_codigoestudiante);
        $set = $usuario->update($usuario);

        $mensaje = $set;
		print "<script>alert('$mensaje')</script>";
	 	print("<script>window.location.replace('../View/Modulos/Usuario/Home.php');</script>");

	}

	public function updateUsuarioContactoSesion($usuario_codigo, $usuario_telefono, $usuario_celular, $usuario_email, $usuario_usuario_login, $usuario_password){

		$usuario = new TbUsuario();

		$usuario->setUsuarioCodigo($usuario_codigo);
        $usuario->setUsuarioTelefono($usuario_telefono); 
        $usuario->setUsuarioCelular($usuario_celular);
        $usuario->setUsuarioEmail($usuario_email);         
        $usuario->setUsuarioUsuarioLogin($usuario_usuario_login);
        $usuario->setUsuarioPassword($usuario_password); 
        $set = $usuario->updateContactoSesion($usuario);

        $mensaje = $set;
		print "<script>alert('$mensaje')</script>";
	 	print("<script>window.location.replace('../View/Modulos/Usuario/usuarioContactoDetalle.php?usuario_codigo=".$usuario_codigo."');</script>");

	}

	public function deleteUsuario($id){

		$usuario = new TbUsuario();
		$delete = $usuario->delete($id);
        $mensaje = $delete;
		print "<script>alert('$mensaje')</script>";
	 	print("<script>window.location.replace('../View/Modulos/Usuario/Home.php');</script>");
	}

	public function validaUsuarioHabilitado($habilitado){

		if($habilitado != 0){
			if($habilitado){
				$habilitado = 1;
			}else{
				$habilitado = 0;
			}
		}

		return $habilitado;
	}

	public function validaLogin($usuario_usuario_login, $usuario_password, $tipo_perfil){

		if($tipo_perfil == 'USUARIO'){

			$usuario = new TbUsuario();
			$codigo_usuario = $usuario->validaLogin($usuario_usuario_login, $usuario_password);

			$usuarioIngreso = new TbUsuario();
			$result = $usuarioIngreso->validaPerfil($codigo_usuario);

			$mensaje = '';

		 	$arrayUsuario = pg_fetch_assoc($result);	

		 	$mensaje = 'Bienvenido '.$arrayUsuario['usuario_nombres']." ".$arrayUsuario['usuario_apellidos'];

		 	$_SESSION['perfil_descripcion'] = $arrayUsuario['perfil_descripcion'];
		 	$_SESSION['usuario_codigo'] = $arrayUsuario['usuario_codigo'];
		 	$_SESSION['usuario_nombrecompleto'] = $arrayUsuario['usuario_nombres']." ".$arrayUsuario['usuario_apellidos'];


		 	print "<script>alert('$mensaje')</script>";
		 	print("<script>window.location.replace('../View/user.php');</script>");

		}else{

			$empresa = new TbEmpresa();
			$codigo_empresa = $empresa->validaLoginEmpresa($usuario_usuario_login, $usuario_password);

			$usuarioIngreso = new TbEmpresa();
			$result = $usuarioIngreso->validaPerfilEmpresa($codigo_empresa);

			$mensaje = '';

		 	$arrayEmpresa = pg_fetch_assoc($result);	

		 	$mensaje = 'Bienvenidos '.$arrayEmpresa['empresa_razonsocial'];

		 	$_SESSION['perfil_descripcion'] = $arrayEmpresa['perfil_descripcion'];
		 	$_SESSION['usuario_codigo'] = $arrayEmpresa['empresa_codigo'];
		 	$_SESSION['usuario_nombrecompleto'] = $arrayEmpresa['empresa_razonsocial'];


		 	print "<script>alert('$mensaje')</script>";
		 	print("<script>window.location.replace('../View/user.php');</script>");

		}

		


	}



//print_r($this->arrayUsuarioContacto);
			/*while ($a = pg_fetch_assoc($result)) {
				echo $a['usuario_nombres']."<br>";
			}


foreach ($this->arrayUsuarioContacto as $key => $value) {
			echo "posicion:".$key.":".$value['usuario_nombres']."<br>";
		}
*/


}


?>