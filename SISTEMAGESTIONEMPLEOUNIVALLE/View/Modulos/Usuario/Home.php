<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbUsuarioController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbPaisController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbDepartamentoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbCiudadController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbTipoDocumentoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbPerfilController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbTipoformacionController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbProgramaacademicoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEntidadEstudioController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbItementidadestudiosedeController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEstadoController.php");

$resultado = isset($_REQUEST['algo'])?$_REQUEST['algo']:'';

if(empty($_SESSION['usuario_codigo']) || empty($_SESSION['perfil_descripcion'])){
	header('Location: Index.php');
	die();
}


?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />

  	<script>


		function showDpto(str) {
		
		  if (str=="") {
		    document.getElementById("s_departamento").innerHTML="";
		    return;
		  } 
		  if (window.XMLHttpRequest) {
		    // code for IE7+,  Firefox,  Chrome,  Opera,  Safari
		    xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6,  IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
		    if (this.readyState==4 && this.status==200) {
		    	
		      document.getElementById("s_departamento").innerHTML=this.responseText;
		    }
		  }

		  xmlhttp.open("GET","../../../Controller/TbDepartamentoController.php?id_pais="+str,true);		  
		  xmlhttp.send();
		}

		function showCiudad(dpto) {
		
		  if (dpto=="") {
		    document.getElementById("s_ciudad").innerHTML="";
		    return;
		  } 
		  if (window.XMLHttpRequest) {
		    // code for IE7+,  Firefox,  Chrome,  Opera,  Safari
		    xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6,  IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
		    if (this.readyState==4 && this.status==200) {
		    	
		      document.getElementById("s_ciudad").innerHTML=this.responseText;
		    }
		  }

		  xmlhttp.open("GET","../../../Controller/TbCiudadController.php?id_dpto="+dpto,true);		  
		  xmlhttp.send();
		}

		function showSede(univ) {
		
		  if (univ=="") {
		    document.getElementById("s_itementidadestudio").innerHTML="";
		    return;
		  } 
		  if (window.XMLHttpRequest) {
		    // code for IE7+,  Firefox,  Chrome,  Opera,  Safari
		    xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6,  IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
		    if (this.readyState==4 && this.status==200) {
		    	
		      document.getElementById("s_itementidadestudio").innerHTML=this.responseText;
		    }
		  }

		  xmlhttp.open("GET","../../../Controller/TbItementidadestudiosedeController.php?id_entidad="+univ,true);		  
		  xmlhttp.send();

		}

		function deleteUser(idusuario){
			confirmar = confirm("¿Está seguro de eliminar este usuario?.");

			if (confirmar){

				location.href="../../../Controller/TbUsuarioController.php?usuario_codigo="+idusuario+"&modulo=deleteUsuario";
				
			}
		
		}



	</script>

  

</head>
	<body>	

		<?php
			if(in_array($_SESSION['perfil_descripcion'],  array('ADMINISTRADOR','SUPERVISOR'))){
		?>
				<table class='t_visita' cellpadding = '18' cellspacing = '0'>
					<tr class='tr_celda_par'>
						<th class='b_visita'>FORMULARIO CREACION USUARIO <a class='button-link' href="../../Index.php">cerrar_session</a></th>
					</tr>
				</table>
				<br><br>

				<!-- <form name="fromularioLogin" method="POST" action="../../pruebas.php">  -->
				<form name="fromularioLogin" method="POST" action="../../../Controller/TbUsuarioController.php"> 
					Tipo documento:
					<select name="s_tipodocumento"  class="caja">
						<option value='0'>SELECCIONE UNO</option>
						<?php 
							$arrayTipoDoc = array();
							$objTipoDoc = new TbTipoDocumentoController();
							$arrayTipoDoc = $objTipoDoc->getListaTipoDocumento();

							foreach ($arrayTipoDoc as $key => $value) {
								echo"<option value='".$value['tipdoc_codigo']."'>".$value['tipdoc_descripcion']."</option>";
							}

						?>		
					</select>
					<br><br>
					Número de identifiación:<input type="text" name="usuario_numeroidentificacion" value="" >
					<br><br>
					Código de estudiante:<input type="text" name="usuario_codigoestudiante" value="" >
					<br><br>
					Nombres:<input type="text" name="usuario_nombres" value="" >
					<br><br>
					Apellidos:<input type="text" name="usuario_apellidos" value="" >
					<br><br>
					Fecha de nacimiento:<input type="date" name="usuario_fechanacimiento" >
					<br><br>
					Ciudad de nacimiento:
					<select name="ciudad_codigo_nacimiento" class="caja">
						<option value="0">SELECCIONE UNO</option>
						<?php 
							
							$arrayCiudad_nac = array();
							$objCiudad_nac = new TbCiudadController();
							$arrayCiudad_nac = $objCiudad_nac->getListaCiudad();

							foreach ($arrayCiudad_nac as $key => $value) {
								echo"<option value='".$value['ciudad_codigo']."'>".$value['ciudad_nombre']."</option>";
							}

						?>
					</select>
					<br><br>
					Sexo:
					<select id="usuario_sexo" name="usuario_sexo" class="caja">
						<option value="0">SELECCIONE UNO</option>
		                <option value="FEMENINO">FEMENINO</option>
		                <option value="MASCULINO">MASCULINO</option>
		            </select>
					<br><br>
					Telefono:<input type="tel" name="usuario_telefono" >
					<br><br>
					Celular:<input type="tel" name="usuario_celular" >
					<br><br>	
					Email:<input type="email" name="usuario_email" value="" >
					<br><br>
					Estado:
					<select name="s_estado" class="caja">
						<option value='0'>SELECCIONE UNO</option>
						<?php 

							$arrayEstado = array();
							$objEstado = new TbEstadoController();
							$arrayEstado = $objEstado->getListaEstadoPorModulo(MOD_USUARIO);

							foreach ($arrayEstado as $key => $value) {
								echo"<option value='".$value['estado_codigo']."'>".$value['estado_descripcion']."</option>";
							}

						?>	
					</select>
					<br><br>
					Perfil:
					<select name="s_perfil" class="caja">
						<option value='0'>SELECCIONE UNO</option>
						<?php 
							$arrayPerfil = array();
							$objPer = new TbPerfilController();
							$arrayPerfil = $objPer->getListaPerfil();

							foreach ($arrayPerfil as $key => $value) {
								echo"<option value='".$value['perfil_codigo']."'>".$value['perfil_descripcion']."</option>";
							}

						?>	
					</select>
					<br><br>
					Usuario:<input type="text" name="usuario_usuario_login" value="" >
					<br><br>
					Contraseña:<input type="text" name="usuario_password" value="" >
					<br><br>
					Tipo de formación:
					<select name="s_tipoformacion" class="caja">
						<option value='0'>SELECCIONE UNO</option>
						<?php 
							$arrayTipFor = array();
							$objTipFor = new TbTipoformacionController();
							$arrayTipFor = $objTipFor->getListaTipoFormacion();

							foreach ($arrayTipFor as $key => $value) {
								echo"<option value='".$value['tipfor_codigo']."'>".$value['tipfor_descripcion']."</option>";
							}
						?>	
					</select>
					<br><br>
					<input name="usuario_estudiantehabilitado" type="checkbox" />Confirmo que estoy actualmente estudiando los ultimos tres semestres de mi carrera.
					<br><br>
					Programa academico:
					<select name="s_programaacademico" class="caja">
						<option value='0'>SELECCIONE UNO</option>
						<?php 
							$arrayProgAca = array();
							$objProgAca = new TbProgramaacademicoController();
							$arrayProgAca = $objProgAca->getListaProgramaacademico();

							foreach ($arrayProgAca as $key => $value) {
								echo"<option value='".$value['proaca_codigo']."'>".$value['proaca_nombre']."</option>";
							}
						?>	
					</select>
					<br><br>
					Entidad:
					<select name="s_entidadestudio" onchange="showSede(this.value)" class="caja">
						<option value='0'>SELECCIONE UNO</option>
						<?php 
							
							$arrayEntEst = array();
							$objEntEst = new TbEntidadestudioController();
							$arrayEntEst = $objEntEst->getListaEntidadEstdio();

							foreach ($arrayEntEst as $key => $value) {
								echo"<option value='".$value['entest_codigo']."'>".$value['entest_nombre']."</option>";
							}

						?>	
					</select>	
					<br><br>
					Lugar de desarrollo:
					<select name="s_itementidadestudio" id="s_itementidadestudio" class="caja"></select>
					<br><br>
					Pais actual:

					<select name='s_pais' id='s_pais' onchange="showDpto(this.value)" required='required' class="caja">
						<option value='0'>SELECCIONE UNO</option>
						<?php 
							
							$pais = 0;
							$arrayPais = array();
							$objPais = new TbPaisController();
							$arrayPais = $objPais->getListaUsuarioContacto();

							foreach ($arrayPais as $key => $value) {
								echo"<option value='".$value['pais_codigo']."'>".$value['pais_nombre']."</option>";
							}

						?>		
					</select>	
					<br><br>
					Departamento actual:
					<select name="s_departamento" id='s_departamento' onchange="showCiudad(this.value)" class="caja"></select>
					<br><br>
					Ciudad actual:
					<select name="s_ciudad" id="s_ciudad" class="caja"></select>
					<br><br>
					Descripción perfil:
					<textarea name="usuario_descripcionperfil" cols="50" rows="10" id="usuario_descripcionperfil"></textarea> 
					<br><br>
					<p>Adjuntar hoja de vida:</p> <input type='file' name='usuario_hojadevida' id='usuario_hojadevida'  class="submit"></p>	
					<br><br>
					<input type="hidden" name="modulo" value="grabarUsuario">
					<input type="submit" value="Grabar"  class="submit">
				</form>

		<?php
			}
		?>

		<div class="fillformUsuario">
			<table class='t_visita' cellpadding = '18' cellspacing = '0'>
				<?php
					$arrayUsuContact = array();
					$listaUsuarioContacto = new TbUsuarioController();
					//se recorre arreglo de usuarios contacto
					$arrayUsuContact = $listaUsuarioContacto->getListaUsuarioSesion($_SESSION['perfil_descripcion']);

					echo "	<tr class='tr_celda_par'>
								<th class='b_visita'>Listado de contactos <a href='../../Index.php' class='button-link'>cerrar_session</a></th>
							</tr>";

					$tipo_celda = 1;

					foreach ($arrayUsuContact as $posicion => $valor) {
						
						if($tipo_celda % 2 == 0){
							$estilo_celda = "tr_celda_par";
						}else{
							$estilo_celda = "tr_celda_impar";
						}

						echo "	<tbody class='b_visita'>	
									<tr class='".$estilo_celda." filausuario'>
										<td><label>".$valor['usuario_nombres']." ".$valor['usuario_apellidos']."</label>
										<br>
										".$valor['entest_nombre']."
										<br>
										<label>Titulo otorgado:</label> ".$valor['usuario_titulootorgado']."</td>
										<br>
										<td><label>Perfil:</label> ".$valor['perfil_descripcion']."</td>
										<td>
											<a class='button-link' href='DetalleUsuario.php?usuario_codigo=".$valor['usuario_codigo']."&nombre=".$valor['usuario_nombres']."' target='_blank'>Detalles</a> ";


								if(in_array($_SESSION['perfil_descripcion'],  array('ADMINISTRADOR','SUPERVISOR'))){

								
									echo "	<a class='button-link' href='UpdateUsuario.php?usuario_codigo=".$valor['usuario_codigo']."' target='_blank'>Modificar</a> ";

									if($_SESSION['perfil_descripcion'] == 'ADMINISTRADOR'){
										echo "	<a class='button-link' href='javascript:deleteUser(".$valor['usuario_codigo'].")' target='_blank'>Eliminar</a>";
									}								

								}

								echo "		
										</td>
									</tr>
								</tbody>";

						$tipo_celda++;

					}
				?>
			</table>
		</div>

	</body>

</html>
