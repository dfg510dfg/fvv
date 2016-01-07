<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadBannerInterior.php");
include("../_util/Mysql.php");
class DAOBannerInterno {
    public static function mantenimientoBanner(EntidadBannerInterior $objBannerEntidad,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
             $query = "CALL sp_mnt_bannerinterno('".$param[0]."',
                                           '".$objBannerEntidad->getIdbannerinterior()."',
                                           '".$objBannerEntidad->getDescripcion()."',
                                           '".$objBannerEntidad->getFoto()."',    
                                           '".$objBannerEntidad->getFotochico()."',        
                                           '".$objBannerEntidad->getEliminado()."',
                                           '".$objBannerEntidad->getUrl()."');";
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}

?>
