<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbEmpresa.php");

//var_dump($_REQUEST);

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';
echo "modulo:::".$modulo;
	if($modulo == 'grabarEmpresa' || $modulo == 'updateEmpresa'){

		$empresa_codigo = isset($_REQUEST['empresa_codigo'])?$_REQUEST['empresa_codigo']:0; 
		$tipdoc_codigo = isset($_REQUEST['s_tipodocumento'])?$_REQUEST['s_tipodocumento']:0; 
		$empresa_numerodocumento = isset($_REQUEST['empresa_numerodocumento'])?$_REQUEST['empresa_numerodocumento']:''; 
		$empresa_numerocamaracomercio = isset($_REQUEST['empresa_numerocamaracomercio'])?$_REQUEST['empresa_numerocamaracomercio']:'';
        $empresa_razonsocial = isset($_REQUEST['empresa_razonsocial'])?$_REQUEST['empresa_razonsocial']:''; 
        $empresa_telefono = isset($_REQUEST['empresa_telefono'])?$_REQUEST['empresa_telefono']:''; 
        $empresa_celular = isset($_REQUEST['empresa_celular'])?$_REQUEST['empresa_celular']:''; 
        $empresa_email = isset($_REQUEST['empresa_email'])?$_REQUEST['empresa_email']:'';
        $ciudad_codigo = isset($_REQUEST['s_ciudad'])?$_REQUEST['s_ciudad']:0; 
        $estado_codigo = isset($_REQUEST['s_estado'])?$_REQUEST['s_estado']:0; 
        $perfil_codigo = isset($_REQUEST['s_perfil'])?$_REQUEST['s_perfil']:0; 
        $empresa_usuario_login = isset($_REQUEST['empresa_usuario_login'])?$_REQUEST['empresa_usuario_login']:'';
        $empresa_password = isset($_REQUEST['empresa_password'])?$_REQUEST['empresa_password']:''; 
        $empresa_descripcionactividad = isset($_REQUEST['empresa_descripcionactividad'])?$_REQUEST['empresa_descripcionactividad']:''; 
        $empresa_web = isset($_REQUEST['empresa_web'])?$_REQUEST['empresa_web']:'';
		 
		$nuevoEmpresa = new TbEmpresaController();

		if($modulo == 'grabarEmpresa'){
			$nuevoEmpresa->setEmpresa($tipdoc_codigo, $empresa_numerodocumento, $empresa_numerocamaracomercio, 
							            $empresa_razonsocial, $empresa_telefono, $empresa_celular, $empresa_email, 
							            $ciudad_codigo, $estado_codigo, $perfil_codigo, $empresa_usuario_login, 
							            $empresa_password, $empresa_descripcionactividad, $empresa_web);
		}

		if($modulo == 'updateEmpresa'){

			$empresa_codigo = isset($_REQUEST['empresa_codigo'])?$_REQUEST['empresa_codigo']:0;
			$nuevoEmpresa->updateEmpresa($empresa_codigo, $tipdoc_codigo, $empresa_numerodocumento, $empresa_numerocamaracomercio, 
							            $empresa_razonsocial, $empresa_telefono, $empresa_celular, $empresa_email, 
							            $ciudad_codigo, $estado_codigo, $perfil_codigo, $empresa_usuario_login, 
							            $empresa_password, $empresa_descripcionactividad, $empresa_web);
		}


	}	

	if($modulo == 'deleteEmpresa'){

		$empresa_codigo = isset($_REQUEST['empresa_codigo'])?$_REQUEST['empresa_codigo']:0;
		$empresa = new TbEmpresaController();
		$empresa->deleteEmpresa($empresa_codigo);

	}

	
}

class TbEmpresaController{

	private $arrayEmpresa = array();


	function __construct(){

	}


	/*Debuelve arreglo asociativo arrayEmpresa*/
	public function getListaEmpresa(){

		$tbEmpresa = new TbEmpresa();

		$result = $tbEmpresa->resultListaEmpresa();
		
		$count = 0;

		while ($arrayEmp = pg_fetch_assoc($result)) {
			$this->arrayEmpresa[$count]['empresa_codigo'] = $arrayEmp['empresa_codigo'];
			$this->arrayEmpresa[$count]['empresa_numerocamaracomercio'] = $arrayEmp['empresa_numerocamaracomercio'];
			$this->arrayEmpresa[$count]['empresa_razonsocial'] = $arrayEmp['empresa_razonsocial'];
			$this->arrayEmpresa[$count]['empresa_descripcionactividad'] = $arrayEmp['empresa_descripcionactividad'];
			$count++;
		}		

		return $this->arrayEmpresa;	

	}

	public function getListaEmpresaId($id){

		$tbEmpersa = new TbEmpresa();

		$result = $tbEmpersa->resultListaEmpresaId($id);
		
		$count = 0;

		while ($arrayEmp = pg_fetch_assoc($result)) {

			$this->arrayEmpresa[$count]['empresa_codigo'] = $arrayEmp['empresa_codigo'];
			$this->arrayEmpresa[$count]['tipdoc_codigo'] = $arrayEmp['tipdoc_codigo'];
			$this->arrayEmpresa[$count]['empresa_numerodocumento'] = $arrayEmp['empresa_numerodocumento'];
			$this->arrayEmpresa[$count]['empresa_numerocamaracomercio'] = $arrayEmp['empresa_numerocamaracomercio'];
			$this->arrayEmpresa[$count]['empresa_razonsocial'] = $arrayEmp['empresa_razonsocial'];
			$this->arrayEmpresa[$count]['empresa_telefono'] = $arrayEmp['empresa_telefono'];
			$this->arrayEmpresa[$count]['empresa_celular'] = $arrayEmp['empresa_celular'];
			$this->arrayEmpresa[$count]['empresa_email'] = $arrayEmp['empresa_email'];
			$this->arrayEmpresa[$count]['ciudad_codigo'] = $arrayEmp['ciudad_codigo'];
			$this->arrayEmpresa[$count]['estado_codigo'] = $arrayEmp['estado_codigo'];
			$this->arrayEmpresa[$count]['perfil_codigo'] = $arrayEmp['perfil_codigo'];
			$this->arrayEmpresa[$count]['empresa_usuario_login'] = $arrayEmp['empresa_usuario_login'];
			$this->arrayEmpresa[$count]['empresa_password'] = $arrayEmp['empresa_password'];
			$this->arrayEmpresa[$count]['empresa_descripcionactividad'] = $arrayEmp['empresa_descripcionactividad'];
			$this->arrayEmpresa[$count]['empresa_web'] = $arrayEmp['empresa_web'];
			$this->arrayEmpresa[$count]['pais_codigo'] = $arrayEmp['pais_codigo'];
			$this->arrayEmpresa[$count]['departamento_codigo'] = $arrayEmp['departamento_codigo'];
			$this->arrayEmpresa[$count]['departamento_nombre'] = $arrayEmp['departamento_nombre'];
			$this->arrayEmpresa[$count]['ciudad_nombre'] = $arrayEmp['ciudad_nombre'];
			$count++;
		}		

		return $this->arrayEmpresa;	

	}

	public function setEmpresa($tipdoc_codigo, $empresa_numerodocumento, $empresa_numerocamaracomercio, 
							            $empresa_razonsocial, $empresa_telefono, $empresa_celular, $empresa_email, 
							            $ciudad_codigo, $estado_codigo, $perfil_codigo, $empresa_usuario_login, 
							            $empresa_password, $empresa_descripcionactividad, $empresa_web){

		$empresa = new TbEmpresa();

		$empresa->setTipdocCodigo($tipdoc_codigo);
		$empresa->setEmpresaNumerodocumento($empresa_numerodocumento);
		$empresa->setEmpresaNumerocamaracomercio($empresa_numerocamaracomercio);
		$empresa->setEmpresaRazonsocial($empresa_razonsocial);
		$empresa->setEmpresaTelefono($empresa_telefono);
		$empresa->setEmpresaCelular($empresa_celular);
		$empresa->setEmpresaEmail($empresa_email);
		$empresa->setCiudadCodigo($ciudad_codigo);
		$empresa->setEstadoCodigo($estado_codigo);
		$empresa->setPerfilCodigo($perfil_codigo);
		$empresa->setEmpresaUsuarioLogin($empresa_usuario_login);
		$empresa->setEmpresaPassword($empresa_password);
		$empresa->setEmpresaDescripcionactividad($empresa_descripcionactividad);
		$empresa->setEmpresaWeb($empresa_web);		
        $set = $empresa->save($empresa);

        $mensaje = $set;
		print "<script>alert('$mensaje')</script>";
	 	print("<script>window.location.replace('../View/Modulos/Empresa/Home.php');</script>");

	}

	public function updateEmpresa($empresa_codigo, $tipdoc_codigo, $empresa_numerodocumento, $empresa_numerocamaracomercio, 
							            $empresa_razonsocial, $empresa_telefono, $empresa_celular, $empresa_email, 
							            $ciudad_codigo, $estado_codigo, $perfil_codigo, $empresa_usuario_login, 
							            $empresa_password, $empresa_descripcionactividad, $empresa_web){

		$empresa = new TbEmpresa();

		$empresa->setEmpresaCodigo($empresa_codigo);
		$empresa->setTipdocCodigo($tipdoc_codigo);
		$empresa->setEmpresaNumerodocumento($empresa_numerodocumento);
		$empresa->setEmpresaNumerocamaracomercio($empresa_numerocamaracomercio);
		$empresa->setEmpresaRazonsocial($empresa_razonsocial);
		$empresa->setEmpresaTelefono($empresa_telefono);
		$empresa->setEmpresaCelular($empresa_celular);
		$empresa->setEmpresaEmail($empresa_email);
		$empresa->setCiudadCodigo($ciudad_codigo);
		$empresa->setEstadoCodigo($estado_codigo);
		$empresa->setPerfilCodigo($perfil_codigo);
		$empresa->setEmpresaUsuarioLogin($empresa_usuario_login);
		$empresa->setEmpresaPassword($empresa_password);
		$empresa->setEmpresaDescripcionactividad($empresa_descripcionactividad);
		$empresa->setEmpresaWeb($empresa_web);	
        $set = $empresa->update($empresa);

        $mensaje = $set;
		print "<script>alert('$mensaje')</script>";
	 	print("<script>window.location.replace('../View/Modulos/Empresa/Home.php');</script>");

	}

	public function deleteEmpresa($id){

		$empresa = new TbEmpresa();
		$delete = $empresa->delete($id);
        $mensaje = $delete;
		print "<script>alert('$mensaje')</script>";
	 	print("<script>window.location.replace('../View/Modulos/Empresa/Home.php');</script>");
	}
	
}

?>