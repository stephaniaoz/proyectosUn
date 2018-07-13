<?php

//echo date('Y-m-d',strtotime('11-12-2016'));

//USUARIO:
var_dump($_REQUEST);
if($_REQUEST){


$usuario_codigo = isset($_REQUEST['s_tipodocumento'])?$_REQUEST['s_tipodocumento']:0;
$usuario_numeroidentificacion = isset($_REQUEST['usuario_numeroidentificacion'])?$_REQUEST['usuario_numeroidentificacion']:'';
$usuario_nombres = isset($_REQUEST['usuario_nombres'])?$_REQUEST['usuario_nombres']:'';
$usuario_apellidos = isset($_REQUEST['usuario_apellidos'])?$_REQUEST['usuario_apellidos']:'';
$usuario_fechanacimiento = isset($_REQUEST['usuario_fechanacimiento'])?date('Y-m-d',strtotime($_REQUEST['usuario_fechanacimiento'])):'';
$ciudad_codigo_nacimiento = isset($_REQUEST['ciudad_codigo_nacimiento'])?$_REQUEST['ciudad_codigo_nacimiento']:0;
$usuario_sexo = isset($_REQUEST['usuario_sexo'])?$_REQUEST['usuario_sexo']:'';
$usuario_telefono = isset($_REQUEST['usuario_telefono'])?$_REQUEST['usuario_telefono']:'';
$usuario_celular = isset($_REQUEST['usuario_celular'])?$_REQUEST['usuario_celular']:'';
$usuario_email = isset($_REQUEST['usuario_email'])?$_REQUEST['usuario_email']:'';
$s_estado = isset($_REQUEST['s_estado'])?$_REQUEST['s_estado']:0;
$s_perfil = isset($_REQUEST['s_perfil'])?$_REQUEST['s_perfil']:0;
$usuario_usuario_login = isset($_REQUEST['usuario_usuario_login'])?$_REQUEST['usuario_usuario_login']:'';
$usuario_password = isset($_REQUEST['usuario_password'])?$_REQUEST['usuario_password']:'';
$s_tipoformacion = isset($_REQUEST['s_tipoformacion'])?$_REQUEST['s_tipoformacion']:0;
$usuario_estudiantehabilitado = isset($_REQUEST['usuario_estudiantehabilitado'])?$_REQUEST['usuario_estudiantehabilitado']:'';
$s_programaacademico = isset($_REQUEST['s_programaacademico'])?$_REQUEST['s_programaacademico']:0;
$s_itementidadestudio = isset($_REQUEST['s_itementidadestudio'])?$_REQUEST['s_itementidadestudio']:0;
$s_ciudad = isset($_REQUEST['s_ciudad'])?$_REQUEST['s_ciudad']:0;
$usuario_descripcionperfil = isset($_REQUEST['usuario_descripcionperfil'])?$_REQUEST['usuario_descripcionperfil']:'';
$usuario_hojadevida = isset($_REQUEST['usuario_hojadevida'])?$_REQUEST['usuario_hojadevida']:'';
$usuario_codigoestudiante = isset($_REQUEST['usuario_codigoestudiante'])?$_REQUEST['usuario_codigoestudiante']:0;

echo "usuario_:::: ".$usuario_codigo."<br>";
echo "usuario_:::: ".$usuario_numeroidentificacion."<br>";
echo "usuario_:::: ".$usuario_nombres."<br>";
echo "usuario_:::: ".$usuario_apellidos."<br>";
echo "usuario_:::: ".$usuario_fechanacimiento."<br>";
echo "ciudad_c:::: ".$ciudad_codigo_nacimiento."<br>";
echo "usuario_:::: ".$usuario_sexo."<br>";
echo "usuario_:::: ".$usuario_telefono."<br>";
echo "usuario_:::: ".$usuario_celular."<br>";
echo "usuario_:::: ".$usuario_email."<br>";
echo "s_estado:::: ".$s_estado."<br>";
echo "s_perfil:::: ".$s_perfil."<br>";
echo "usuario_:::: ".$usuario_usuario_login."<br>";
echo "usuario_:::: ".$usuario_password."<br>";
echo "s_tipofo:::: ".$s_tipoformacion."<br>";
if($usuario_estudiantehabilitado){
	echo "usuario_habilitado:::: ".$usuario_estudiantehabilitado."<br>";
}else{
	echo "usuario_NOOhabilitado:::: ".$usuario_estudiantehabilitado."<br>";
}
echo "_progra:::: ".$s_programaacademico."<br>";
echo "_itemen:::: ".$s_itementidadestudio."<br>";
echo "s_ciudad:::: ".$s_ciudad."<br>";
echo "usuario_:::: ".$usuario_descripcionperfil."<br>";
echo "usuario_:::: ".$usuario_hojadevida."<br>";
echo "usuario_:::: ".$usuario_codigoestudiante."<br>";


}

?>