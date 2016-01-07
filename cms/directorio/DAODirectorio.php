<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadDirectorio.php");
include("../_util/Mysql.php");

class DAODirectorio {
    
    public static function mantenimientoDirectorio(EntidadDirectorio $objDirectorioEntidad,array $param){
        $query = NULL;
        $query2 = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        $objMysql1 = new Mysql();
        if($param[0]=='DEL'){
            $query2 = "select count(*) as 'cantidad' from cms_directorio where idcontenedor='".$objDirectorioEntidad->getIdDirectorio()."'";
            $res_verificar=$objMysql1->ejecutar($query2);
            $reg=$res_verificar->fetch(PDO::FETCH_ASSOC);
            if($reg['cantidad']!=0){
                $error=2;
            }else{
                $objMysql = new Mysql();
                try {
                    $query = "CALL sp_mnt_directorio('".$param[0]."','".$objDirectorioEntidad->getIdDirectorio()."','".$objDirectorioEntidad->getNombre()."','".$objDirectorioEntidad->getNivel()."','".
                            $objDirectorioEntidad->getPosicion()."','".$objDirectorioEntidad->getContenido()."','".$objDirectorioEntidad->getIdpagina()."','".$objDirectorioEntidad->getRuta()."','".
                            $objDirectorioEntidad->getIdcontenedor()."','".$objDirectorioEntidad->getAbrir()."','".$objDirectorioEntidad->getMostrar()."','".$objDirectorioEntidad->getEliminado()."');";

                    $rs = $objMysql->ejecutar($query);
                    $error=1;
                } catch (PDOException $exc) {
                    $error=0;
                }
            }
        }else{
            try {
                $query = "CALL sp_mnt_directorio('".$param[0]."','".$objDirectorioEntidad->getIdDirectorio()."','".$objDirectorioEntidad->getNombre()."','".$objDirectorioEntidad->getNivel()."','".
                        $objDirectorioEntidad->getPosicion()."','".$objDirectorioEntidad->getContenido()."','".$objDirectorioEntidad->getIdpagina()."','".$objDirectorioEntidad->getRuta()."','".
                        $objDirectorioEntidad->getIdcontenedor()."','".$objDirectorioEntidad->getAbrir()."','".$objDirectorioEntidad->getMostrar()."','".$objDirectorioEntidad->getEliminado()."');";

                $rs = $objMysql->ejecutar($query);
                $error=1;
            } catch (PDOException $exc) {
                $error=0;
            }
        }
        
        return $error;   
    }
    
}

?>
