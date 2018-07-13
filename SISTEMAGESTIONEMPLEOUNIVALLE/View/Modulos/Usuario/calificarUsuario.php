<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\Controller_credentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbUsuarioController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbItemusuariocalificacionController.php");

$usuario_codigo = isset($_REQUEST['usuario_codigo'])?$_REQUEST['usuario_codigo']:0;

if(empty($_SESSION['usuario_codigo']) || empty($_SESSION['perfil_descripcion'])){
	header('Location: Index.php');
	die();
}


?>
<!DOCTYPE html>

<html lang="en">
<html>
<head>
<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />

</head>
	<body>

	<?php 

		if($_SESSION['perfil_descripcion'] == 'EMPRESA'){

	?>

			<h3>FORMULARIO PARA CALIFICAR USUARIO</h3>

			<form name="fromularioCalificarusuario" method="post" action="../../../Controller/TbItemusuariocalificacionController.php">
				<P>Código de usuario: <?php echo $usuario_codigo;  ?></P>
				<p>Empresa que califica: <strong><?php echo $_SESSION['usuario_nombrecompleto'] ?></strong>
				<br><br>
				Estrellas:
				<input type="number" name="iteusucal_estrellas" min="1" max="5" required>
				<br><br>
				Descripción calificación:
				<textarea name="iteusucal_descripcion" cols="50" rows="10" id="iteusucal_descripcion" required></textarea>
				<br><br>
				<input type="hidden" name="usuario_codigo" value="<?php echo $usuario_codigo; ?>">
				<input type="hidden" name="modulo" value="grabarCalificacion">
				<input type="submit" value="Grabar">
			</form>
	
	<?php		

		}

	?>

	<div class="fillformUsuario">
			<table class='t_visita' cellpadding = '18' cellspacing = '0'>
				<?php
					$arrayUsuCal = array();
					$listaUsuarioCalificacion = new TbItemusuariocalificacionController();
					//se recorre arreglo de usuarios contacto
					$arrayUsuCal = $listaUsuarioCalificacion->getListaCalifiacion($usuario_codigo);

					echo "	<tr class='tr_celda_par'>
								<th class='b_visita'>Listado de calificaciones <a href='../../Index.php'>cerrar_session</a></th>
							</tr>";

					$tipo_celda = 1;

					foreach ($arrayUsuCal as $posicion => $valor) {
						
						if($tipo_celda % 2 == 0){
							$estilo_celda = "tr_celda_par";
						}else{
							$estilo_celda = "tr_celda_impar";
						}


						echo "	<tbody class='b_visita'>	
									<tr class='".$estilo_celda." filausuario'>
										<td><label>Empresa que califica:</label> \t ".$valor['empresa_razonsocial']."	
										<br><br>
										<label>Estrellas:</label> ".$valor['iteusucal_estrellas']."</td>
										<br>
										<td><label>Descripción:</label> ".$valor['iteusucal_descripcion']."</td>
										</td>
									</tr>
								</tbody>";

						$tipo_celda++;

					}
				?>
			</table>
		</div>


	</body>
</html>