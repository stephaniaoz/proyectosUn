<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEmpresaController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbTipoDocumentoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbPaisController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbDepartamentoController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbCiudadController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbPerfilController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbEstadoController.php");

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

		function deleteEmpresa(idempresa){
			confirmar = confirm("¿Está seguro de eliminar esta empresa?.");


			if (confirmar){

				location.href="../../../Controller/TbEmpresaController.php?empresa_codigo="+idempresa+"&modulo=deleteEmpresa";
				
			}
		
		}

	</script>

</head>
	<body>

		<h3>FORMULARIO CREACION EMPRESA</h3>

		<form name="fromularioLogin" method="post" action="../../../Controller/TbEmpresaController.php"> 
			Tipo documento:
			<select class="caja" name="s_tipodocumento"  required="required">
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
			Número de identifiación:<input type="text" name="empresa_numerodocumento" value="" required="required">
			<br><br>
			Número de camara y comercio:<input type="text" name="empresa_numerocamaracomercio" value="" required="required">
			<br><br>
			Razón social:<input type="text" name="empresa_razonsocial" value="" required="required">
			<br><br>
			Telefono:<input type="text" name="empresa_telefono" required="required">
			<br><br>
			Celular:<input type="text" name="empresa_celular"  required="required">
			<br><br>	
			Email:<input type="email" name="empresa_email" value="" required="required">
			<br><br>
			Pais:
			<select class="caja" name='s_pais' id='s_pais' onchange="showDpto(this.value)" required='required'>
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
			Departamento:
			<select class="caja" name="s_departamento" id='s_departamento' onchange="showCiudad(this.value)" required="required"></select>
			<br><br>
			Ciudad:
			<select class="caja" name="s_ciudad" id="s_ciudad" required="required"></select>
			<br><br>
			Estado:
			<select class="caja" name="s_estado" required="required">
				<option value='0'>SELECCIONE UNO</option>
				<?php 

					$arrayEstado = array();
					$objEstado = new TbEstadoController();
					$arrayEstado = $objEstado->getListaEstadoPorModulo(MOD_EMPRESA);

					foreach ($arrayEstado as $key => $value) {
						echo"<option value='".$value['estado_codigo']."'>".$value['estado_descripcion']."</option>";
					}

				?>	
			</select>
			<br><br>
			Perfil:
			<select class="caja" name="s_perfil" required="required" disabled>
				<?php 
					$arrayPerfil = array();
					$objPer = new TbPerfilController();
					$arrayPerfil = $objPer->getListaPerfilEmpresa();

					foreach ($arrayPerfil as $key => $value) {
						echo"<option value='".$value['perfil_codigo']."'>".$value['perfil_descripcion']."</option>";
					}

				?>	
			</select>
			<br><br>
			Usuario:<input type="text" name="empresa_usuario_login" value="" required="required">
			<br><br>
			Contraseña:<input type="text" name="empresa_password" value="" required="required">
			<br><br>
			Descripción actividad empresa:
			<textarea name="empresa_descripcionactividad" cols="50" rows="10" id="empresa_descripcionactividad"></textarea>
			<br><br>
			<input type="hidden"  name="modulo" value="grabarEmpresa">
			<input type="submit" value="Grabar" class="submit">
		</form>
<br><br>
		<div class="fillformUsuario">
			<table class='t_visita' cellpadding = '18' cellspacing = '0'>
				<?php
					$arrayEmpresa = array();
					$listaEmpresa = new TbEmpresaController();

					$arrayEmpresa = $listaEmpresa->getListaEmpresa();

					echo "	<tr class='tr_celda_par'>
								<th class='b_visita'>Listado de empresa</th>
							</tr>";

					$tipo_celda = 1;

					foreach ($arrayEmpresa as $posicion => $valor) {
						
						if($tipo_celda % 2 == 0){
							$estilo_celda = "tr_celda_par";
						}else{
							$estilo_celda = "tr_celda_impar";
						}

						echo "	<tbody class='b_visita'>	
									<tr class='".$estilo_celda." filausuario'>
										<td><label>".$valor['empresa_razonsocial']."</label>
										<br>
										<label>Número camara y comercio:</label>
										".$valor['empresa_numerocamaracomercio']."
										<br>
										<label>Descripción:</label> ".$valor['empresa_descripcionactividad']."</td>
										<td>
											<a class='button-link' href='UpdateEmpresa.php?empresa_codigo=".$valor['empresa_codigo']."' target='_blank'>Modificar</a>
											<a class='button-link' href='javascript:deleteEmpresa(".$valor['empresa_codigo'].")' >Eliminar</a>
										</td>
									</tr>
								</tbody>";

						$tipo_celda++;

					}
				?>
			</table>

	</body>

</html>

  