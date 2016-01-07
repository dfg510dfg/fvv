<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadClase.php");
include("../_util/Mysql.php");
class DAOClase {
    public static function mantenimientoClase(EntidadClase $objClaseEntidad,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
            $query = "CALL sp_mnt_clase('".$param[0]."','".$objClaseEntidad->getIdclase()."','".$objClaseEntidad->getNombre()."','00-00-0000','".$objClaseEntidad->getEliminado()."');";
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}

?>
