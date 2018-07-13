<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\View\utilities\utilities.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbItemprogramacionacademicaController.php");

$usuario_codigo = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:'';
$nombre_perfil_ingreso = isset($_SESSION['nombre_perfil_ingreso'])?$_SESSION['nombre_perfil_ingreso']:'';
$nombre_carrera_ingreso = isset($_SESSION['nombre_carrera_ingreso'])?$_SESSION['nombre_carrera_ingreso']:'';
$listaperfil = isset($_SESSION['lista_perfil'])?$_SESSION['lista_perfil']:'';
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
	<?php head("Página principal"); ?>
	
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
				      	<div class="panel-heading">Hoy es <?php echo "<center><h2>".$dia." ".$dia2." </h2><p id='letrafecha'>".$mes." de ".$ano; ?></div>

				      	<div style="text-align:center;width:350px;"><iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&timezone=America%2FBogota" disabled  width="100%" frameborder="0" seamless></iframe> <small style="color:gray;">&copy;<a href="#" style="color: gray;">Diferencia horaria</a></small> </div>
				    </div>
		        </div>
		        <div class="col-md-4">
		            <div class="panel panel-primary">
				      	<div class="panel-heading">Recordatorio</div>
				      	<div class="panel-body">Panel Content</div>
				    </div>
		        </div>
		        <div class="col-md-4">
		            <div class="panel panel-primary">
				      	<div class="panel-heading">Novedades</div>
				      	<div class="panel-body">
				      	<button type="button" class="btn btn-primary center-block" onclick="window.location.href = '../novedad/novedad.php'">Registrar novedades</button>
				      	</div>
				    </div>
		        </div>
		    </div>
		</div>

		<div class="main container">

            <div id="push"></div>
			<?php 

			$objProgramacion = new TbItemprogramacionacademicaController();
			$arrayProgramacion = $objProgramacion->getListaProgramacion($usuario_codigo);

			if(count($arrayProgramacion) > 0){
			?>
				<form action="" method="post" id="frmDatos">
			<?php

				foreach ($arrayProgramacion as $key => $value) {

			?>
					<div class="panel panel-default">
					<?php $value['chequeo']; ?>
						<!-- Default panel contents -->
						<div class="panel-heading">
				<?php echo "<label class='switch'>
								<input type='checkbox' name='registroasistencia[]' value = '".$value['iteproaca_codigo']."' ";
								if($value['chequeo'] > 0){
									echo " disabled";
								}
						echo 	">
									<div class='slider round'></div>
							</label>";
				?>
						<div class='col-sm-11' id=<?php echo "'proAca".$value['iteproaca_codigo']."'"; ?> value=<?php echo "'".$value['asignatura_codigoasignatura']."'"; ?> > <?php echo $value['iteproaca_codigo']." - ".$value['asignatura_codigoasignatura']; ?></div>
						</div>
						<div class="panel-body">							
							<div class="table-responsive">	
								<table class="table table-striped">	
									<thead class="thead-inverse">
								    	<tr>
											<th class="col-sm-2">Dia semana</th>
											<th class="col-sm-1">Hora inicio</th>
											<th class="col-sm-1">Hora fin</th>
											<th class="col-sm-1">Salon</th>											
											<th class="col-sm-1">Grupo</th>											
											<th class="col-sm-1">Jornada</th>											
											<th class="col-sm-1">Plan</th>										
								    	</tr>
								  	</thead>
									<tbody>
									    <tr>
									      <td class="col-sm-2"><?php echo $value['iteproaca_diasemana']; ?></td>			
									      <td class="col-sm-1"><?php echo $value['iteproaca_horainicio']; ?></td>
									      <td class="col-sm-1"><?php echo $value['iteproaca_horafinal']; ?></td>
									      <td class="col-sm-1"><?php echo $value['salon_nombre']; ?></td>
									      <td class="col-sm-1"><?php echo $value['iteproaca_grupo']; ?></td>
									      <td class="col-sm-1"><?php echo $value['jornada_nombre']; ?></td>
									      <td class="col-sm-1"><?php echo $value['proaca_codigoprograma']; ?></td>
									    </tr>
									</tbody>
								</table>
							</div>						
						</div>	
					</div>
			<?php 
				}
			?>	
				<div class="panel panel-fluid col-sm-12">
					<input type="hidden" name = 'modulo' value="listarAsistencia">
					<!--<button type="submit" name="enviarRegistro" id="enviarRegistro" class="btn btn-danger btn-block">Enviar</button>-->

					<a href="#ventana1" class="btn btn-danger btn-block" data-toggle="modal" id="btnEnv">Enviar</a>
						
				</div>
					
				</form>

				<div class="modal fade" id="ventana1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-tite" id="tituloModal">Registro asistencia</h2>
							</div>
							<div class="modal-body">

							<form action="" method="post" id="formulario">
								<table id='campos'>
									<thead>
										<th ></th>
									</thead>
									<tbody>
								
									</tbody>
								</table>

							</form>
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar">Cerrar</button>
								<button type="button" class="btn btn-primary" data-dimiss="modal" name="marcarAsistencia">Registrar Asistencia</button>
							</div>
						</div>	
					</div>
				</div>	

	<?php 	}else { ?>

				<div class="alert alert-info">
				  <strong>Warning!</strong>No hay progrmación registrada para el calendario actual activo
				</div>

	<?php 	} ?>

		</div>

	</body>
	<script src='https://code.jquery.com/jquery.js'></script>
	
	<script type="text/javascript">

		$(document).ready( function(){

			$("#cerrar").on("click", function(e){
					
					$("#campos").html("");
					e.preventDefault();
			});

			$("#btnEnv").on("click", function(e){

				var count = 0;
				
				$("input:checkbox:checked").each( function() {

					var id = $(this).val();
					$("#campos").append("<tr><td><hr><label>Código:</label><input type='text' class='form-control' name='itProAca"+count+"' value='"+$(this).val()+"' readonly='readonly' ></td></tr>");
					$("#campos").append("<tr><td><label>Curso:</label><input type='text' class='form-control' name='asig"+count+"' value='"+$("#proAca"+id+"").attr("value")+"' readonly='readonly' ></td></tr>");
					$("#campos").append("<tr><td><label>Tema</label><textarea class='form-control'  name='area_tema"+count+"' rows='4'></textarea></td></tr>");
					$("#campos").append("<tr><td><label>Observaciones</label><textarea class='form-control' name='area_observacion"+count+"' rows='4'></textarea></td></tr>");					

			    	count++;					    	
						       
		    	});

		    	e.preventDefault();
		    	
		    	$("#campos").append( "<tr><td><input type='hidden' name='modulo' value='registrar_asistencia'></td></tr>");
				$("#campos").append( "<tr><td><input type='hidden' name='cantIteProaca' value='"+count+"'></td></tr>");
				$("button[name=marcarAsistencia]").attr("id",count);

			});

			$("button[name=marcarAsistencia]").on("click", function(e){
				
				 
				//var count = $("button[name=marcarAsistencia]").attr("id");
				
				$.ajax({

		          method: "POST",
		          url: "../../Controller/TbRegistroAsistenciaController.php",
		          data:  $("#formulario").serialize(),
		          
		          success:function(data){

						//alert("Registrado!!");
						$("#formulario")[0].reset();
						location.reload();	                     

		          },

		          error:function(jqXHR, textStatus, errorThrown){
		            console.log("Error: " + errorThrown);
		          }

        		});

				e.preventDefault();


			});

		});
		
	</script>

</html>