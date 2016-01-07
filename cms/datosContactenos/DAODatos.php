<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadDatos.php");
include("../_util/Mysql.php");
class DAODatos {
    
    public static function mantenimientoDatos(EntidadDatos $objDatosEntidad,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
            $query = "CALL sp_mnt_datos('".$param[0]."','".
                    $objDatosEntidad->getIddatos()."','".
                    $objDatosEntidad->getPosicion()."','".
                    $objDatosEntidad->getNombre()."','".
                    $objDatosEntidad->getContenido()."','".
                    $objDatosEntidad->getUrl()."');";
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}

?>
