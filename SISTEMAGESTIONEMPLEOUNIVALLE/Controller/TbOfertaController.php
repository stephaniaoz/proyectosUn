<?php

include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbOferta.php");

//var_dump($_REQUEST);

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';

	if($modulo == 'grabarOferta'){

		$empresa_codigo = isset($_REQUEST['empresa_codigo'])?$_REQUEST['empresa_codigo']:''; 		
		$oferta_descripcion = isset($_REQUEST['oferta_descripcion'])?$_REQUEST['oferta_descripcion']:''; 		
		$estado_codigo = isset($_REQUEST['s_estado'])?$_REQUEST['s_estado']:''; 		
		 
		$nuevoOferta = new TbOfertaController();
		$nuevoOferta->setOferta($empresa_codigo, $oferta_descripcion, $estado_codigo);

	}	

	if($modulo == 'cerrarOferta'){

		$oferta_codigo = isset($_REQUEST['oferta_codigo'])?$_REQUEST['oferta_codigo']:0;
		$oferta = new TbOfertaController();
		$oferta->cerrarOferta($oferta_codigo);

	}
	
}

class TbOfertaController{


	private $arrayOferta = array();


	function __construct(){

	}


	/*Debuelve arreglo asociativo arrayOferta*/
	public function getListaOferta(){

		$tbOferta = new TbOferta();

		$result = $tbOferta->resultOferta();
		
		$count = 0;

		while ($arrayOf = pg_fetch_assoc($result)) {
			$this->arrayOferta[$count]['oferta_codigo'] = $arrayOf['oferta_codigo'];
			$this->arrayOferta[$count]['empresa_codigo'] = $arrayOf['empresa_codigo'];
			$this->arrayOferta[$count]['oferta_descripcion'] = $arrayOf['oferta_descripcion'];
			$this->arrayOferta[$count]['estado_codigo'] = $arrayOf['estado_codigo'];
			$this->arrayOferta[$count]['empresa_razonsocial'] = $arrayOf['empresa_razonsocial'];
			$this->arrayOferta[$count]['estado_descripcion'] = $arrayOf['estado_descripcion'];
			$count++;
		}	

		return $this->arrayOferta;	

	}

	public function setOferta($empresa_codigo, $oferta_descripcion, $estado_codigo){

		$oferta = new TbOferta();

		$oferta->setEmpresaCodigo($empresa_codigo);
		$oferta->setOfertaDescripcion($oferta_descripcion);
		$oferta->setEstadoCodigo($estado_codigo);
        $set = $oferta->save($oferta);

        $mensaje = $set;
		print "<script>alert('$mensaje')</script>";
	 	print("<script>window.location.replace('../View/Modulos/Oferta/Home.php');</script>");

	}


}