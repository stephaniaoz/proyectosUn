<?php
require_once('database_credentials.php');

	// Conectando y seleccionado la base de datos  
	$dbconn = pg_connect("host=".DB_HOST." dbname=".DB_DATABASE." user=".DB_USER." password=".DB_PASSWORD." ")
	    or die('No se ha podido conectar: ' . pg_last_error());

	// Liberando el conjunto de resultados
	function resultClose($result){
		pg_free_result($result);
	}

	// Cerrando la conexión
	function conexionClose(){		
		pg_close($dbconn);
	}

?>