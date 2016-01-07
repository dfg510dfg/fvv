<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadProyecto.php");
include("../_util/Mysql.php");
class DAOProyecto {
    public static function mantenimientoProyecto(EntidadProyecto $objProyectoEntidad,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
             $query = "CALL sp_mnt_proyecto('".$param[0]."',
                                           '".$objProyectoEntidad->getIdproyecto()."',
                                           '".$objProyectoEntidad->getFoto()."',    
                                           '".$objProyectoEntidad->getDescripcion()."',
                                           '".$objProyectoEntidad->getContenido()."',
                                           '".$objProyectoEntidad->getUrl()."',
                                           '".$objProyectoEntidad->getAbrir()."',
                                           '".$objProyectoEntidad->getMostrar()."');";
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}

?>
