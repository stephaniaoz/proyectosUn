<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbUsuarioController.php");
include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Controller\TbProgramaacademicoController.php");

session_destroy ();

//echo realpath("../Controller/TbUsuarioController.php") . PHP_EOL;

/*
$result = run_query();

echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);

*/



?>
<!DOCTYPE html>

<html lang="en">
<html>
	<head>
	<meta charset="UTF-8">
		<title>Pagina inicial</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	</head>
	<body>
	<center>

		<img src="images/logoUnivalle.png" width="250" height="350">

		<h3 class='b_titulo'>LOGIN</h3>

		<form name="fromularioLogin" method="post" action="../Controller/TbUsuarioController.php"> 
			<label class="textogeneral">Tipo de usuario:</label>
			<select id="s_perfil_inicio" name="s_perfil_inicio" required class="caja">
				<option value="0">SELECCIONE UNO</option>
                <option value="EMPRESA">EMPRESA</option>
                <option value="USUARIO">USUARIO</option>
            </select>
            <br>
			<p  class="textogeneral">Usuario:</p><input type="text" name="usuario_usuario_login" value="" required>
			<br>
			<p  class="textogeneral">Contraseña:</p><input type="password" name="usuario_password" value="" required>
			<br><br>
			<input type="hidden" name = 'modulo' value="ingresoLogin">
			<input type="submit" value="Ingresar" class="submit">
		</form>
		<br>
		
	</center>
		<br><br>
		<div class="seprarador"></div>
		<br><br>

		<table class='t_visita' cellpadding = '18' cellspacing = '0'>

			<form name="form" method="GET" action="ResultadoInteresInvitado.php" >
				<label class="textogeneral">Programa academico:</label>&nbsp;
				<select name="s_programaacademico" class="caja">
					<option value='0'>SELECCIONE UNO</option>
					<?php 
						$arrayProgAca = array();
						$objProgAca = new TbProgramaacademicoController();
						$arrayProgAca = $objProgAca->getListaProgramaacademico();

						foreach ($arrayProgAca as $key => $value) {
							echo"<option value='".$value['proaca_codigo']."'>".$value['proaca_nombre']."</option>";
						}
					?>	
				</select>
			&nbsp;&nbsp;
			<input type="submit" value="Buscar" class="submit">
		</form>
		<br><br>
		<?php 
			$arrayUsuContact = array();
			$listaUsuarioContacto = new TbUsuarioController();
			//se recorre arreglo de usuarios contacto
			$arrayUsuContact = $listaUsuarioContacto->getListaUsuarioContacto();

			echo "	<tr class='tr_celda_par'>
						<th class='b_visita'>Listado de contactos de empleo</th>
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
							</tr>
						</tbody>";

				$tipo_celda++;

			}
		?>
		</table>


	</body>
</html>