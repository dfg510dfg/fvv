<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadCategoria.php");
include("../_util/Mysql.php");
class DAOCategoria {
    
    public static function mantenimientoCategoria(EntidadCategoria $objCategoriaEntidad,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
            $query = "CALL sp_mnt_categoria('".$param[0]."','".$objCategoriaEntidad->getIdcategoria()."','".$objCategoriaEntidad->getNombre()."','00-00-0000','".$objCategoriaEntidad->getEliminado()."','".$objCategoriaEntidad->getIdclase()."');";
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        return $error;   
    }
    
}

?>
