<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");


class TbUsuario{

	private $usuarioCodigo; 
    private $tipdocCodigo; 
    private $usuarioNumeroIdentificacion; 
    private $usuarioNombres; 
    private $usuarioApellidos; 
    private $usuarioFechanacimiento; 
    private $ciudadCodigoNacimiento; 
    private $usuarioSexo; 
    private $usuarioTelefono; 
    private $usuarioCelular; 
    private $usuarioEmail; 
    private $estadoCodigo; 
    private $perfilCodigo; 
    private $usuarioUsuarioLogin; 
    private $usuarioPassword; 
    private $tipforCodigo; 
    private $usuarioEstudiantehabilitado; 
    private $proacaCodigo; 
    private $usuarioTitulootorgado; 
    private $entestCodigo; 
    private $iteentestsedCodigo; 
    private $ciudadCodigo; 
    private $usuarioDescripcionperfil; 
    private $usuarioHojadevida; 
    private $usuarioCodigoestudiante;

	function __construct(){

	}

    /*  Consulta en la base de datos todos los contactos con 
        perfil de 'CONTACTO' (personas que solicitan trabajo) en forma resumida
        y lo devuelve en arreglo asociativo */
    public function resultListaUsuarioContacto(){

        $query  = " SELECT u.usuario_codigo, initcap(u.usuario_nombres) as usuario_nombres, initcap(u.usuario_apellidos) as usuario_apellidos, initcap(p.proaca_titulootorgado) as usuario_titulootorgado, initcap(e.entest_nombre) as entest_nombre
                    FROM tb_usuario u
                    JOIN tb_itementidadestudiosede i ON i.iteentestsed_codigo = u.iteentestsed_codigo
                    JOIN tb_entidadestudio e ON e.entest_codigo = i.entest_codigo
                    JOIN tb_programaacademico p ON p.proaca_codigo = u.proaca_codigo
                    WHERE perfil_codigo = 3 
                    ORDER BY u.usuario_nombres ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function resultListaUsuarioContactoPorPrograma($proaca_codigo){

        $query  = " SELECT u.usuario_codigo, initcap(u.usuario_nombres) as usuario_nombres, initcap(u.usuario_apellidos) as usuario_apellidos, initcap(p.proaca_titulootorgado) as usuario_titulootorgado, initcap(e.entest_nombre) as entest_nombre
                    FROM tb_usuario u
                    JOIN tb_itementidadestudiosede i ON i.iteentestsed_codigo = u.iteentestsed_codigo
                    JOIN tb_entidadestudio e ON e.entest_codigo = i.entest_codigo
                    JOIN tb_programaacademico p ON p.proaca_codigo = u.proaca_codigo
                    WHERE perfil_codigo = 3 AND u.proaca_codigo = ".$proaca_codigo."
                    ORDER BY u.usuario_nombres ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }


    public function resultListaConsultaUsuario($iteentestsed_codigo, $ano, $mes){

        if($iteentestsed_codigo == 0){
            $iteentestsed_codigo = ''; 
        }else{
            $iteentestsed_codigo = " and  u.iteentestsed_codigo = ".$iteentestsed_codigo." ";
        }

        if($ano == ''){
            $ano = '';
        }else{
            $ano = " and extract(year from u.usuario_fechacreacion) =  '".$ano."' ";
        }

        if($mes == ''){
            $mes = '';
        }else{
            $mes = " and extract(month from u.usuario_fechacreacion) = '".$mes."' ";
        }

        $query  = " SELECT u.usuario_codigo, initcap(u.usuario_nombres) as usuario_nombres, initcap(u.usuario_apellidos) as usuario_apellidos, initcap(p.proaca_titulootorgado) as usuario_titulootorgado, initcap(e.entest_nombre) as entest_nombre
                    FROM tb_usuario u
                    JOIN tb_itementidadestudiosede i ON i.iteentestsed_codigo = u.iteentestsed_codigo
                    JOIN tb_entidadestudio e ON e.entest_codigo = i.entest_codigo
                    JOIN tb_programaacademico p ON p.proaca_codigo = u.proaca_codigo
                    WHERE TRUE ".$iteentestsed_codigo." ".$ano." ".$ano."
                    ORDER BY u.usuario_nombres ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }



	/*	Consulta en la base de datos todos los contactos con 
		perfil de 'CONTACTO' (personas que solicitan trabajo) en forma resumida
		y lo devuelve en arreglo asociativo */
	public function resultListaUsuario(){

		$query  = "	SELECT u.usuario_codigo, initcap(u.usuario_nombres) as usuario_nombres, initcap(u.usuario_apellidos) as usuario_apellidos, initcap(p.proaca_titulootorgado) as usuario_titulootorgado, initcap(e.entest_nombre) as entest_nombre, pe.perfil_descripcion
					FROM tb_usuario u
                    JOIN tb_itementidadestudiosede i ON i.iteentestsed_codigo = u.iteentestsed_codigo
					JOIN tb_entidadestudio e ON e.entest_codigo = i.entest_codigo
                    JOIN tb_programaacademico p ON p.proaca_codigo = u.proaca_codigo
                    JOIN tb_perfil pe ON pe.perfil_codigo = u.perfil_codigo
					ORDER BY u.usuario_nombres ";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}

    public function resultListaUsuarioPerfilsesion(){

        $query  = " SELECT u.usuario_codigo, initcap(u.usuario_nombres) as usuario_nombres, initcap(u.usuario_apellidos) as usuario_apellidos, initcap(p.proaca_titulootorgado) as usuario_titulootorgado, initcap(e.entest_nombre) as entest_nombre, pe.perfil_descripcion
                    FROM tb_usuario u
                    JOIN tb_itementidadestudiosede i ON i.iteentestsed_codigo = u.iteentestsed_codigo
                    JOIN tb_entidadestudio e ON e.entest_codigo = i.entest_codigo
                    JOIN tb_programaacademico p ON p.proaca_codigo = u.proaca_codigo
                    JOIN tb_perfil pe ON pe.perfil_codigo = u.perfil_codigo 
                    WHERE u.perfil_codigo = 3
                    ORDER BY u.usuario_nombres ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function resultListaUsuarioId($id){

        $query  = " SELECT u.*, e.entest_codigo, d.pais_codigo, c.departamento_codigo, d.departamento_nombre, i.iteentestsed_nombre, c.ciudad_nombre, pr.proaca_nombre, e.entest_nombre, tf.tipfor_descripcion
                    FROM tb_usuario u
                    JOIN tb_itementidadestudiosede i ON i.iteentestsed_codigo = u.iteentestsed_codigo
                    JOIN tb_entidadestudio e ON e.entest_codigo = i.entest_codigo
                    JOIN tb_ciudad c ON c.ciudad_codigo = u.ciudad_codigo
                    JOIN tb_departamento d ON d.departamento_codigo = c.departamento_codigo
                    JOIN tb_pais p ON p.pais_codigo = p.pais_codigo
                    JOIN tb_programaacademico pr ON pr.proaca_codigo = u.proaca_codigo
                    JOIN tb_tipoformacion tf ON tf.tipfor_codigo = u.tipfor_codigo
                    --WHERE perfil_codigo = 3 
                    WHERE u.usuario_codigo = ".$id." 
                    ORDER BY u.usuario_nombres ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

    public function save($objetoUsuario){

        $objetoUsuario->setUsuarioCodigo($this->maxUsuarioCodigo());

        $query = "  INSERT INTO tb_usuario(
                            usuario_codigo, tipdoc_codigo, usuario_numeroidentificacion, 
                            usuario_nombres, usuario_apellidos, usuario_fechanacimiento, 
                            ciudad_codigo_nacimiento, usuario_sexo, usuario_telefono, usuario_celular, 
                            usuario_email, estado_codigo, perfil_codigo, usuario_usuario_login, 
                            usuario_password, tipfor_codigo, usuario_estudiantehabilitado, 
                            proaca_codigo, iteentestsed_codigo, ciudad_codigo, usuario_descripcionperfil, 
                            usuario_hojadevida, usuario_codigoestudiante)
                    VALUES (".$objetoUsuario->getUsuarioCodigo().", ".$objetoUsuario->getTipdocCodigo().", '".$objetoUsuario->getUsuarioNumeroIdentificacion()."', 
                            '".$objetoUsuario->getUsuarioNombres()."', '".$objetoUsuario->getUsuarioApellidos()."', '".$objetoUsuario->getUsuarioFechanacimiento()."', 
                            ".$objetoUsuario->getCiudadCodigoNacimiento().", '".$objetoUsuario->getUsuarioSexo()."', '".$objetoUsuario->getUsuarioTelefono()."', '".$objetoUsuario->getUsuarioCelular()."', 
                            '".$objetoUsuario->getUsuarioEmail()."', ".$objetoUsuario->getEstadoCodigo().", ".$objetoUsuario->getPerfilCodigo().", '".$objetoUsuario->getUsuarioUsuarioLogin()."', 
                            '".$objetoUsuario->getUsuarioPassword()."', ".$objetoUsuario->getTipforCodigo().", '".$objetoUsuario->getUsuarioEstudiantehabilitado()."', 
                            ".$objetoUsuario->getProacaCodigo().", ".$objetoUsuario->getIteentestsedCodigo().", ".$objetoUsuario->getCiudadCodigo().", '".$objetoUsuario->getUsuarioDescripcionperfil()."', 
                            '".$objetoUsuario->getUsuarioHojadevida()."', '".$objetoUsuario->getUsuarioCodigoestudiante()."'
                            ); ";

        $result = @pg_query($query);

        $errorquery = @pg_last_error();

        if($errorquery){
            $afectadas = 'La consulta falló. Código: u01';             
        }else{
            $afectadas = 'Se agregó el usuario exitosamente, filas afectadas: '.pg_affected_rows($result);
        }       

        return $afectadas;

    }

    public function update($objetoUsuario){

        $query = "  UPDATE tb_usuario
                    SET tipdoc_codigo=".$objetoUsuario->getTipdocCodigo().", usuario_numeroidentificacion='".$objetoUsuario->getUsuarioNumeroIdentificacion()."', 
                           usuario_nombres='".$objetoUsuario->getUsuarioNombres()."', usuario_apellidos='".$objetoUsuario->getUsuarioApellidos()."', usuario_fechanacimiento='".$objetoUsuario->getUsuarioFechanacimiento()."', 
                           ciudad_codigo_nacimiento=".$objetoUsuario->getCiudadCodigoNacimiento().", usuario_sexo='".$objetoUsuario->getUsuarioSexo()."', usuario_telefono='".$objetoUsuario->getUsuarioTelefono()."', 
                           usuario_celular='".$objetoUsuario->getUsuarioCelular()."', usuario_email='".$objetoUsuario->getUsuarioEmail()."', estado_codigo=".$objetoUsuario->getEstadoCodigo().", perfil_codigo=".$objetoUsuario->getPerfilCodigo().", 
                           usuario_usuario_login='".$objetoUsuario->getUsuarioUsuarioLogin()."', usuario_password='".$objetoUsuario->getUsuarioPassword()."', tipfor_codigo=".$objetoUsuario->getTipforCodigo().", 
                           usuario_estudiantehabilitado='".$objetoUsuario->getUsuarioEstudiantehabilitado()."', proaca_codigo=".$objetoUsuario->getProacaCodigo().", iteentestsed_codigo=".$objetoUsuario->getIteentestsedCodigo().", 
                           ciudad_codigo=".$objetoUsuario->getCiudadCodigo().", usuario_descripcionperfil='".$objetoUsuario->getUsuarioDescripcionperfil()."', usuario_hojadevida='".$objetoUsuario->getUsuarioHojadevida()."', 
                           usuario_codigoestudiante='".$objetoUsuario->getUsuarioCodigoestudiante()."'
                     WHERE usuario_codigo = ".$objetoUsuario->getUsuarioCodigo()."; ";

        $result = pg_query($query);

        $errorquery = pg_last_error();

        if($errorquery){
            $afectadas = 'La consulta falló. Código: u01';        
        }else{
            $afectadas = 'Se actualizó el usuario exitosamente, filas afectadas: '.pg_affected_rows($result);
        }       

        return $afectadas;

    }

    public function updateContactoSesion($objetoUsuario){

        $query = "  UPDATE tb_usuario
                    SET usuario_telefono='".$objetoUsuario->getUsuarioTelefono()."', 
                           usuario_celular='".$objetoUsuario->getUsuarioCelular()."', usuario_email='".$objetoUsuario->getUsuarioEmail()."', usuario_usuario_login='".$objetoUsuario->getUsuarioUsuarioLogin()."', usuario_password='".$objetoUsuario->getUsuarioPassword()."' 
                    WHERE usuario_codigo = ".$objetoUsuario->getUsuarioCodigo()." ; ";

        $result = pg_query($query);

        $errorquery = pg_last_error();

        if($errorquery){
            $afectadas = 'La consulta falló. Código: u01';        
        }else{
            $afectadas = 'Se actualizó el usuario exitosamente, filas afectadas: '.pg_affected_rows($result);
        }       

        return $afectadas;

    }

    public function delete($usuarioCodigo){

        $query = " DELETE FROM Tb_usuario WHERE usuario_codigo = ".$usuarioCodigo." ";

        $result = @pg_query($query);

        $errorquery = @pg_last_error();

        if($errorquery){
            $afectadas = 'La consulta falló. Código: u01';             
        }else{
            $afectadas = 'Se eliminó el usuario exitosamente, filas afectadas: '.@pg_affected_rows($result);
        }       

        return $afectadas;

    }

    public function maxUsuarioCodigo(){

        $maximo = 1;

        $query  = " SELECT (max(u.usuario_codigo) + 1) AS maximo
                    FROM tb_usuario u ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        $arrayUsuario = pg_fetch_assoc($result);
        $maximo = $arrayUsuario['maximo'];

        return $maximo;
    }

    public function validaLogin($usuario_usuario_login, $usuario_password){

        $pass = false;
        $user = false;

        $maximo = 1;

        $query  = " SELECT case when count(*) > 0 then 'EXISTE' else 'NO EXISTE' end AS validausuario
                    FROM tb_usuario u 
                    WHERE usuario_usuario_login = '".$usuario_usuario_login."' ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        $arrayUsuario = pg_fetch_assoc($result);

        $validausuario = $arrayUsuario['validausuario'];

        if($validausuario == 'EXISTE'){

            $user = true;

            $query  = " SELECT case when count(*) > 0 then usuario_codigo else 0 end AS validapass
                        FROM tb_usuario u 
                        WHERE usuario_usuario_login = '".$usuario_usuario_login."' AND usuario_password = '".$usuario_password."' 
                        GROUP BY usuario_codigo ";

            $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

            $arrayUsuario = pg_fetch_assoc($result);

            $validapass = $arrayUsuario['validapass'];

            if($validapass != 0){
                $pass = true;
            }

        }

        if($pass == true && $user == true){
            return $validapass;
        }else{
            
            if($user){
                print "<script>alert('CONTRASEÑA INCORRECTA')</script>";
                print("<script>window.location.replace('../View/Index.php');</script>");
            }elseif($pass){
                print "<script>alert('USUARIO INCORRECTO')</script>";
                print("<script>window.location.replace('../View/Index.php');</script>");
            }elseif($user==false && $pass==false){
                print "<script>alert('USUARIO NO EXISTE')</script>";
                print("<script>window.location.replace('../View/Index.php');</script>");
            }

        }

    }

    public function validaPerfil($codigo_usuario){

        $query  = " SELECT u.usuario_codigo, p.perfil_descripcion, u.usuario_nombres, u.usuario_apellidos
                    FROM tb_usuario u
                    JOIN tb_perfil p ON p.perfil_codigo = u.perfil_codigo
                    WHERE u.usuario_codigo = ".$codigo_usuario."
                    ORDER BY u.usuario_nombres ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }

	public function getUsuarioCodigo() {
        return $this->usuarioCodigo;
    }

    public function getTipdocCodigo() {
        return $this->tipdocCodigo;
    }

    public function getUsuarioNumeroIdentificacion() {
        return $this->usuarioNumeroIdentificacion;
    }

    public function getUsuarioNombres() {
        return $this->usuarioNombres;
    }

    public function getUsuarioApellidos() {
        return $this->usuarioApellidos;
    }

    public function getUsuarioFechanacimiento() {
        return $this->usuarioFechanacimiento;
    }

    public function getCiudadCodigoNacimiento() {
        return $this->ciudadCodigoNacimiento;
    }

    public function getUsuarioSexo() {
        return $this->usuarioSexo;
    }

    public function getUsuarioTelefono() {
        return $this->usuarioTelefono;
    }

    public function getUsuarioCelular() {
        return $this->usuarioCelular;
    }

    public function getUsuarioEmail() {
        return $this->usuarioEmail;
    }

    public function getEstadoCodigo() {
        return $this->estadoCodigo;
    }

    public function getPerfilCodigo() {
        return $this->perfilCodigo;
    }

    public function getUsuarioUsuarioLogin() {
        return $this->usuarioUsuarioLogin;
    }

    public function getUsuarioPassword() {
        return $this->usuarioPassword;
    }

    public function getTipforCodigo() {
        return $this->tipforCodigo;
    }

    public function getUsuarioEstudiantehabilitado() {
        return $this->usuarioEstudiantehabilitado;
    }

    public function getProacaCodigo() {
        return $this->proacaCodigo;
    }

    public function getUsuarioTitulootorgado() {
        return $this->usuarioTitulootorgado;
    }

    public function getEntestCodigo() {
        return $this->entestCodigo;
    }

    public function getIteentestsedCodigo() {
        return $this->iteentestsedCodigo;
    }

    public function getCiudadCodigo() {
        return $this->ciudadCodigo;
    }

    public function getUsuarioDescripcionperfil() {
        return $this->usuarioDescripcionperfil;
    }

    public function getUsuarioHojadevida() {
        return $this->usuarioHojadevida;
    }

    public function getUsuarioCodigoestudiante() {
        return $this->usuarioCodigoestudiante;
    }

    public function setUsuarioCodigo($usuarioCodigo) {
        $this->usuarioCodigo = $usuarioCodigo;
    }

    public function setTipdocCodigo($tipdocCodigo) {
        $this->tipdocCodigo = $tipdocCodigo;
    }

    public function setUsuarioNumeroIdentificacion($usuarioNumeroIdentificacion) {
        $this->usuarioNumeroIdentificacion = $usuarioNumeroIdentificacion;
    }

    public function setUsuarioNombres($usuarioNombres) {
        $this->usuarioNombres = $usuarioNombres;
    }

    public function setUsuarioApellidos($usuarioApellidos) {
        $this->usuarioApellidos = $usuarioApellidos;
    }

    public function setUsuarioFechanacimiento($usuarioFechanacimiento) {
        $this->usuarioFechanacimiento = $usuarioFechanacimiento;
    }

    public function setCiudadCodigoNacimiento($ciudadCodigoNacimiento) {
        $this->ciudadCodigoNacimiento = $ciudadCodigoNacimiento;
    }

    public function setUsuarioSexo($usuarioSexo) {
        $this->usuarioSexo = $usuarioSexo;
    }

    public function setUsuarioTelefono($usuarioTelefono) {
        $this->usuarioTelefono = $usuarioTelefono;
    }

    public function setUsuarioCelular($usuarioCelular) {
        $this->usuarioCelular = $usuarioCelular;
    }

    public function setUsuarioEmail($usuarioEmail) {
        $this->usuarioEmail = $usuarioEmail;
    }

    public function setEstadoCodigo($estadoCodigo) {
        $this->estadoCodigo = $estadoCodigo;
    }

    public function setPerfilCodigo($perfilCodigo) {
        $this->perfilCodigo = $perfilCodigo;
    }

    public function setUsuarioUsuarioLogin($usuarioUsuarioLogin) {
        $this->usuarioUsuarioLogin = $usuarioUsuarioLogin;
    }

    public function setUsuarioPassword($usuarioPassword) {
        $this->usuarioPassword = $usuarioPassword;
    }

    public function setTipforCodigo($tipforCodigo) {
        $this->tipforCodigo = $tipforCodigo;
    }

    public function setUsuarioEstudiantehabilitado($usuarioEstudiantehabilitado) {
        $this->usuarioEstudiantehabilitado = $usuarioEstudiantehabilitado;
    }

    public function setProacaCodigo($proacaCodigo) {
        $this->proacaCodigo = $proacaCodigo;
    }

    public function setUsuarioTitulootorgado($usuarioTitulootorgado) {
        $this->usuarioTitulootorgado = $usuarioTitulootorgado;
    }

    public function setEntestCodigo($entestCodigo) {
        $this->entestCodigo = $entestCodigo;
    }

    public function setIteentestsedCodigo($iteentestsedCodigo) {
        $this->iteentestsedCodigo = $iteentestsedCodigo;
    }

    public function setCiudadCodigo($ciudadCodigo) {
        $this->ciudadCodigo = $ciudadCodigo;
    }

    public function setUsuarioDescripcionperfil($usuarioDescripcionperfil) {
        $this->usuarioDescripcionperfil = $usuarioDescripcionperfil;
    }

    public function setUsuarioHojadevida($usuarioHojadevida) {
        $this->usuarioHojadevida = $usuarioHojadevida;
    }

    public function setUsuarioCodigoestudiante($usuarioCodigoestudiante) {
        $this->usuarioCodigoestudiante = $usuarioCodigoestudiante;
    }


}


?>