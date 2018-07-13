<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\View\utilities\utilities.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbCorteController.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbProgramacionSemanaController.php");


$usuario_codigo = isset($_SESSION['usuario_codigo'])?$_SESSION['usuario_codigo']:'';
$nombre_perfil_ingreso = isset($_SESSION['nombre_perfil_ingreso'])?$_SESSION['nombre_perfil_ingreso']:'';
$nombre_carrera_ingreso = isset($_SESSION['nombre_carrera_ingreso'])?$_SESSION['nombre_carrera_ingreso']:'';
$listaperfil = isset($_SESSION['lista_perfil'])?$_SESSION['lista_perfil']:'';

if($nombre_perfil_ingreso == ''){
	header('Location:panel_ingreso.php');
	die();
}
/*
if($nombre_carrera_ingreso == ''){
	header('Location:../panel_ingreso_carreras.php');
	die();
}*/

if($usuario_codigo == ''){
	header('Location:../Index.php');
	die();
}

$_SESSION['control_retorno']='1';

?>
<!DOCTYPE html>

<html lang="en">
<html>
	<?php head("Crear Programación semana"); 
			menu($nombre_perfil_ingreso, $listaperfil); ?>

		<div class="main container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">Cargar archivo de programación académica</div>
				<div class="panel-body">
					<form action="../../Controller/TbProgramacionSemanaController.php" enctype="multipart/form-data" method="post">
						<div class="form-group col-md-6">
							<label>Año</label>
							<input type="number" name="anno" class="form-control" placeholder="Año a programar" required>
						</div>
					  	<div class="form-group col-md-6">
					   		<label>Corte</label>
					   			<select type="text" name="corte" class="form-control" required>
									<option value="0">Seleccione uno</option>
									<?php 
										$objtCorte = new TbCorteController();
										$arraylistcorte = $objtCorte->listarCorte();

										foreach ($arraylistcorte as $key => $value) {
											echo "<option value='".$value['corte_codigo']."'>".$value['corte_nombre']."</option>";
										}
									?>						
								</select>
					  	</div>
					  	<div class="form-group col-md-6">
					  		<label>Fecha inicial</label>
					  		<input type="date" name="fechaInicial" class="form-control" required>	
					  	</div>
					  	<div class="form-group col-md-6">
					  		<label>Fecha final</label>
					  		<input type="date" name="fechaFinal" class="form-control" required>
					  	</div>
					  	<input type="submit" name="" value="Guardar" class="btn btn-danger center-block btntam"></input>
					  	<input type="hidden" name="modulo" value="guardar_periodo">							
					</form>
				</div>
			</div>

			<div class="panel panel-default">
			   	<div class="panel-heading">
			    	<h3 class="panel-title">Detalle</h3>
			  	</div>
			  	<div class="panel-body">
			    	<?php 
						$objtProSemCont = new TbProgramacionSemanaController();
						$listProSem = $objtProSemCont -> listarProgramacionSemana();

						if(count($listProSem) > 0){ ?>
							<div class="table-responsive">
								<table class="table table-striped">
									<tr>
										<th>Año</th>
										<th>CORTE</th>
										<th>FECHA INICIAL</th>
										<th>FECHA FINAL</th>
										<th>NUMERO SEMANAS</th>
										<th>ESTADO</th>
									</tr>

									<?php foreach ($listProSem as $key => $value) { 

										echo "<tr>
												<td>".$value['prosem_ano']."</td>
												<td>".$value['corte_nombre']."</td>
												<td>".$value['prosem_fechainicial']."</td>
												<td>".$value['prosem_fechafinal']."</td>
												<td>".$value['prosem_numerosemanas']."</td>
												<td>".$value['estado_nombre']."</td>
											</tr>";
											
									} ?>
								</table>
							</div>	

				 <?php }else{
							echo "<p>No hay programación semena registrada</p>";
						}?>

			  	</div>
			</div>
		</div>		



	</body>

</html>	