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
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />

  	<script>

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

		  xmlhttp.open("GET","../Controller/TbItementidadestudiosedeController.php?id_entidad="+univ,true);		  
		  xmlhttp.send();

		}

	</script>

  

</head>
	<body>

		<form name="form" method="POST" action="RresultadoInformeUsuario.php">
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
			Lugar de desarrollo (Sede):
			<select name="s_itementidadestudio" id="s_itementidadestudio" class="caja"></select>
			<br><br>
			Año: <input type="text" name="ano">	<br><br>
			Mes: <input type="text" name="mes">	<br><br>
			<input type="submit" value="Listado de usuarios" class="submit">
		</form>

		<div class="fillformUsuario">
			<table class='t_visita' cellpadding = '18' cellspacing = '0'>
				<?php
					$arrayUsuContact = array();
					$listaUsuarioContacto = new TbUsuarioController();
					//se recorre arreglo de usuarios contacto
					$arrayUsuContact = $listaUsuarioContacto->getListaUsuario();

					echo "	<tr class='tr_celda_par'>
								<th class='b_visita'>Listado de contactos <a href='Index.php' class='button-link'>cerrar_session</a></th>
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
										
									</tr>
								</tbody>";

						$tipo_celda++;

					}
				?>
			</table>
		</div>

	</body>

</html>
