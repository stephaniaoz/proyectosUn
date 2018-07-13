<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\View\utilities\utilities.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbItemprogramacionacademicaController.php");

$usuario_codigo = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:'';
$nombre_perfil_ingreso = isset($_SESSION['nombre_perfil_ingreso'])?$_SESSION['nombre_perfil_ingreso']:'';
$nombre_carrera_ingreso = isset($_SESSION['nombre_carrera_ingreso'])?$_SESSION['nombre_carrera_ingreso']:'';
$listaperfil = isset($_SESSION['lista_perfil'])?$_SESSION['lista_perfil']:''; 
$alerta = isset($_SESSION['alerta'])?$_SESSION['alerta']:'';

/*$check = isset($_SESSION['checkproaca'])?$_SESSION['checkproaca']:'';
if($check != ''){
	$nuevo = 'si';
}*/

if($nombre_perfil_ingreso == ''){
	header('Location:panel_ingreso.php');
	die();
}

if($usuario_codigo == ''){
	header('Location:../Index.php');
	die();
}

/*if($_REQUEST){
	die("request");
}*/
//$_SESSION['control_retorno']='1';

?>
<!DOCTYPE html>

<html lang="en">
<html>
	<?php head("Novedad"); ?>
	
		<?php menu($nombre_perfil_ingreso, $listaperfil); 

			$dia=date("l");

			if ($dia=="Monday") $dia="Lunes";
			if ($dia=="Tuesday") $dia="Martes";
			if ($dia=="Wednesday") $dia="Miércoles";
			if ($dia=="Thursday") $dia="Jueves";
			if ($dia=="Friday") $dia="Viernes";
			if ($dia=="Saturday") $dia="Sabado";
			if ($dia=="Sunday") $dia="Domingo";

			$mes=date("F");

			if ($mes=="January") $mes="Enero";
			if ($mes=="February") $mes="Febrero";
			if ($mes=="March") $mes="Marzo";
			if ($mes=="April") $mes="Abril";
			if ($mes=="May") $mes="Mayo";
			if ($mes=="June") $mes="Junio";
			if ($mes=="July") $mes="Julio";
			if ($mes=="August") $mes="Agosto";
			if ($mes=="September") $mes="Setiembre";
			if ($mes=="October") $mes="Octubre";
			if ($mes=="November") $mes="Noviembre";
			if ($mes=="December") $mes="Diciembre";

			$ano=date("Y");

			$dia2=date("d");

		?>

		<div class="main container">
		    <div class="row">
		        <div class="col-md-4">
		            <div class="panel panel-primary">
				      	<div class="panel-heading">Hoy es <?php echo "<center><h2>".$dia." ".$dia2." </h2><p id='letrafecha'>".$mes." de ".$ano.", "; 
														      		ini_set('date.timezone','America/Bogota'); 
																	echo "hora:".date('g:i A')."</p></center>"; 
																	  ?></div>
				    </div>
		        </div>
		        <div class="col-md-8">
		            <div class="panel panel-primary">
				      	<div class="panel-heading">Recordatorio</div>
				      	<div class="panel-body">Panel Content</div>
				    </div>
		        </div>		       
		    </div>
		</div>

		<div class="main container">

			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">
					<p>Registro de novedades</p>
				</div>
				<div class="panel-body">
					<div id="hidden" style="display: none;"><?php echo $alerta; ?></div>
					<div id="alerta"></div>
					<form id="formnovedad" method="post">
						<div class="form-group col-md-6">
							<label>Tipo de novedad</label>
				   			<select type="text" name="tiponovedad" id="tipnov_codigo" class="form-control" required>												
							</select>
						</div>
					  	<input type="hidden" name="modulo" value="registrar_novedad"></input>						
					</form>					
				</div>	
			</div>
			
			<div class="panel panel-default" id="contenedordetalle" style = "display: none; ">
			   	<div class="panel-heading">			   	
			    	<h3 class="panel-title">Detalle</h3>
			  	</div>
			  	<div class="panel-body" id="listanovedad">
			  	</div>
			</div>
			<a href="#" class="btn btn-danger btn-block" data-toggle="modal" id="btnAutorizar" style="display: none; margin-bottom: 40px;">Autorizar</a>

		</div>

	</body>
	<script src='https://code.jquery.com/jquery.js'></script>
	<!--<script src="jquery-3.2.1.min.js"></script>-->
	<script src='https://code.jquery.com/jquery-1.10.1.min.js'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<script type="text/javascript">

		$(document).ready(function(){

			$('#alerta').html("");

			var url_novedad = "../../Controller/TbTiponovedadController.php";
			var url_iteproaca = "../../Controller/TbItemprogramacionacademicaController.php";

			var arrayautorizasalon;
			
			$.post(url_novedad,
	        {
	          modulo: "registrar_novedad",
	          componente: "selecttiponovedad"
	        },
	        function(data,status){
	            //alert("Data: " + data + "\nStatus: " + status);
	            $("#tipnov_codigo").html(data);
	        });     

			$("#tipnov_codigo").change(function(){
				var tiponovedad = $(this).val();
				//alert("ok: "+tiponovedad);

				if(tiponovedad == 2){//falta de asistencia
					$('#alerta').html("");
					$.post( "../../Controller/TbNovedadController.php",
			        {
			          modulo: "autorizarNovedad",
			          componente: "listarnovedadesFalta"
			        },
			        function(data,status){
			            //alert("Data: " + data + "\nStatus: " + status);
			            $("#contenedordetalle").css("display", "block");
			            $("#listanovedad").html(data);
			            $("#btnAutorizar").css("display", "block");
			        });
				}else
					if(tiponovedad == 0){
						$('#alerta').html("");
						$("#contenedordetalle").css("display", "none");
						$("#btnAutorizar").css("display", "none");
				}else{
					$('#alerta').html("");
					$.post( "../../Controller/TbNovedadController.php",
			        {
			          modulo: "autorizarNovedad",
			          componente: "listaOtroNovedad"
			        },
			        function(data,status){
			            //alert("Data: " + data + "\nStatus: " + status);
			            $("#contenedordetalle").css("display", "block");
			            $("#listanovedad").html(data);
			            $("#btnAutorizar").css("display", "block");
			        });
				}
				
			});

			function asignar(){
				var volver = document.getElementById("volver");
				volver.onclick = function(){
					window.history.go(-1);
					return false;
				}
			}
			window.onload = function(){
			asignar();
			}


			$('#btnAutorizar').click(function(){

				var contaauto = 0;
				var tiponovedad = $("#tipnov_codigo").val();
				var arrayautorizasalon = [];
				
				$("input:checkbox:checked").each(function(){

					var novedad_codigo = $(this).val();
					var selectsalon = "#s_programacion"+novedad_codigo;
					var salon_codigo = $(selectsalon).val();					

					if(salon_codigo == 0) {
		            	$("#alerta").html("<div class='alert alert-warning'> <strong>Warning! </strong>Debe escoger el salón en el item chequeado.</div>");
		            	return false;  
		        	}else{
		        		$("#alerta").html("");
		        	}

		        	if(tiponovedad == 1){
	        			arrayautorizasalon[contaauto] = novedad_codigo;
		        	}else
		        		if(tiponovedad == 2){
			        		arrayautorizasalon[contaauto] = novedad_codigo+","+salon_codigo;
			        	}					

					contaauto++;

				});

				if(tiponovedad == 2){

					$.ajax({
						type: "post",
						url: "../../Controller/TbNovedadController.php",
						data: {	"modulo": "autorizarNovedad",
								"componente": "updateEstadoFalta",
								"arrayautorizacionfalta": arrayautorizasalon},

					}).done(function(data){
						//alert(data);
						$('#alerta').html(data);
					}).fail(function(jqXHR, textStatus, errorThrown){
						//alert("Falla: "+textStatus);
						//alert("Falla: "+jqXHR);
						//alert("Falla: "+errorThrown);
					});

				}

				if(tiponovedad == 1){

					$.ajax({
						type: "post",
						url: "../../Controller/TbNovedadController.php",
						data: {	"modulo": "autorizarNovedad",
								"componente": "updateEstadoOtro",
								"arrayautorizacionfalta": arrayautorizasalon},

					}).done(function(data){
						//alert(data);
						$('#alerta').html(data);
					}).fail(function(jqXHR, textStatus, errorThrown){
						//alert("Falla: "+textStatus);
						//alert("Falla: "+jqXHR);
						//alert("Falla: "+errorThrown);
					});

				}

			});

		});
		
	</script>

</html>