<?php
include("EntidadPagina.php");
include("../_util/Mysql.php");
class DAOPagina {
    
    public static function mantenimientoPagina(EntidadPagina $objPaginaEntidad,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
            $query = "CALL sp_mnt_pagina('".$param[0]."',"
                                            ."'".$objPaginaEntidad->getIdpagweb()."',"
                                            ."'".$objPaginaEntidad->getIdusuario()."',"
                                            ."'".$objPaginaEntidad->getTitulo()."',"
                                            ."'".$objPaginaEntidad->getTipo()."',"
                                            ."'".$objPaginaEntidad->getTag()."',"
                                            ."'".$objPaginaEntidad->getDirecimag()."',"
                                            ."'".$objPaginaEntidad->getContenido()."',"
                                            ."'".$objPaginaEntidad->getImagen()."',"
                                            ."'".$objPaginaEntidad->getDesc()."',"
                                            ."'".$objPaginaEntidad->getIdclase()."',"
                                            ."'".$objPaginaEntidad->getScript()."');"; 
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}
?>