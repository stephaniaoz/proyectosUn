<?php
include("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbSalon.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';
	$componente = isset($_REQUEST['componente'])?$_REQUEST['componente']:'';


	if($modulo == 'registrar_novedad'){

		if($componente == 'selecttiponovedad'){
			$objTbTipNov = new TbTiponovedadController();
			$objTbTipNov->listarTiposNovedad();
		}

	}

	if($modulo == 'ingreso_login'){

		$usuario_identificacion = isset($_REQUEST['usuario_identificacion'])?$_REQUEST['usuario_identificacion']:'';
		$usuario_password = isset($_REQUEST['usuario_password'])?$_REQUEST['usuario_password']:'';

		$objTbUsuarioController = new TbUsuarioController();
		$objTbUsuarioController->ingresoLogin($usuario_identificacion, $usuario_password);

	}

	if($modulo == 'ingreso_varios'){

		$select_perfil = isset($_REQUEST['select_perfil'])?$_REQUEST['select_perfil']:'0';

		$objTbUsuarioController = new TbUsuarioController();
		$objTbUsuarioController->ingresoPerfil($select_perfil);

	}

	if($modulo == 'ingreso_varios_carrera'){

		$select_carrera = isset($_REQUEST['select_carrera'])?$_REQUEST['select_carrera']:'0';

		$objTbUsuarioController = new TbUsuarioController();
		$objTbUsuarioController->ingresoPerfilCarrera($select_carrera);


	}


}

/**
* 
*/
class TbSalonController
{

	private $arraySalon = array();

	private $arrayUsuarioPerfil = array();
	private $arrayUsuarioCarrera =array();
	private $arrayListaMenu = array();

	function listaSalon(){

		$lista = "<option value='0'>Seleccione uno</option>";
		$obsalon = new TbTiponovedad();
		$result = $obsalon->listaTipoNovedad();


		$count = 0;

		while ($salones = pg_fetch_assoc($result)) {			
			$this->arraySalon[$count]= $salones['salon_codigo'];
			$this->arraySalon[$count]= $salones['salon_nombre'];
			$lista .= "<option value='".$salones['salon_codigo']."'>".$salones['salon_nombre']."</option>";
			$count++;
		}

		echo $lista;

	}
	
	
	/*
	* @comentario: valida los datos del usuario y permite tomar
	* los perfiles asociados en caso de que exista, redireccionando
	* a la pagina correspondiente con las condiciones del perfil.
	*/
	function ingresoLogin($identificacion,$password){

		$objTbUsuario = new TbUsuario();

		$usuario_codigo = $objTbUsuario->validarUsuario($identificacion,$password);

		$resultPerfil = $objTbUsuario->getUsuarioPerfil($usuario_codigo);


		$count = 0;

		while ($arrayUsuPer = pg_fetch_assoc($resultPerfil)) {
			$this->arrayUsuarioPerfil[$count]= $arrayUsuPer['perfil_nombre'];
			$count++;
		}

		if(count($this->arrayUsuarioPerfil) == 0){

			$mensaje = "EL USUARIO NO TIENE NINGUN PERFIL ASOCIADO";

	 		print "<script>alert('$mensaje')</script>";

			print("<script>window.location.replace('../View/Index.php');</script>");				

		}elseif(count($this->arrayUsuarioPerfil) > 1) {

			$mensaje = "BIENVENIDO A MAS DE UN PERFIL";
			$_SESSION['usuario_codigo'] = $usuario_codigo;
			$_SESSION['lista_perfil'] = $this->arrayUsuarioPerfil;

			$_SESSION['control_retorno'] = '0';

	 		print "<script>alert('$mensaje')</script>";
			print("<script>window.location.replace('../View/Ingreso/panel_ingreso.php');</script>");
			
		}else{

			$_SESSION['usuario_codigo'] = $usuario_codigo;
			$_SESSION['nombre_perfil_ingreso'] = $this->arrayUsuarioPerfil[0];
	
			$mensaje = 'BIENVENIDO USUARIO PERFIL '.$_SESSION['nombre_perfil_ingreso'];

			if($_SESSION['nombre_perfil_ingreso'] == 'DOCENTE'){
				print "<script>alert('$mensaje')</script>";
				print("<script>window.location.replace('../View/control_asistencia/listarAsistencia.php');</script>");
			}else{
				print "<script>alert('$mensaje')</script>";
				print("<script>window.location.replace('../View/Ingreso/Principal.php');</script>");
			}
		
		}

	}

	/*@comentarios: valida la opcion del perfil escogida por el usuario
	* si el perfil es coordinador, valida cuantas carreras tiene asociadas el usuario,
	* redireccionando a la pagina correspondiente con las carreras asociadas.
	* Si el usuario escoge otro perfil diferente a coordinador lo redirecciona
	* a la pagina correspondiente
	*/

	public function ingresoPerfil($select_perfil){

		$_SESSION['control_retorno'] = '0';

		if($select_perfil == '0'){

			$mensaje = 'SELECCIONE UNA OPCIÓN';
			print "<script>alert('$mensaje')</script>";
			print("<script>window.location.replace('../View/Ingreso/panel_ingreso.php');</script>");	

		}else{
			
			if($select_perfil == 'COORDINADOR'){

				$objTbUsuarioController = new TbUsuario();
				$usuarioCarrera = $objTbUsuarioController-> getUsuarioCarrera($_SESSION['usuario_codigo']);

					$count = 0;
					while ($arrayUsuCar = pg_fetch_assoc($usuarioCarrera)) {
						$this->arrayUsuarioCarrera[$count]= $arrayUsuCar['proaca_codigoprograma']." - ".$arrayUsuCar['proaca_nombre'];
						$count++;
					}

					if(count($this->arrayUsuarioCarrera)>1){

						$mensaje = "BIENVENIDO USUARIO CON VARIAS CARRERAS";
						
						$_SESSION['lista_usuario_carrera'] = $this->arrayUsuarioCarrera;
						$_SESSION['nombre_perfil_ingreso'] = $select_perfil;

				 		print "<script>alert('$mensaje')</script>";
						print("<script>window.location.replace('../View/Ingreso/panel_ingreso_carreras.php');</script>");

					}else{

						$_SESSION['nombre_perfil_ingreso'] = $select_perfil;
						$_SESSION['nombre_carrera_ingreso']=$this->arrayUsuarioCarrera[0];
						$mensaje = 'BIENVENIDO USUARIO PERFIL '.$select_perfil;

						print "<script>alert('$mensaje')</script>";
						print("<script>window.location.replace('../View/Ingreso/Principal.php');</script>");

					}

			}else{

				$_SESSION['nombre_perfil_ingreso'] = $select_perfil;

				$mensaje = 'BIENVENIDO USUARIO PERFIL '.$select_perfil;

				if($select_perfil == 'DOCENTE'){
					print "<script>alert('$mensaje')</script>";
					print("<script>window.location.replace('../View/control_asistencia/listarAsistencia.php');</script>");
				}else{
					print "<script>alert('$mensaje')</script>";
					print("<script>window.location.replace('../View/Ingreso/Principal.php');</script>");
				}

				
			}

		}

	}

	/*@comentarios: toma
	*/

	public function ingresoPerfilCarrera($select_carrera){

		if($select_carrera == '0'){

			$mensaje = "SELECCIONE UNA CARRERA";
						print "<script>alert('$mensaje')</script>";
						print("<script>window.location.replace('../View/Ingreso/panel_ingreso_carreras.php');</script>");

		}else{

			$_SESSION['nombre_carrera_ingreso'] = $select_carrera;
			$mensaje = 'BIENVENIDO USUARIO PERFIL CARRERA '.$select_carrera;
			print "<script>alert('$mensaje')</script>";
			print("<script>window.location.replace('../View/Ingreso/Principal.php');</script>");
		}



	}

	

	


}

?>