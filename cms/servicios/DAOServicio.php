<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadServicio.php");
include("../_util/Mysql.php");
class DAOServicio {
    public static function mantenimientoServicio(EntidadServicio $objServicio,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
             $query = "CALL sp_mnt_servicio('".$param[0]."',
                                           '".$objServicio->getIdservicio()."',
                                           '".$objServicio->getDescripcion()."',
                                           '".$objServicio->getFoto()."',    
                                           '".$objServicio->getFotochico()."',        
                                           '".$objServicio->getEliminado()."',
                                           '".$objServicio->getUrl()."');";
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}

?>
