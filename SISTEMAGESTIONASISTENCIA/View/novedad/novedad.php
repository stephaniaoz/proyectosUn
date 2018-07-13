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
				      	<div class="panel-body">
			      			<div style="text-align:center;width:320px;padding:0em 0;"> <h2><a style="text-decoration:none;" href="http://www.zeitverschiebung.net/es/country/co"></a></h2> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&timezone=America%2FBogota" width="100%" height="150" frameborder="0" seamless></iframe> <small style="color:gray;">&copy; <a href="#" style="color: gray;">Diferencia horaria</a></small> </div>
				      	</div>
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
					  	<div class="form-group col-md-6">
					  		<label>Fecha novedad</label>
					  		<input type="date" name="fechaFinal" class="form-control" id= "novedad_fecha" required" min=<?php echo FECHASEMANAINICIAL ?> max=<?php echo FECHASEMANAFINAL ?>></input>
					  	</div>
					  	<div class="form-group col-md-12">
					   		<label>Programación asociada</label>
				   			<select type="text" name="corte" class="form-control" id="s_programacion" required>			
							</select>
					  	</div>
					  	<div class="form-group col-md-12">
						   	<label>Observación de la dificultad</label>
						    <textarea class="form-control" rows="3" id="novedad_observaciondificultad" name='area_observacion' required></textarea>
						</div>
						<div id="recuperar" style="display: none;">
							<div class="form-group col-md-12">
								<label>SOLICITUD RECUPERACIÓN DE CLASES</label>
							</div>
							<div class="form-group col-md-1">
								<label class='switch'>
								<input type='checkbox' id="c_recuperar" name='habilitarclase[]' value = ''>
									<div class='slider round'></div>
								</label>
							</div>							
							<div class="form-group col-md-5">
							   	<label>Fecha en la que se quiere recuperar clase</label>
							   	<input type="date" name="fechasolicitud" class="form-control" id="itenovsolrec_fechasolicitud" min=<?php echo FECHASEMANAINICIAL ?> max=<?php echo FECHASEMANAFINAL ?>></input>
							</div>
							<div class="form-group col-md-3">
							   	<label>Hora inicio</label>
							   	<input type="time" name="usr_time" id="itenovsolrec_horainicioclase" class="form-control">
							</div>
							<div class="form-group col-md-3">
							   	<label>Hora fin</label>
							   	<input type="time" name="usr_time" id="itenovsolrec_horafinclase" class="form-control">
							</div>
						</div>
		  				<input type="submit" id="btnGuardar" name="" value="Guardar" class="btn btn-danger btntam"></input>
						<a type="button" class="btn btn-danger btntam" style="margin-left: 10px; text-align: center; padding: 10px;" href="../control_asistencia/listarAsistencia.php" id="volver">Cancelar</a>
					  	<input type="hidden" name="modulo" value="registrar_novedad">	</input>						
					</form>					
				</div>	
			</div>
			
			<div class="panel panel-default">
			   	<div class="panel-heading">			   	
			    	<h3 class="panel-title">Detalle</h3>
			  	</div>
			  	<div class="panel-body" id="listanovedad">
			  	</div>
			</div>
			

		</div>

	</body>
	<script src='https://code.jquery.com/jquery.js'></script>
	<!--<script src="jquery-3.2.1.min.js"></script>-->
	<script src='https://code.jquery.com/jquery-1.10.1.min.js'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<script type="text/javascript">

		$(document).ready(function(){
			
			var url_novedad = "../../Controller/TbTiponovedadController.php";
			var url_iteproaca = "../../Controller/TbItemprogramacionacademicaController.php";

			$.post(url_novedad,
	        {
	          modulo: "registrar_novedad",
	          componente: "selecttiponovedad"
	        },
	        function(data,status){
	            //alert("Data: " + data + "\nStatus: " + status);
	            $("#tipnov_codigo").html(data);
	        });

	        $.post( "../../Controller/TbNovedadController.php",
	        {
	          modulo: "informeDisponibilidad",
	          componente: "listarnovedades"
	        },
	        function(data,status){
	            //alert("Data: " + data + "\nStatus: " + status);
	            $("#listanovedad").html(data);
	        });


			$("#tipnov_codigo").change(function(){
				var tiponovedad = $(this).val();
				//alert("ok: "+tiponovedad);

				if(tiponovedad == 2){//falta de asistencia
					$('#recuperar').css("display","block");
				}else{
					$('#recuperar').css("display","none");
				}
				
			});

			$("#novedad_fecha").change(function(){
				var fecha = $("#novedad_fecha").val();

				$.ajax({
					url: url_iteproaca,
					data: { "fechaproaca": fecha,
							"componente": "cargaselectprogramacion",
							"modulo": "cargar_programacion"},
					type: "post",
					success: function(result){
						//alert("Data: "+fecha+" - "+result);
		            	$("#s_programacion").html(result);
		        }});
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

			$("#btnGuardar").click(function(){
				var dataString = $("#formnovedad").serialize(); 
				var recupera = "";

				if($("#tipnov_codigo").val().length < 1 || $("#tipnov_codigo").val() == 'Seleccione uno') {  
	            	//alert("La fecha de solicitud es obligatoria"); 
	            	$("#alerta").html("<div class='alert alert-warning'> <strong>Warning! </strong>Debe escoger un tipo de novedad.</div>");
	            	return false;  
	        	}

	        	if($("#novedad_fecha").val().length < 1) {  
	            	$("#alerta").html("<div class='alert alert-warning'> <strong>Warning! </strong>Debe escoger la fecha de la novedad.</div>"); 
	            	return false;  
	        	} 

	        	if($("#s_programacion").val().length < 1  || $("#s_programacion").val() == 'Seleccione uno' || $("#s_programacion").val() == 0) {  
	            	$("#alerta").html("<div class='alert alert-warning'> <strong>Warning! </strong>Debe escoger la programación correspondiente.</div>");
	            	return false;  
	        	}

	        	if($("#novedad_observaciondificultad").val().length < 1) { 
	            	$("#alerta").html("<div class='alert alert-warning'> <strong>Warning! </strong>Debe diligenciar una observación de la novedad.</div>");  
	            	return false;  
	        	}


				if($("#c_recuperar").is(':checked')) {  
		            recupera = "OK";

		            if($("#itenovsolrec_fechasolicitud").val().length < 1) {  
		            	//alert("La fecha de solicitud es obligatoria");
		            	$("#alerta").html("<div class='alert alert-warning'> <strong>Warning! </strong>La fecha de solicitud es obligatoria.</div>");  
		            	return false;  
		        	}

		        	if($("#itenovsolrec_horainicioclase").val().length < 1) {  
		            	$("#alerta").html("<div class='alert alert-warning'> <strong>Warning! </strong>La hora inicial de la solicitud es obligatoria</div>");  
		            	return false;  
		        	} 

		        	if($("#itenovsolrec_horafinclase").val().length < 1) {
		            	$("#alerta").html("<div class='alert alert-warning'> <strong>Warning! </strong>La hora final de la fecha de solicitud es obligatoria</div>");  
		            	return false;  
		        	} 
		        }



				//alert("data: "+dataString+" - "+$('#s_programacion').val());

				$.ajax({
					type: "post",
					url: "../../Controller/TbNovedadController.php",
					data: {"tipnov_codigo": $('#tipnov_codigo').val(),
							"novedad_fecha": $('#novedad_fecha').val(),
							"iteproaca_codigo": $('#s_programacion').val(),
							"novedad_observaciondificultad": $('#novedad_observaciondificultad').val(),
							"modulo": "registrar_novedad1",
							"componente": "grabar_novedad",
							"recuperacion": recupera,
							"itenovsolrec_fechasolicitud": $('#itenovsolrec_fechasolicitud').val(),
							"itenovsolrec_horainicioclase": $('#itenovsolrec_horainicioclase').val(),
							"itenovsolrec_horafinclase": $('#itenovsolrec_horafinclase').val()},
				
				}).done(function(data){
					$('#alerta').html(data);
				}).fail(function(jqXHR, textStatus, errorThrown){
				});


				//$('#hidden').css("display","block");
				//location.reload();

			});


		});
		
	</script>

</html>