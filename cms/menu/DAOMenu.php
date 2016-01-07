<?php
// aqui falta validar preguntando si la seccion esta activa ************
include("EntidadMenu.php");
include("../_util/Mysql.php");

class DAOMenu {
    
    public static function mantenimientoMenu(EntidadMenu $objMenuEntidad,array $param){
        $query = NULL;
        $query2 = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        $objMysql1 = new Mysql();
        if($param[0]=='DEL'){
            $query2 = "select count(*) as 'cantidad' from cms_menumnt where idcontenedor='".$objMenuEntidad->getIdmenu()."'";
            $res_verificar=$objMysql1->ejecutar($query2);
            $reg=$res_verificar->fetch(PDO::FETCH_ASSOC);
            if($reg['cantidad']!=0){
                $error=2;
            }else{
                $objMysql = new Mysql();
                try {
                    $query = "CALL sp_mnt_menu('".$param[0]."','".$objMenuEntidad->getIdmenu()."','".$objMenuEntidad->getNombre()."','".$objMenuEntidad->getNivel()."','".
                            $objMenuEntidad->getPosicion()."','".$objMenuEntidad->getContenido()."','".$objMenuEntidad->getIdpagina()."','".$objMenuEntidad->getRuta()."','".
                            $objMenuEntidad->getIdcontenedor()."','".$objMenuEntidad->getAbrir()."','".$objMenuEntidad->getMostrar()."','".$objMenuEntidad->getEliminado()."');";

                    $rs = $objMysql->ejecutar($query);
                    $error=1;
                } catch (PDOException $exc) {
                    $error=0;
                }
            }
        }else{
            try {
                $query = "CALL sp_mnt_menu('".$param[0]."','".$objMenuEntidad->getIdmenu()."','".$objMenuEntidad->getNombre()."','".$objMenuEntidad->getNivel()."','".
                        $objMenuEntidad->getPosicion()."','".$objMenuEntidad->getContenido()."','".$objMenuEntidad->getIdpagina()."','".$objMenuEntidad->getRuta()."','".
                        $objMenuEntidad->getIdcontenedor()."','".$objMenuEntidad->getAbrir()."','".$objMenuEntidad->getMostrar()."','".$objMenuEntidad->getEliminado()."');";

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
