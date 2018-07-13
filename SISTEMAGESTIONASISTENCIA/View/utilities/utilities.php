<?php

include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbPaqueteController.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbModuloController.php");
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\TbItemProgramacionSemanaController.php");

$objsemana = new TbItemProgramacionSemanaController();
$array = $objsemana->getRangoFechaSemana();

define('FECHASEMANAINICIAL', $array[0]);
define('FECHASEMANAFINAL',  $array[1]);

function menu($nombre_perfil_ingreso, $arregloperfil){

	$iconodropdown = '';

	echo "	<section class='jumbotron'>
				<div class='container'>
					<h1 class='tituloencabezado'>Sistema de gestión integral</h1>
					<p>Universidad del valle</p>
				</div>							
			</section>
			<header>
				<nav class='navbar navbar-inverse' role='navigation'>
					<div class='container-fluid'>
						<div class='navbar-header'>
							<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#acolapsar'>
								<span class='sr-only'>Toggle navigation</span>
								<span class='icon-bar'></span>
								<span class='icon-bar'></span>
								<span class='icon-bar'></span>
							</button>
							<a href='#' class='navbar-brand'>Mi proyect</a>
						</div>
						<div class='collapse navbar-collapse' id='acolapsar'>
							<ul class='nav navbar-nav'>";

								$objTbPaqueteController = new TbPaqueteController();
								$arrayListaMenu=$objTbPaqueteController->vistaOpcionesMenu($nombre_perfil_ingreso);

								foreach ($arrayListaMenu as $posicion => $valor) {
									
									$objmodulo = new TbModuloController();
									$arraymodulo = $objmodulo->vistaModulos($valor['paquete_codigo']);

									if(count($arraymodulo) > 0){
										$iconodropdown = "<b class='caret'></b>";
										$clasedropdown = " class='dropdown' ";
										$classdropdown = " class='dropdown-toggle' data-toggle='dropdown' ";
									}else{
										$iconodropdown = "";
										$clasedropdown = "";
										$classdropdown = "";
									}

									echo "	<li ".$clasedropdown.">
												<a href='#' ".$classdropdown." >".ucfirst(strtolower($valor['paquete_nombre']))." ".$iconodropdown."</a>
												<ul class='dropdown-menu'>";						

									if(count($arraymodulo) > 0){
										foreach ($arraymodulo as $pos => $valorm) {
											echo "<li><a href='".$valorm['modulo_url']."'>".ucfirst(strtolower($valorm['modulo_nombre']))."</a></li>";
										}	
									}

														

									echo "	      
											    </ul>
											</li>";
								}

			echo "
							</ul>

							<ul class='nav navbar-nav navbar-right'>
								<li><a href='#'>".$nombre_perfil_ingreso."</a></li>				   
						        <li class='dropdown'>
						          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Log Out<span class='caret'></span></a>
						          <ul class='dropdown-menu'> ";
						    if(count($arregloperfil) > 1){
			echo " 				<li><a href='../Ingreso/panel_ingreso.php?control_retorno='0''>cerrar perfil</a>
								</li>
								<li role='separator' class='divider'></li> ";
						    }
			echo "		            
						            <li><a href='../Index.php'>cerrar sesión</a></li>
						          </ul>
						        </li>
						    </ul>

						</div>
					</div>
				</nav>
			<header>";

}

function head($titulopagina){
	echo "	
			<head>
				<meta charset='UTF-8'>
				<title>".$titulopagina."</title>
				<link rel='stylesheet' type='text/css' href='../css/style.css'/>
				<link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet'>
				<script src='https://code.jquery.com/jquery.js'></script>

				<script type='text/javascript'>

					function deshabilitaRetroceso(){
					    window.location.hash='no-back-button';
					    window.location.hash='Again-No-back-button' //chrome
					    window.onhashchange=function(){window.location.hash='no-back-button';}
					}

				</script>
				<script src='../bootstrap/js/bootstrap.min.js'></script>
			</head>

			<body onload='deshabilitaRetroceso()'> ";
}

function menu2($nombre_perfil_ingreso){

	echo "	<nav class='navbar navbar-inverse' role='navigation'>
			<div class='container-fluid'>
				<div class='navbar-header'>
					<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#acolapsar'>
						<span class='sr-only'>Toggle navigation</span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
					</button>
					<a href='#' class='navbar-brand'>Mi proyect</a>
				</div>
				<div class='collapse navbar-collapse' id='acolapsar'>
					<ul class='nav navbar-nav'>";

						$objTbPaqueteController = new TbPaqueteController();
						$arrayListaMenu=$objTbPaqueteController->vistaOpcionesMenu($nombre_perfil_ingreso);

						foreach ($arrayListaMenu as $posicion => $valor) {
							
							echo "	<li class='dropdown'>
										<a href='#' class='dropdown-toggle' data-toggle='dropdown'>".ucfirst(strtolower($valor['paquete_nombre']))."<b class='caret'></b></a>
										<ul class='dropdown-menu'>";
											
							$objmodulo = new TbModuloController();
							$arraymodulo = $objmodulo->vistaModulos($valor['paquete_codigo']);

							if(count($arraymodulo) > 0){
								foreach ($arraymodulo as $pos => $valorm) {
									echo "<li><a href='".$valorm['modulo_url']."'>".ucfirst(strtolower($valorm['modulo_nombre']))."</a></li>";
								}	
							}

												

							echo "	      
									    </ul>
									</li>";
						}

	echo "				<li><a href='#'><span class='glyphicon glyphicon-home'></span>Inicio</a></li>
						<li><a href='#'><span class='glyphicon glyphicon-cog'></span>Settings</a></li>
						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown'>dropdown<b class='caret'></b></a>
							<ul class='dropdown-menu'>
								
								<li><a href='#'>Link 2</a></li>
								<li><a href='#'>Link 3</a></li>
								<li><a href='#'>Link 4</a></li>
								<li><a href='#'>Link 5</a></li>
							</ul>
						</li>
					</ul>

					<ul class='nav navbar-nav navbar-right'>
				        <li><a href='#'>Link</a></li>
				        <li class='dropdown'>
				          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Log Out<span class='caret'></span></a>
				          <ul class='dropdown-menu'>
				            <li><a href='../Ingreso/panel_ingreso.php?control_retorno='0''>cerrar perfil</a></li>
				            <li role='separator' class='divider'></li>
				            <li><a href='../Index.php'>cerrar sesión</a></li>
				          </ul>
				        </li>
				     </ul>

				</div>
			</div>
		</nav>";

}

function menu1($nombre_perfil_ingreso){

	echo "
			<ul>";

					$objTbPaqueteController = new TbPaqueteController();
					$arrayListaMenu=$objTbPaqueteController->vistaOpcionesMenu($nombre_perfil_ingreso);

					foreach ($arrayListaMenu as $posicion => $valor) {
						
						echo "	<li class='dropdown'>
									<a href='#' class='dropbtn'>".$valor['paquete_nombre']."</a>
									<div class='dropdown-content'>";
										
						$objmodulo = new TbModuloController();
						$arraymodulo = $objmodulo->vistaModulos($valor['paquete_codigo']);

						if(count($arraymodulo) > 0){
							foreach ($arraymodulo as $pos => $valorm) {
								echo "<a href='".$valorm['modulo_url']."'>".$valorm['modulo_nombre']."</a>";
							}	
						}

											

						echo "	      
								    </div>
								</li>";
					}

	echo "	
				<li style='float:right'><a class='active' href='../Index.php'>cerrar sesión</a></li>			  	
			  	<li style='float:right'><a class='active' href='../Ingreso/panel_ingreso.php?control_retorno='0' '>cerrar perfil</a></li>			  	
			</ul>

	";

}

?>
