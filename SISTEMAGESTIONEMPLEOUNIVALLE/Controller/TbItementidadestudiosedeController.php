<?php

include("C:\wamp64\www\SISTEMAGESTIONEMPLEOUNIVALLE\Model\TbItementidadestudiosede.php");

$id_entidad = isset($_REQUEST['id_entidad'])?$_REQUEST['id_entidad']:0;

$tbItemEntiEst = new TbItementidadestudiosedeController();
$tbItemEntiEst->getListaVarItementidadEstdioPorEntidad($id_entidad);

class TbItementidadestudiosedeController{

    private $arrayItemEntidadestudio = array();

	function __construct(){

	}

    public function getListaItementidadEstdio($id_entidad){

        $tbItemEntidadestudio = new TbItementidadestudiosede();

        $result = $tbItemEntidadestudio->resultItementidadestudioPorEntidad($id_entidad);
        
        $count = 0;

        while ($arrayItemEntEst = pg_fetch_assoc($result)) {
            $this->arrayItemEntidadestudio[$count]['iteentestsed_codigo'] = $arrayItemEntEst['iteentestsed_codigo'];
            $this->arrayItemEntidadestudio[$count]['iteentestsed_nombre'] = $arrayItemEntEst['iteentestsed_nombre'];
            $count++;
        }       

        return $this->arrayItemEntidadestudio;  

    }

    public function getListaVarItementidadEstdioPorEntidad($id_entidad){
        
        if($id_entidad != 0){

            $tbItemEntEst = new TbItementidadestudiosede();

            $result = $tbItemEntEst->resultItementidadestudioPorEntidad($id_entidad);

            echo "<option value='0'>SELECCIONE UNO</option>";
            while ($arrayItemEntEst = pg_fetch_assoc($result)) {
                echo"<option value='".$arrayItemEntEst['iteentestsed_codigo']."'>".$arrayItemEntEst['iteentestsed_nombre']."</option> \n";
            }

        }

    }

}