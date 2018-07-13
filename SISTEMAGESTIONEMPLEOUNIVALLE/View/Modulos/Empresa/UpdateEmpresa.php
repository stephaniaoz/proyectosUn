<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEmpresaController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbTipoDocumentoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbPaisController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbDepartamentoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbCiudadController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbPerfilController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEstadoController.php");

$empresa_codigo = isset($_REQUEST['empresa_codigo'])?$_REQUEST['empresa_codigo']:'';
//var_dump($empresa_codigo);
$arrayEmpresa = array();
$getEmpresa = new TbEmpresaController();
$arrayEmpresa = $getEmpresa->getListaEmpresaId($empresa_codigo)[0];


	//				var_dump($arrayEmpresa);

?>

<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
	<script type="text/javascript">
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
	</script>

</head>
	<body>

		<h3>FORMULARIO MODIFICACION EMPRESA</h3>

		<form name="fromularioLogin" method="POST" action="../../../Controller/TbEmpresaController.php"> 
			<p>Codigo: <?php echo $empresa_codigo ?></p>
			Tipo documento:
			<select name="s_tipodocumento"  required="required">
				<?php 
					$arrayTipoDoc = array();
					$objTipoDoc = new TbTipoDocumentoController();
					$arrayTipoDoc = $objTipoDoc->getListaTipoDocumento();

					foreach ($arrayTipoDoc as $key => $value) {
						if($value['tipdoc_codigo'] == $arrayEmpresa['tipdoc_codigo']){
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
			Número de identifiación:<input type="text" name="empresa_numerodocumento" value="<?php echo $arrayEmpresa['empresa_numerodocumento'] ?>" required="required">
			<br><br>
			Número de camara y comercio:<input type="text" name="empresa_numerocamaracomercio" value="<?php echo $arrayEmpresa['empresa_numerocamaracomercio'] ?>" required="required">
			<br><br>
			Razón social:<input type="text" name="empresa_razonsocial" value="<?php echo $arrayEmpresa['empresa_razonsocial'] ?>" required="required">
			<br><br>
			Telefono:<input type="text" name="empresa_telefono" value="<?php echo $arrayEmpresa['empresa_telefono'] ?>" required="required">
			<br><br>
			Celular:<input type="text" name="empresa_celular" value="<?php echo $arrayEmpresa['empresa_celular'] ?>" required="required">
			<br><br>	
			Email:<input type="email" name="empresa_email" value="<?php echo $arrayEmpresa['empresa_email'] ?>" required="required">
			<br><br>
			Pais:
			<select name='s_pais' id='s_pais' onchange="showDpto(this.value)" required='required'>
				<?php 
					
					$pais = 0;
					$arrayPais = array();
					$objPais = new TbPaisController();
					$arrayPais = $objPais->getListaUsuarioContacto();

					foreach ($arrayPais as $key => $value) {
						
						if($value['pais_codigo'] == $arrayEmpresa['pais_codigo']){
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
			Departamento:
			<select name="s_departamento" id='s_departamento' onchange="showCiudad(this.value)" required="required">
				<?php
					$selected = 'selected';
					echo"<option value='".$arrayEmpresa['departamento_codigo']."' ".$selected.">".$arrayEmpresa['departamento_nombre']."</option>";
				?>
			</select>
			<br><br>
			Ciudad:
			<select name="s_ciudad" id="s_ciudad" required="required">
				<?php
					$selected = 'selected';
						echo"<option value='".$arrayEmpresa['ciudad_codigo']."' ".$selected.">".$arrayEmpresa['ciudad_nombre']."</option>";
				?>
			</select>
			<br><br>
			Estado:
			<select name="s_estado" required="required">
				<?php 

					$arrayEstado = array();
					$objEstado = new TbEstadoController();
					$arrayEstado = $objEstado->getListaEstadoPorModulo(MOD_EMPRESA);

					foreach ($arrayEstado as $key => $value) {
						if($value['estado_codigo'] == $arrayEmpresa['estado_codigo']){
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
			<select name="s_perfil" required="required" disabled>
				<?php 
					$arrayPerfil = array();
					$objPer = new TbPerfilController();
					$arrayPerfil = $objPer->getListaPerfilEmpresa();

					foreach ($arrayPerfil as $key => $value) {
						if($value['perfil_codigo'] == $arrayEmpresa['perfil_codigo']){
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
			Usuario:<input type="text" name="empresa_usuario_login" value="<?php echo $arrayEmpresa['empresa_usuario_login'] ?>" required="required">
			<br><br>
			Contraseña:<input type="text" name="empresa_password" value="<?php echo $arrayEmpresa['empresa_password'] ?>" required="required">
			<br><br>
			Descripción actividad empresa:
			<textarea name="empresa_descripcionactividad" cols="50" rows="10" id="empresa_descripcionactividad" value=""><?php echo $arrayEmpresa['empresa_descripcionactividad'] ?></textarea>
			<br><br>
			<input type="hidden" name="modulo" value="updateEmpresa">
			<input type="hidden" name="empresa_codigo" value="<?php echo $empresa_codigo ?>">
			<input type="submit" value="Grabar">
		</form>

	</body>

</html>

  