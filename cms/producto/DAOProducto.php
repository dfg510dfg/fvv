<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadProducto.php");
include("../_util/Mysql.php");
class DAOProducto {
    
    public static function mantenimientoProducto(EntidadProducto $objProductoEntidad,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
             $query = "CALL sp_mnt_productos('".$param[0]."',
                                           '".$objProductoEntidad->getIdproducto()."',
                                           '".$objProductoEntidad->getCodigo()."',    
                                           '".$objProductoEntidad->getNombre()."',        
                                           '".$objProductoEntidad->getIdcategoria()."',
                                           '".$objProductoEntidad->getFoto1()."',    
                                           '".$objProductoEntidad->getFoto2()."',  
                                           '".$objProductoEntidad->getFoto3()."', 
                                           '".$objProductoEntidad->getDocumento()."',  
                                           '00-00-0000',
                                           '".$objProductoEntidad->getEliminado()."',    
                                           '".$objProductoEntidad->getDestacado()."',    
                                           '".$objProductoEntidad->getDescripcion()."',
                                           '".$objProductoEntidad->getEdades()."',    
                                           '".$objProductoEntidad->getIdgenero()."', 
                                           '".$objProductoEntidad->getPotencia()."', 
                                           '".$objProductoEntidad->getVoltaje()."', 
                                           '".$objProductoEntidad->getCaracter()."');";
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}

?>
