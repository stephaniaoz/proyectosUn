<?php
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbProgramacionacademica.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Model\TbItemprogramacionacademica.php");


if($_REQUEST){

	$modulo = isset($_REQUEST['modulo'])?$_REQUEST['modulo']:'';

	if($modulo == 'cargar_archivo_proaca'){

		//obtenemos el archivo .csv
		$tipo = $_FILES['archivo']['type'];		 
		$tamanio = $_FILES['archivo']['size'];		 
		$archivotmp = $_FILES['archivo']['tmp_name'];

		$sede_codigo = $_REQUEST['s_sede_codigo'];
		$prosem_codigo = $_REQUEST['s_prosem_codigo'];
		$proaca_observacion = $_REQUEST['area_observacion'];

		$obj = new TbProgramacionacademicaController();
		$obj->cargarArchivoProgramacionAcademica($sede_codigo, $prosem_codigo, $proaca_observacion, $tipo, $tamanio, $archivotmp);

	}

}

/**
* 
*/
class TbProgramacionacademicaController
{
	
	
	public function cargarArchivoProgramacionAcademica($sede_codigo, $prosem_codigo, $proaca_observacion, $tipo, $tamanio, $archivotmp){

		$validacion = "";
		$asignatura_codigo = "";
		$usuario_codigo = "";
		$dia_semana = "";
		$hora_inicio = "";
		$hora_fin = "";
		$salon_codigo = "";
		$grupo = "";
		$jornada_codigo = "";
		$proaca_codigo_programa = "";
		$fundamentacion_codigo = "";

		//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
		$i = 0;

		//cargamos el archivo
		$lineas = file($archivotmp);


		$objproaca = new TbProgramacionacademica();
		$result = $objproaca->crearEncabezadoProgramacion($sede_codigo, $prosem_codigo, $proaca_observacion);

		if($result){

			$objproaca = new TbProgramacionacademica();
			$proaca_codigo = $objproaca->validaEncabezadoProgramacion($sede_codigo, $prosem_codigo);

			if($proaca_codigo != 0){


				//Recorremos el bucle para leer línea por línea
				foreach ($lineas as $linea_num => $linea){ 
				   //abrimos bucle
				   /*si es diferente a 0 significa que no se encuentra en la primera línea 
				   (con los títulos de las columnas) y por lo tanto puede leerla*/
				   	if($i != 0){ 
				       	//abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
				      	/* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
				       	leyendo hasta que encuentre un ; */
				       	$datos = explode(";",$linea);

				       	$linea_i = $i + 1;
				 	
			 			/*echo "<pre>";
						print_r($datos);
						echo count($datos);
						//die();*/

						//la estructura del archivo tiene 10 columnas, no debe ser diferente.
						if(count($datos) == 10){

							//Almacenamos los datos que vamos leyendo en una variable

							$cod_asignatura = trim($datos[0]);

							if(is_null($cod_asignatura) || $cod_asignatura == ""){
								$validacion .= "El codigo de la asignatura en la linea ".$linea_i." debe diligenciarse<br>";
							}else{

								$proaca_as = new TbProgramacionacademica();
								$asignatura_codigo = $proaca_as->validaCampoCargue('asignatura_codigo', 'tb_asignatura', 'asignatura_codigoasignatura', $cod_asignatura);

								echo ("-->codigo--->".$asignatura_codigo);
								var_dump(($asignatura_codigo == '0'));

								if($asignatura_codigo == '0'){
									$validacion .= "El código de la asingatura ".$cod_asignatura." no existe en el sistema. Linea ".$linea_i."<br>";
								}

								$cedula_docente = trim($datos[1]);

								if(is_null($cedula_docente) || $cedula_docente == ""){
									$validacion .= "La cédula del docente en la linea ".$linea_i." debe diligenciarse<br>";
								}else{

									$proaca_us = new TbProgramacionacademica();
									$usuario_codigo = $proaca_us->validaCampoCargue('usuario_codigo', 'tb_usuario', 'usuario_identificacion', $cedula_docente);

									if($usuario_codigo == '0'){
										$validacion .= "El docente con cédula ".$cedula_docente." no existe en el sistema. Linea ".$linea_i."<br>";
									}

								}

								$dia_semana = trim($datos[2]);

								if(is_null($dia_semana) || $dia_semana == ""){
									$dia_semana = "null";
								}

								if($dia_semana != 'null'){
									if(!in_array($dia_semana, array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO'))){
										$validacion .= "El día de semama ".$dia_semana." no existe en el sistema. Linea ".$linea_i."<br>";
									}
								}

								//$hoy = date("H:i:s");                         // 17:16:18

								$hora_inicio = trim($datos[3]);

								if(is_null($hora_inicio) || $hora_inicio == ""){
									$hora_inicio = "null";
								}else{
									$hora_inicio = date($hora_inicio);
								}

								$hora_fin = trim($datos[4]);

								if(is_null($hora_fin) || $hora_fin == ""){
									$hora_fin = "null";
								}else{
									$hora_fin = date($hora_fin);
								}

								$abreviatura_salon = trim($datos[5]);

								if(is_null($abreviatura_salon) || $abreviatura_salon == ""){
									$salon_codigo = "null";
								}

								if($salon_codigo == "null"){
									$salon_codigo = "SALON ACORDADO";
								}else{
									$proaca_sa = new TbProgramacionacademica();
									$salon_codigo = $proaca_sa->validaCampoCargue('salon_codigo', 'tb_salon', 'salon_abreviatura', $abreviatura_salon);

									if($salon_codigo == '0'){
										$validacion .= "El salón con abreviatura ".$abreviatura_salon." no existe en el sistema. Linea ".$linea_i."<br>";
									}

								}

								$grupo = trim($datos[6]);

								if(is_null($grupo) || $grupo == ""){
									$grupo = "null";
								}

								$jornada = trim($datos[7]);

								if(is_null($jornada) || $jornada == ""){
									$jornada_codigo = "null";
								}

								if($jornada_codigo != 'null'){

									$proaca_jo = new TbProgramacionacademica();
									$jornada_codigo = $proaca_jo->validaCampoCargue('jornada_codigo', 'tb_jornada', 'jornada_abreviatura', $jornada);

									if($jornada_codigo == '0'){
										$validacion .= "La jornada con abreviatura ".$jornada." no existe en el sistema. Linea ".$linea_i."<br>";
									}

								}

								$plan = trim($datos[8]);

								var_dump(count(explode("-", $plan))>1);
								
								if(count(explode("-", $plan))>1){
									$validacion .= "El plan debe ser solo uno, revisar estructura del archivo. Linea ".$linea_i."<br>";
								}else{

									if(is_null($plan) || $plan == ""){
										$proaca_codigo_programa = "null";
									}

									if($proaca_codigo_programa != 'null'){
										$proaca_p = new TbProgramacionacademica();
										$proaca_codigo_programa = $proaca_p->validaCampoCargue('proaca_codigo', 'tb_programaacademico', 'proaca_codigoprograma', $plan);

										if($proaca_codigo_programa == '0'){
											$validacion .= "El plan codigo del plan ".$plan." no existe en el sistema. Linea ".$linea_i."<br>";
										}

									}

								}

													

								$fundamentacion = trim($datos[9]);

								if(is_null($fundamentacion) || $fundamentacion == ""){
									$fundamentacion_codigo = "null";
								}
								
								if($fundamentacion_codigo != "null"){
									$proaca_fu = new TbProgramacionacademica();
									$fundamentacion_codigo = $proaca_fu->validaCampoCargue('fundamentacion_codigo', 'tb_fundamentacion', 'fundamentacion_abreviatura', $fundamentacion);

									if($fundamentacion_codigo == '0'){
										$validacion .= "La fundamentación con abreviatura ".$fundamentacion." no existe en el sistema. Linea ".$linea_i."<br>";
									}

								}
								

							}

					       //guardamos en base de datos la línea leida
					       //mysql_query("INSERT INTO datos(nombre,edad,profesion) VALUES('$nombre','$edad','$profesion')");


						}else{
		 
							$validacion .= "Error en estructura del archivo, las columnas deben ser 10 y se está cargando ".count($datos)." en la fila ".$linea_i." ";
						}

				       	if($validacion != ""){
				       		echo $validacion;
				       		//print "<script>alert('$validacion')</script>";
							//print("<script>window.location.replace('../View/programacion/cargarArchivoProgramacion.php');</script>");
							die();
								
						}else{

							$objproaca = new TbItemprogramacionacademica();
							$result = $objproaca->crearDetalleProgramacion($proaca_codigo, $asignatura_codigo, $usuario_codigo, $dia_semana, $hora_inicio, $hora_fin, $salon_codigo, $grupo, $jornada_codigo, $proaca_codigo_programa, $fundamentacion_codigo);

							if($result){

								$mensaje = "ingreso correcto";
								print "<script>alert('$mensaje')</script>";
								print("<script>window.location.replace('../View/programacion/cargarArchivoProgramacion.php');</script>");
								echo "okkk<br>";
								echo $asignatura_codigo.",".$usuario_codigo.",".$dia_semana.",".$hora_inicio.",".$hora_fin.",".$salon_codigo.",".$grupo.",".$jornada_codigo.",".$proaca_codigo_programa.",".$fundamentacion_codigo;

							}							
							
						}
				 
				       //cerramos condición
				   }
				 
				   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
				   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
				   $i++;
				   //cerramos bucle
				}

			}

			

		}

		

	}

	public function getcodigoProAcaActiva($proSemCodigoActivo){

		$objtProAca = new TbProgramacionacademica();
		$proAcaActiva = $objtProAca -> getProAcaActiva($proSemCodigoActivo);

		$proaca_codigo_activa = pg_fetch_assoc($proAcaActiva);
		$codigoProAcaActiva = $proaca_codigo_activa['proaca_codigo'];

		
		return $codigoProAcaActiva;
	}


}

?>