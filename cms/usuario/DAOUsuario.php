<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadUsuario.php");
include("../_util/Mysql.php");
class DAOUsuario {
    
    public static function mantenimientoUsuario(EntidadUsuario $objUsuarioEntidad,array $param){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
            $query = "CALL sp_mnt_usuario('".$param[0]."','".$objUsuarioEntidad->getIdusuario()."','".$objUsuarioEntidad->getUsuario()."','".$objUsuarioEntidad->getClave()."','".$objUsuarioEntidad->getCorreo()."','".$objUsuarioEntidad->getEliminado()."','".$objUsuarioEntidad->getIdperfil()."');";
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=$exc->__toString();
        }
        return $error;   
    }
    
}

?>
