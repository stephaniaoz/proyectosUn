<?php
include_once("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\db\database_utilities.php");


class TbEmpresa{

	private $empresaCodigo; 
    private $tipdocCodigo; 
    private $empresaNumerodocumento; 
    private $empresaNumerocamaracomercio; 
    private $empresaRazonsocial; 
    private $empresaTelefono; 
    private $empresaCelular; 
    private $empresaEmail; 
    private $ciudadCodigo; 
    private $estadoCodigo; 
    private $perfilCodigo; 
    private $empresaUsuarioLogin; 
    private $empresaPassword; 
    private $empresaDescripcionactividad; 
    private $empresaWeb;

    function __construct(){

	}

	/*	Consulta en la base de datos todos los contactos con 
		perfil de 'CONTACTO' (personas que solicitan trabajo) en forma resumida
		y lo devuelve en arreglo asociativo */
	public function resultListaEmpresa(){

		$query  = "	SELECT *
					FROM tb_empresa e 
                    ORDER BY e.empresa_razonsocial";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

		return $result;

	}

    public function resultListaEmpresaId($id){

        $query  = " SELECT e.*, d.pais_codigo, c.departamento_codigo, d.departamento_nombre, c.ciudad_nombre, pe.perfil_descripcion
                    FROM tb_empresa e
                    JOIN tb_ciudad c ON c.ciudad_codigo = e.ciudad_codigo
                    JOIN tb_departamento d ON d.departamento_codigo = c.departamento_codigo
                    JOIN tb_pais p ON p.pais_codigo = p.pais_codigo
                    JOIN tb_perfil pe ON pe.perfil_codigo = e.perfil_codigo
                    WHERE e.empresa_codigo = ".$id." 
                    ORDER BY e.empresa_razonsocial ";

        $result = pg_query($query) or die('La consulta fallo: ' .$query. pg_last_error());

        return $result;

    }

    public function save($objetoEmpresa){

        $objetoEmpresa->setEmpresaCodigo($this->maxEmpresaCodigo());

        $query = "  INSERT INTO tb_empresa(
                            empresa_codigo, 
                            tipdoc_codigo, 
                            empresa_numerodocumento, 
                            empresa_numerocamaracomercio, 
                            empresa_razonsocial, 
                            empresa_telefono, 
                            empresa_celular, 
                            empresa_email, 
                            ciudad_codigo, 
                            estado_codigo, 
                            perfil_codigo, 
                            empresa_usuario_login, 
                            empresa_password, 
                            empresa_descripcionactividad, 
                            empresa_web)
                    VALUES (".$objetoEmpresa->getEmpresaCodigo().",
                            ".$objetoEmpresa->getTipdocCodigo().",
                            '".$objetoEmpresa->getEmpresaNumerodocumento()."',
                            '".$objetoEmpresa->getEmpresaNumerocamaracomercio()."',
                            '".$objetoEmpresa->getEmpresaRazonsocial()."',
                            '".$objetoEmpresa->getEmpresaTelefono()."',
                            '".$objetoEmpresa->getEmpresaCelular()."',
                            '".$objetoEmpresa->getEmpresaEmail()."',
                            ".$objetoEmpresa->getCiudadCodigo().",
                            ".$objetoEmpresa->getEstadoCodigo().",
                            4,
                            '".$objetoEmpresa->getEmpresaUsuarioLogin()."',
                            '".$objetoEmpresa->getEmpresaPassword()."',
                            '".$objetoEmpresa->getEmpresaDescripcionactividad()."',
                            '".$objetoEmpresa->getEmpresaWeb()."'
                            ); ";

        $result = pg_query($query);

        $errorquery = pg_last_error();

        if($errorquery){
            $afectadas = 'La consulta falló. Código: e01';   die();          
        }else{
            $afectadas = 'Se agregó la empresa exitosamente, filas afectadas: '.pg_affected_rows($result);
        }       

        return $afectadas;

    }

    public function update($objetoEmpresa){

        $query = "  UPDATE tb_empresa
                       SET empresa_codigo=".$objetoEmpresa->getEmpresaCodigo().", 
                       tipdoc_codigo=".$objetoEmpresa->getTipdocCodigo().", 
                       empresa_numerodocumento='".$objetoEmpresa->getEmpresaNumerodocumento()."', 
                       empresa_numerocamaracomercio='".$objetoEmpresa->getEmpresaNumerocamaracomercio()."', 
                       empresa_razonsocial='".$objetoEmpresa->getEmpresaRazonsocial()."', 
                       empresa_telefono='".$objetoEmpresa->getEmpresaTelefono()."', 
                       empresa_celular='".$objetoEmpresa->getEmpresaCelular()."', 
                       empresa_email='".$objetoEmpresa->getEmpresaEmail()."', 
                       ciudad_codigo=".$objetoEmpresa->getCiudadCodigo().", 
                       estado_codigo=".$objetoEmpresa->getEstadoCodigo().", 
                       perfil_codigo=4, 
                       empresa_usuario_login='".$objetoEmpresa->getEmpresaUsuarioLogin()."', 
                       empresa_password='".$objetoEmpresa->getEmpresaPassword()."', 
                       empresa_descripcionactividad='".$objetoEmpresa->getEmpresaDescripcionactividad()."', 
                       empresa_web='".$objetoEmpresa->getEmpresaWeb()."'
                    WHERE empresa_codigo = ".$objetoEmpresa->getEmpresaCodigo()."; ";

        $result = pg_query($query);

        $errorquery = pg_last_error();
        echo $query;

        if($errorquery){
            $afectadas = 'La consulta falló. Código: e01';
        }else{
            $afectadas = 'Se actualizó la empresa exitosamente, filas afectadas: '.pg_affected_rows($result);
        }       

        return $afectadas;

    }

    public function delete($empresacodigo){

        $query = " DELETE FROM tb_empresa WHERE empresa_codigo = ".$empresacodigo." ";

        $result = @pg_query($query);

        $errorquery = @pg_last_error();

        if($errorquery){
            $afectadas = 'La consulta falló. Código: e01';             
        }else{
            $afectadas = 'Se eliminó la empresa exitosamente, filas afectadas: '.@pg_affected_rows($result);
        }       

        return $afectadas;

    }

    public function maxEmpresaCodigo(){

        $maximo = 1;

        $query  = " SELECT (max(e.empresa_codigo) + 1) AS maximo
                    FROM tb_empresa e ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        $arrayEmpresa = pg_fetch_assoc($result);
        $maximo = $arrayEmpresa['maximo'];

        return $maximo;
    }

    public function validaLoginEmpresa($empresa_usuario_login, $usuario_password){

        $pass = false;
        $user = false;

        $maximo = 1;

        $query  = " SELECT case when count(*) > 0 then 'EXISTE' else 'NO EXISTE' end AS validaempresa
                    FROM tb_empresa e 
                    WHERE empresa_usuario_login = '".$empresa_usuario_login."' ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        $arrayEmpresa = pg_fetch_assoc($result);

        $validaempresa = $arrayEmpresa['validaempresa'];

        if($validaempresa == 'EXISTE'){

            $user = true;

            $query  = " SELECT case when count(*) > 0 then empresa_codigo else 0 end AS validapass
                        FROM tb_empresa e 
                        WHERE empresa_usuario_login = '".$empresa_usuario_login."' AND empresa_password = '".$usuario_password."' 
                        GROUP BY empresa_codigo ";

            $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

            $arrayEmpresa = pg_fetch_assoc($result);

            $validapass = $arrayEmpresa['validapass'];

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

    public function validaPerfilEmpresa($codigo_empresa){

        $query  = " SELECT e.empresa_codigo, p.perfil_descripcion, e.empresa_razonsocial
                    FROM tb_empresa e
                    JOIN tb_perfil p ON p.perfil_codigo = e.perfil_codigo
                    WHERE e.empresa_codigo = ".$codigo_empresa."
                    ORDER BY e.empresa_razonsocial ";

        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

        return $result;

    }


    public function getEmpresaCodigo() {
        return $this->empresaCodigo;
    }

    public function getTipdocCodigo() {
        return $this->tipdocCodigo;
    }

    public function getEmpresaNumerodocumento() {
        return $this->empresaNumerodocumento;
    }

    public function getEmpresaNumerocamaracomercio() {
        return $this->empresaNumerocamaracomercio;
    }

    public function getEmpresaRazonsocial() {
        return $this->empresaRazonsocial;
    }

    public function getEmpresaTelefono() {
        return $this->empresaTelefono;
    }

    public function getEmpresaCelular() {
        return $this->empresaCelular;
    }

    public function getEmpresaEmail() {
        return $this->empresaEmail;
    }

    public function getCiudadCodigo() {
        return $this->ciudadCodigo;
    }

    public function getEstadoCodigo() {
        return $this->estadoCodigo;
    }

    public function getPerfilCodigo() {
        return $this->perfilCodigo;
    }

    public function getEmpresaUsuarioLogin() {
        return $this->empresaUsuarioLogin;
    }

    public function getEmpresaPassword() {
        return $this->empresaPassword;
    }

    public function getEmpresaDescripcionactividad() {
        return $this->empresaDescripcionactividad;
    }

    public function getEmpresaWeb() {
        return $this->empresaWeb;
    }

    public function setEmpresaCodigo($empresaCodigo) {
        $this->empresaCodigo = $empresaCodigo;
    }

    public function setTipdocCodigo($tipdocCodigo) {
        $this->tipdocCodigo = $tipdocCodigo;
    }

    public function setEmpresaNumerodocumento($empresaNumerodocumento) {
        $this->empresaNumerodocumento = $empresaNumerodocumento;
    }

    public function setEmpresaNumerocamaracomercio($empresaNumerocamaracomercio) {
        $this->empresaNumerocamaracomercio = $empresaNumerocamaracomercio;
    }

    public function setEmpresaRazonsocial($empresaRazonsocial) {
        $this->empresaRazonsocial = $empresaRazonsocial;
    }

    public function setEmpresaTelefono($empresaTelefono) {
        $this->empresaTelefono = $empresaTelefono;
    }

    public function setEmpresaCelular($empresaCelular) {
        $this->empresaCelular = $empresaCelular;
    }

    public function setEmpresaEmail($empresaEmail) {
        $this->empresaEmail = $empresaEmail;
    }

    public function setCiudadCodigo($ciudadCodigo) {
        $this->ciudadCodigo = $ciudadCodigo;
    }

    public function setEstadoCodigo($estadoCodigo) {
        $this->estadoCodigo = $estadoCodigo;
    }

    public function setPerfilCodigo($perfilCodigo) {
        $this->perfilCodigo = $perfilCodigo;
    }

    public function setEmpresaUsuarioLogin($empresaUsuarioLogin) {
        $this->empresaUsuarioLogin = $empresaUsuarioLogin;
    }

    public function setEmpresaPassword($empresaPassword) {
        $this->empresaPassword = $empresaPassword;
    }

    public function setEmpresaDescripcionactividad($empresaDescripcionactividad) {
        $this->empresaDescripcionactividad = $empresaDescripcionactividad;
    }

    public function setEmpresaWeb($empresaWeb) {
        $this->empresaWeb = $empresaWeb;
    }
	
}

?>