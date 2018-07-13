<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbItemusuariocalificacion.php");

//var_dump($_REQUEST);

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';

	if($modulo == 'grabarCalificacion'){

		$usuario_codigo = isset($_REQUEST['usuario_codigo'])?$_REQUEST['usuario_codigo']:0;
		$empresa_codigo = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:'';
		$iteusucal_estrellas = isset($_REQUEST['iteusucal_estrellas'])?$_REQUEST['iteusucal_estrellas']:'';
		$iteusucal_descripcion = isset($_REQUEST['iteusucal_descripcion'])?$_REQUEST['iteusucal_descripcion']:'';


		$calificacion = new TbItemusuariocalificacionController();
		$calificacion->setCalificacion($usuario_codigo, $empresa_codigo, $iteusucal_estrellas, 
            $iteusucal_descripcion);

	}
	
}


class TbItemusuariocalificacionController{

	private $arrayItemUsuarioCalifiacion = array();


	public function setCalificacion($usuario_codigo, $empresa_codigo, $iteusucal_estrellas, 
            $iteusucal_descripcion){

		$calificacion = new TbItemusuariocalificacion();

		$calificacion->setUsuarioCodigo($usuario_codigo);
		$calificacion->setEmpresaCodigo($empresa_codigo);
		$calificacion->setIteusucalEstrellas($iteusucal_estrellas);
		$calificacion->setIteusucalDescripcion($iteusucal_descripcion);
        $set = $calificacion->save($calificacion);

        $mensaje = $set;
		print "<script>alert('$mensaje')</script>";
	 	print("<script>window.location.replace('../View/Modulos/Usuario/Home.php');</script>");

	}

	

	/*Debuelve arreglo asociativo arrayItemUsuarioCalifiacion*/
	public function getListaCalifiacion($usuario_codigo){

		$tbCalifica = new TbItemusuariocalificacion();

		$result = $tbCalifica->resultListaItemCalificacionId($usuario_codigo);
		
		$count = 0;
		
		while ($arrayUsuCal = pg_fetch_assoc($result)) {
			$this->arrayItemUsuarioCalifiacion[$count]['empresa_codigo'] = $arrayUsuCal['empresa_codigo'];
			$this->arrayItemUsuarioCalifiacion[$count]['empresa_razonsocial'] = $arrayUsuCal['empresa_razonsocial'];
			$this->arrayItemUsuarioCalifiacion[$count]['iteusucal_estrellas'] = $arrayUsuCal['iteusucal_estrellas'];
			$this->arrayItemUsuarioCalifiacion[$count]['iteusucal_descripcion'] = $arrayUsuCal['iteusucal_descripcion'];
			$count++;
		}		

		return $this->arrayItemUsuarioCalifiacion;	

	}

}

?>