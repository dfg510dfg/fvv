<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadConvocatoria.php");
include("../_util/Mysql.php");
class DAOConvocatoria {
    public static function mantenimientoConvocatoria(EntidadConvocatoria $objBannerConvocatoria,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
             $query = "CALL sp_mnt_convocatoria('".$param[0]."',
                                           '".$objBannerConvocatoria->getIdconvocatoria()."',
                                           '".$objBannerConvocatoria->getDescripcion()."',    
                                           '".$objBannerConvocatoria->getFec_ini()."',        
                                           '".$objBannerConvocatoria->getFec_fin()."',
                                           '".$objBannerConvocatoria->getDoc_conv()."',    
                                           '".$objBannerConvocatoria->getDoc_res()."',   
                                           '".$objBannerConvocatoria->getMostrar()."',
                                           '".$objBannerConvocatoria->getResultado()."');";
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}

?>
