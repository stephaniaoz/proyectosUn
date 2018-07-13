<?php
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbItemoferta.php");

//var_dump($_REQUEST);

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';

	if($modulo == 'detalleOferta'){

			$oferta_codigo = isset($_REQUEST['oferta_codigo'])?$_REQUEST['oferta_codigo']:0; 		
			$facultad_codigo = isset($_REQUEST['s_facultad'])?$_REQUEST['s_facultad']:''; 		
			$iteofe_cantidadpersonas = isset($_REQUEST['iteofe_cantidadpersonas'])?$_REQUEST['iteofe_cantidadpersonas']:0;		
			$iteofe_descripcion = isset($_REQUEST['iteofe_descripcion'])?$_REQUEST['iteofe_descripcion']:'';

			$oferta = new TbItemofertaController();
			$oferta->setItemOferta($oferta_codigo, $facultad_codigo, $iteofe_cantidadpersonas, 
	        $iteofe_descripcion);
		

		}

}		

class TbItemofertaController{



	public function setItemOferta($oferta_codigo, $facultad_codigo, $iteofe_cantidadpersonas, 
        $iteofe_descripcion){


		$itemoferta = new TbItemoferta();

		$itemoferta->setOfertaCodigo($oferta_codigo);
		$itemoferta->setFacultadCodigo($facultad_codigo);
		$itemoferta->setIteofeCantidadpersonas($iteofe_cantidadpersonas);
		$itemoferta->setIteofeDescripcion($iteofe_descripcion);
        $set = $itemoferta->save($itemoferta);

        $mensaje = $set;
		print "<script>alert('$mensaje')</script>";
	 	print("<script>window.location.replace('../View/Modulos/Oferta/diligenciarDetalleOferta.php');</script>");

	}

}

?>