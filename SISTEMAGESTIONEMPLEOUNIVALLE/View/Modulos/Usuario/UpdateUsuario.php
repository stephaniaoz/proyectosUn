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

$usuario_codigo = isset($_REQUEST['usuario_codigo'])?$_REQUEST['usuario_codigo']:'';

$arrayUsuario = array();
$getUsuario = new TbUsuarioController();
$arrayUsuario = $getUsuario->getListaUsuarioId($usuario_codigo)[0];


//echo $arrayUsuario['tipdoc_codigo'];

	//				var_dump($arrayUsuario);
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
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6, IE5
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
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6, IE5
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
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6, IE5
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

		<h3>FORMULARIO MODIFICACION USUARIO</h3>

		<!-- <form name="fromularioLogin" method="POST" action="../../pruebas.php">  -->
		<form name="fromularioLogin" method="POST" action="../../../Controller/TbUsuarioController.php"> 
			<p>Codigo: <?php echo $usuario_codigo ?></p>
			Tipo documento:
			<select class="caja" namme="s_tipodocumento" required>
				<?php 
					$arrayTipoDoc = array();
					$objTipoDoc = new TbTipoDocumentoController();
					$arrayTipoDoc = $objTipoDoc->getListaTipoDocumento();

					foreach ($arrayTipoDoc as $key => $value) {

						if($value['tipdoc_codigo'] == $arrayUsuario['tipdoc_codigo']){
							$selected = 'selected';
							echo"<option value='".$value['tipdoc_codigo']."' ".$selected." >".$value['tipdoc_descripcion']."</option>";
						}else{
							$selected = '';
							echo"<option value='".$value['tipdoc_codigo']."' ".$selected." >".$value['tipdoc_descripcion']."</option>";
						}

						
					}

				?>		
			</select>
			<br><br>
			Número de identifiación:<input required type="text" name="usuario_numeroidentificacion" value="<?php echo $arrayUsuario['usuario_numeroidentificacion'] ?>">
			<br><br>
			Código de estudiante:<input required type="text" name="usuario_codigoestudiante" value="<?php echo $arrayUsuario['usuario_codigoestudiante'] ?>" >
			<br><br>
			Nombres:<input  required type="text" name="usuario_nombres" value="<?php echo $arrayUsuario['usuario_nombres'] ?>" >
			<br><br>
			Apellidos:<input type="text" name="usuario_apellidos" value="<?php echo $arrayUsuario['usuario_apellidos'] ?>" >
			<br><br>
			Fecha de nacimiento:<input type="date" name="usuario_fechanacimiento" value="<?php echo $arrayUsuario['usuario_fechanacimiento'] ?>">
			<br><br>
			Ciudad de nacimiento:
			<select class="caja" namme="ciudad_codigo_nacimiento" >
				<?php 
					
					$arrayCiudad_nac = array();
					$objCiudad_nac = new TbCiudadController();
					$arrayCiudad_nac = $objCiudad_nac->getListaCiudad();

					foreach ($arrayCiudad_nac as $key => $value) {

						if($value['ciudad_codigo_nacimiento'] == $arrayUsuario['ciudad_codigo_nacimiento']){
							$selected = 'selected';
							echo"<option value='".$value['ciudad_codigo']."' ".$selected.">".$value['ciudad_nombre']."</option>";
						}else{
							$selected = '';
							echo"<option value='".$value['ciudad_codigo']."' ".$selected.">".$value['ciudad_nombre']."</option>";
						}

					}

				?>
			</select>
			<br><br>
			Sexo:
			<select id="usuario_sexo" name="usuario_sexo" class="caja">
				<?php	
					if($arrayUsuario['usuario_sexo'] == 'FEMENINO'){
						$selected1 = 'selected';
					}else{
						$selected2 = 'selected';
					}
					echo "	<option value='FEMENINO' $selected1>FEMENINO</option>
                			<option value='MASCULINO' $selected2>MASCULINO</option>";
				?>
                
            </select>
			<br><br>
			Telefono:<input type="tel" name="usuario_telefono" value="<?php echo $arrayUsuario['usuario_telefono'] ?>">
			<br><br>
			Celular:<input type="tel" name="usuario_celular" value="<?php echo $arrayUsuario['usuario_celular'] ?>">
			<br><br>	
			Email:<input type="email" name="usuario_email" value="<?php echo $arrayUsuario['usuario_email'] ?>">
			<br><br>
			Estado:
			<select class="caja" namme="s_estado" >
				<?php 

					$arrayEstado = array();
					$objEstado = new TbEstadoController();
					$arrayEstado = $objEstado->getListaEstadoPorModulo(MOD_USUARIO);

					foreach ($arrayEstado as $key => $value) {

						if($value['estado_codigo'] == $arrayUsuario['estado_codigo']){
							$selected = 'selected';
							echo"<option value='".$value['estado_codigo']."' ".$selected.">".$value['estado_descripcion']."</option>";
						}else{
							$selected = '';
							echo"<option value='".$value['estado_codigo']."' ".$selected.">".$value['estado_descripcion']."</option>";
						}

						
					}

				?>	
			</select>
			<br><br>
			Perfil:
			<select class="caja" namme="s_perfil" >
				<?php 
					$arrayPerfil = array();
					$objPer = new TbPerfilController();
					$arrayPerfil = $objPer->getListaPerfil();


					foreach ($arrayPerfil as $key => $value) {
						
						if($value['perfil_codigo'] == $arrayUsuario['perfil_codigo']){
							$selected = 'selected';
							echo"<option value='".$value['perfil_codigo']."' ".$selected.">".$value['perfil_descripcion']."</option>";
						}else{
							$selected = '';
							echo"<option value='".$value['perfil_codigo']."' ".$selected.">".$value['perfil_descripcion']."</option>";
						}

						
					}

				?>	
			</select>
			<br><br>
			Usuario:<input type="text" name="usuario_usuario_login" value="<?php echo $arrayUsuario['usuario_usuario_login'] ?>" >
			<br><br>
			Contraseña:<input type="text" name="usuario_password" value="<?php echo $arrayUsuario['usuario_password'] ?>" >
			<br><br>
			Tipo de formación:
			<select class="caja" namme="s_tipoformacion" >
				<?php 
					$arrayTipFor = array();
					$objTipFor = new TbTipoformacionController();
					$arrayTipFor = $objTipFor->getListaTipoFormacion();

					foreach ($arrayTipFor as $key => $value) {

						if($value['tipfor_codigo'] == $arrayUsuario['tipfor_codigo']){
							$selected = 'selected';
							echo"<option value='".$value['tipfor_codigo']."' ".$selected.">".$value['tipfor_descripcion']."</option>";
						}else{
							$selected = '';
							echo"<option value='".$value['tipfor_codigo']."' ".$selected.">".$value['tipfor_descripcion']."</option>";
						}

						
					}
				?>	
			</select>
			<br><br>
			<?php 
			 	if($arrayUsuario['usuario_estudiantehabilitado'] == '1'){
			 		$estudiantehabilitado = 'checked';
			 	}else{
			 		$estudiantehabilitado = '';
			 	}
			?>
			<input name="usuario_estudiantehabilitado" type="checkbox" value="" <?php echo $estudiantehabilitado ?> />Confirmo que estoy actualmente estudiando los ultimos tres semestres de mi carrera.
			<br><br>
			Programa academico:
			<select class="caja" namme="s_programaacademico" >
				<?php 
					$arrayProgAca = array();
					$objProgAca = new TbProgramaacademicoController();
					$arrayProgAca = $objProgAca->getListaProgramaacademico();

					foreach ($arrayProgAca as $key => $value) {

						if($value['proaca_codigo'] == $arrayUsuario['proaca_codigo']){
							$selected = 'selected';
							echo"<option value='".$value['proaca_codigo']."' ".$selected.">".$value['proaca_nombre']."</option>";
						}else{
							$selected = '';
							echo"<option value='".$value['proaca_codigo']."' ".$selected.">".$value['proaca_nombre']."</option>";
						}

						
					}
				?>	
			</select>
			<br><br>
			Entidad:
			<select class="caja" namme="s_entidadestudio" onchange="showSede(this.value)" >
				<?php 
					
					$arrayEntEst = array();
					$objEntEst = new TbEntidadestudioController();
					$arrayEntEst = $objEntEst->getListaEntidadEstdio();

					foreach ($arrayEntEst as $key => $value) {

						if($value['entest_codigo'] == $arrayUsuario['entest_codigo']){
							$selected = 'selected';
							echo"<option value='".$value['entest_codigo']."' ".$selected.">".$value['entest_nombre']."</option>";
						}else{
							$selected = '';
							echo"<option value='".$value['entest_codigo']."' ".$selected.">".$value['entest_nombre']."</option>";
						}

						
					}

				?>	
			</select>	
			<br><br>
			Lugar de desarrollo:
			<select class="caja" namme="s_itementidadestudio" id="s_itementidadestudio" >
				<?php
					$selected = 'selected';
					echo"<option value='".$arrayUsuario['iteentestsed_codigo']."' ".$selected.">".$arrayUsuario['iteentestsed_nombre']."</option>";
				?>
			</select>
			<br><br>
			Pais actual:

			<select class="caja" namme='s_pais' id='s_pais' onchange="showDpto(this.value)" required='required'>
				<option value='0'>SELECCIONE UNO</option>
				<?php 
					
					$pais = 0;
					$arrayPais = array();
					$objPais = new TbPaisController();
					$arrayPais = $objPais->getListaUsuarioContacto();

					foreach ($arrayPais as $key => $value) {

						if($value['pais_codigo'] == $arrayUsuario['pais_codigo']){
							$selected = 'selected';
							echo"<option value='".$value['pais_codigo']."' ".$selected.">".$value['pais_nombre']."</option>";
						}else{
							$selected = '';
							echo"<option value='".$value['pais_codigo']."' ".$selected.">".$value['pais_nombre']."</option>";
						}

						
					}

				?>		
			</select>	
			<br><br>
			Departamento actual:
			<select class="caja" namme="s_departamento" id='s_departamento' onchange="showCiudad(this.value)" >
				<?php
					$selected = 'selected';
					echo"<option value='".$arrayUsuario['departamento_codigo']."' ".$selected.">".$arrayUsuario['departamento_nombre']."</option>";
				?>
			</select>
			<br><br>
			Ciudad actual:
			<select class="caja" namme="s_ciudad" id="s_ciudad" >
				<?php
					$selected = 'selected';
						echo"<option value='".$arrayUsuario['ciudad_codigo']."' ".$selected.">".$arrayUsuario['ciudad_nombre']."</option>";
				?>
			</select>
			<br><br>
			Descripción perfil:
			<textarea name="usuario_descripcionperfil" cols="50" rows="10" id="usuario_descripcionperfil" value=""><?php echo $arrayUsuario['usuario_descripcionperfil'] ?></textarea> 
			<br><br>
			<p>Adjuntar hoja de vida:</p> 

			<?php
				if($arrayUsuario['usuario_hojadevida'] != ''){
					echo "Archivo anterior: <a class='button-link' href='#' >".$arrayUsuario['usuario_hojadevida']."</a><br><br>";
				}
			?>
			
			<input type='file' name='usuario_hojadevida' id='usuario_hojadevida' value="" class='submit'></p>	
			<br><br>
			<input type="hidden" name="modulo" value="updateUsuario">
			<input type="hidden" name="usuario_codigo" value="<?php echo $usuario_codigo ?>">
			<input type="submit" value="Grabar" class="submit">
		</form>

	</body>

</html>
