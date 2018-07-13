<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\View\utilities\utilities.php");

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
				<div class="panel-heading">
					<p>Informe de horas trabajadas</p>
				</div>
				<div class="panel-body">
					<div id="hidden" style="display: none;"><?php echo $alerta; ?></div>
					<div id="alerta"></div>
					<form id="formInfHora" method="post">

						<div class="form-group col-md-6">
							<label>Docente</label>
				   			<select type="text" name="usuDoc" id="nombreUsuDoc" class="form-control" required>												
							</select>
						</div>
						<br>
						<input type="submit" id="btnListarReporteDoc" name="" value="listar" class="btn btn-danger btntam"></input>
						<input type="hidden" name="modulo" value="listar_reporte">	</input>
					</form>
				</div>
			</div>
			<div class="panel panel-default">
			   	<div class="panel-heading">			   	
			    	<h3 class="panel-title">Detalle</h3>
			  	</div>
			  	<div class="panel-body" id="listarInfoHoras">
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

			url_usuario ="../../Controller/TbUsuarioController.php";

			$.post(url_usuario,
	        {
	          modulo: "listar",
	          componente: "listarUsuDocente"
	        },
	        
	        function(data,status){
	            //alert("Data: " + data + "\nStatus: " + status);
	            $("#nombreUsuDoc").html(data);
	        });



	        $("#btnListarReporteDoc").click(function(){

	        	var idUsu = $("#nombreUsuDoc").val();

	        	$.post( "../../Controller/TbItemprogramacionacademicaController.php",
		        {
		          modulo: "listarInforme",
		          componente: "infHorasTrabajas",
		          usuario_identificacion: idUsu

		        },
		        
		        function(data,status){
		            //alert("Data: " + data + "\nStatus: " + status);
		            $("#listarInfoHoras").html(data);
		            //console.log(data);
		        });
	        	

	        });
			
			
		});
		
	</script>

</html>