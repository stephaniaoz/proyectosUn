<?php
require_once('database_credentials.php');

	// Conectando y seleccionado la base de datos  
	$dbconn = pg_connect("host=".DB_HOST." dbname=".DB_DATABASE." user=".DB_USER." password=".DB_PASSWORD." ")
	    or die('No se ha podido conectar: ' . pg_last_error());


	/*
	function run_query(){
		// Realizando una consulta SQL
		$query = "SELECT * FROM tb_persona";
		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;
	}
	*/

	function run_query(){
		// Realizando una consulta SQL
		$query = "	SELECT usuario_codigo, usuario_nombres, usuario_apellidos, usuario_titulootorgado 
					FROM tb_usuario
					WHERE perfil_codigo = 3 ";
		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;
	}

	// Liberando el conjunto de resultados
	function resultClose($result){
		pg_free_result($result);
	}

	// Cerrando la conexión
	function conexionClose(){		
		pg_close($dbconn);
	}
		

		


?>