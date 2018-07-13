<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbProgramacionSemana.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbItemProgramacionSemanaController.php");

if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';

	if($modulo == "guardar_periodo"){

		$anno = isset($_REQUEST['anno'])?$_REQUEST['anno']:'';

		$corte = isset($_REQUEST['corte'])?$_REQUEST['corte']:'';

		$fechaInicial = isset($_REQUEST['fechaInicial'])?$_REQUEST['fechaInicial']:'';

		$fechaFinal = isset($_REQUEST['fechaFinal'])?$_REQUEST['fechaFinal']:'';

		
		$objtProCon = new TbProgramacionSemanaController();
		$objtProCon->guardarProgramacionSemana($anno, $corte,$fechaInicial,$fechaFinal);
	}


}


class TbProgramacionSemanaController{

	private $arraylistprosem = array();

	public function guardarProgramacionSemana($anno, $corte,$fechaI,$fechaF){

		$mensaje = "";
		$bandera = true;
		$arrayprogramacionsemanas = array();

		$fechaInicial = date($fechaI);
		$fechaFinal = date($fechaF);
		

		if($fechaInicial > $fechaFinal ){
			$mensaje = "Fecha inicial debe ser menor a la fecha final";

		}elseif($fechaFinal == $fechaInicial){
			$mensaje = "La Fechas inicial y final deben ser diferentes";
		}else{

			$objTbProSem = new TbProgramacionSemana();
			$validacion = $objTbProSem ->validarProgramacionSemana($anno, $corte);


			if($validacion == 'NO EXISTE'){

				$objTbItemProSemCon = new TbItemProgramacionSemanaController();
				$validacionItemProSem = $objTbItemProSemCon -> validarItemProSem($fechaInicial, $fechaFinal);

				if($validacionItemProSem == 'NO EXISTE'){

					$fechaInicialSemana = $fechaInicial;
					$i = 1;

					do{

						$fechanueva = strtotime('+1 week',strtotime($fechaInicialSemana));
						$fechainiciosiguientesemana = date('Y-m-d',$fechanueva);

						$fechanuevafinal = strtotime('-2 day',strtotime($fechainiciosiguientesemana));
						$fechafinalsemana = date('Y-m-d',$fechanuevafinal);

						$nombreSemana = "SEMANA ".$i;

						if($fechafinalsemana > $fechaFinal){
							$bandera = false;
							break;
						}else{

							
							$arrayprogramacionsemanas[$i]['nombre_semana'] = $nombreSemana;
							$arrayprogramacionsemanas[$i]['fechaInicialSemana'] = $fechaInicialSemana;
							$arrayprogramacionsemanas[$i]['fechaFinalSemana'] = $fechafinalsemana;

							$fechaInicialSemana = $fechainiciosiguientesemana;
							$i++;

						}		

					}while($fechafinalsemana != $fechaFinal);

					if($bandera){

						$validacionUpdate = $this->cambiarEstadoProSem();

						if($validacionUpdate){

							$objTbProSem = new TbProgramacionSemana();
							$result = $objTbProSem -> insertProgramacionSemana($anno, $corte,$fechaInicial,$fechaFinal,count($arrayprogramacionsemanas));

							$resultProgramacionSemana = $objTbProSem -> getProgramacionSemana($anno, $corte);

							$prosem_codigo = pg_fetch_assoc($resultProgramacionSemana);
							$codigoEncabezado = $prosem_codigo['prosem_codigo'];

							$objtItemProController = new TbItemProgramacionSemanaController();


							for($a=1; $a<=count($arrayprogramacionsemanas); $a++){

								$objtItemProController->guardarItemProSem($arrayprogramacionsemanas[$a]['nombre_semana'], $arrayprogramacionsemanas[$a]['fechaInicialSemana'] ,$arrayprogramacionsemanas[$a]['fechaFinalSemana'] ,$codigoEncabezado);
							}

						}else{
							$mensaje = "Consulta soporte";
						}

					}else{

						$mensaje = "Revisé las fechas de la programación";

						//echo "<pre>";
						//print_r($arrayprogramacionsemanas);	
					}

				}else{

					$mensaje = "No puede crear un programacion dentro un proramacion ya registrada";

				}


			}else{

				$mensaje = "El año y el periodo ingresado ya se encuentran en la bases de datos";

			}


		}

		if($mensaje != ""){
			print "<script>alert('$mensaje')</script>";
			print("<script>window.location.replace('../View/programacion/programacionSemana.php');</script>");
		}else{

			print "<script>alert('Ingreso exitoso')</script>";
			print("<script>window.location.replace('../View/programacion/programacionSemana.php');</script>");
		}

	}




	public function listarProgramacionSemana(){

		$objtTbProgramacionSemana = new TbProgramacionSemana();

		$listProSem = $objtTbProgramacionSemana->getAllProgramacionSemana();

		$count = 0;

		while ($arrayProSem = pg_fetch_assoc($listProSem)) {

			$this->arraylistprosem[$count]['prosem_codigo']= $arrayProSem['prosem_codigo'];
			$this->arraylistprosem[$count]['prosem_ano']= $arrayProSem['prosem_ano'];
			$this->arraylistprosem[$count]['corte_nombre']= $arrayProSem['corte_nombre'];
			$this->arraylistprosem[$count]['prosem_fechainicial']= $arrayProSem['prosem_fechainicial'];
			$this->arraylistprosem[$count]['prosem_fechafinal']= $arrayProSem['prosem_fechafinal'];
			$this->arraylistprosem[$count]['prosem_numerosemanas']= $arrayProSem['prosem_numerosemanas'];
			$this->arraylistprosem[$count]['estado_nombre']= $arrayProSem['estado_nombre'];

			$count++;
		}

		return $this->arraylistprosem;

	}

	public function cambiarEstadoProSem(){

		$objtProSem = new TbProgramacionSemana();
		$validacionUpdate = $objtProSem -> update_EstadoProSem();

		return $validacionUpdate;
		
	}

	public function buscarProgramacionSemanaActiva(){

		$objtProSem = new TbProgramacionSemana();
		$proSemCodigo = $objtProSem -> get_ProSemCodigoActiva();

		$prosem_codigo = pg_fetch_assoc($proSemCodigo);
		$proSemCodigoActivo = $prosem_codigo['prosem_codigo'];

		return $proSemCodigoActivo;

	} 

	

}



?>