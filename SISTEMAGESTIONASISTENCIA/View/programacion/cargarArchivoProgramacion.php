<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbSedeController.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbProgramacionSemanaController.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\View\utilities\utilities.php");




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

//$_SESSION['control_retorno']='1';

?>
<!DOCTYPE html>

<html lang="en">
<html>
	<?php head("Cargar archivo"); 
			menu($nombre_perfil_ingreso, $listaperfil); ?>

			<div class="main container-fluid">
				<div class="panel panel-default">
					<div class="panel-heading">Cargar archivo de programación académica</div>
					<div class="panel-body">
						<form action="../../Controller/TbProgramacionacademicaController.php" enctype="multipart/form-data" method="post">
							<div class="form-group">
								<label><a rel="shortcut icon" href="estructuraCargarArchivoProgramacion.csv">Descarga estructura</a></label>
								<span class="glyphicon glyphicon-save"></span>
							</div>
						  	<div class="form-group col-md-6" >
						    	<label>Sede</label>
						    	<select class="form-control" name="s_sede_codigo" required>
						          	<option value="">Seleccione uno</option>
						          	<?php 
										$objtTbSedeController = new TbSedeController();
										$arrayListSede = $objtTbSedeController-> listarSedes();

										foreach ($arrayListSede as $key => $sede) {
											echo "<option value='".$sede['sede_codigo']."'>".$sede['sede_nombre']."</option>";
										}
									?>
						        </select>
						  	</div>
						  	<div class="form-group col-md-6">
						   		<label>Programacion Semana</label>
						    	<select class="form-control" name="s_prosem_codigo" required>
						          	<option value="">Seleccione uno</option>
						          	<?php 

										$objtTbProgramacionSemanaController = new TbProgramacionSemanaController();
										$arrayListProSem = $objtTbProgramacionSemanaController->listarProgramacionSemana();

										foreach ($arrayListProSem as $key => $prosem) {
											echo "<option value='".$prosem['prosem_codigo']."'>".$prosem['prosem_ano']."-".$prosem['corte_nombre']."</option>";
										}

									?>
						        </select>
						  	</div>
						  	<div class="form-group col-md-6" id="archivo" accept=".csv" name="archivo" type="file" required>
						    	<label for="exampleInputFile">Archivo</label>
						    	<input type="file" id="archivo" accept=".csv" name="archivo">
						    	<input name="MAX_FILE_SIZE" type="hidden" value="20000" />
						    	<p class="help-block">Cargue el archivo de la programación académica.</p>
						  	</div>
						  	<div class="form-group col-md-6">
						   		<label>Observación</label>
						    	<textarea class="form-control" rows="3" name='area_observacion'></textarea>
						  	</div>
						  	<input type="submit" name="" value="Grabar" class="btn btn-danger center-block btntam"></input>
						  	<input type="hidden" name="modulo" value="cargar_archivo_proaca">
						</form>									
					</div>
				</div>
			</div>	

		</section>	

	</body>

</html>	