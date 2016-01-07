<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadBanner.php");
include("../_util/Mysql.php");
class DAOBanner {
    public static function mantenimientoBanner(EntidadBanner $objBannerEntidad,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
             $query = "CALL sp_mnt_banner('".$param[0]."',
                                           '".$objBannerEntidad->getIdbanner()."',
                                           '".$objBannerEntidad->getTitulo()."',    
                                           '".$objBannerEntidad->getUrl()."',        
                                           '".$objBannerEntidad->getOrden()."',
                                           '".$objBannerEntidad->getFoto()."',    
                                           '".$objBannerEntidad->getFotochico()."',        
                                           '".$objBannerEntidad->getEliminado()."',    
                                           '".$objBannerEntidad->getCargaurl()."',    
                                           '".$objBannerEntidad->getMostrar()."',
                                           '".$objBannerEntidad->getIdcatempre()."',
                                           '".$objBannerEntidad->getDescripcion()."',
                                           '".$objBannerEntidad->getAbrir()."',
                                           '".$objBannerEntidad->getEnlace()."');";
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}

?>
