<?php
// aqui falta validar preguntando si la seccion esta activa ************
//include("../util/Sesion.php");
include("EntidadPopup.php");
include("../_util/Mysql.php");
class DAOPopup {
    public static function mantenimientoPopup(EntidadPopup $objPopupEntidad,array $param){
        $query = NULL;
        $error = NULL;
        $objcons=new Mysql();
        try {
             $query = "CALL SP_MNT_POPUP('".$param[0]."',
                                           '".$objPopupEntidad->getIdpopup()."',
                                           '".$objPopupEntidad->getNom()."',    
                                           '".$objPopupEntidad->getImg()."',    
                                           '".$objPopupEntidad->getAncho()."',    
                                           '".$objPopupEntidad->getAlto()."',        
                                           '".$objPopupEntidad->getResizable()."',
                                           '".$objPopupEntidad->getPosition()."', 
                                           '".$objPopupEntidad->getEnlace()."',
                                           '".$objPopupEntidad->getUrl()."',
                                           '".$objPopupEntidad->getAbrir()."',    
                                           '".$objPopupEntidad->getSwactivo()."');";
            $rs = $objcons->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}

?>