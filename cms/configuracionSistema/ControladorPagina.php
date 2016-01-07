<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");
include("../_util/Mysql.php");
$objSesion=new Sesion(); 
$valses=$objSesion->getVariableSession("username");
if (!isset($valses)){ 
    echo "<script>window.location='../login/logout.php';</script>";
}
if(!empty($_POST["accion"])){ 
   
    if(isset($_POST["area"])) $sArea= $_POST["area"]; else $sArea="";
    if(isset($_POST["chkmostrar1"])) $nSwMostrar1= $_POST["chkmostrar1"]; else $nSwMostrar1="";
    if(isset($_POST["chkmostrar2"])) $nSwMostrar2= $_POST["chkmostrar2"]; else $nSwMostrar2="";
    if(isset($_POST["chkmostrar3"])) $nSwMostrar3= $_POST["chkmostrar3"]; else $nSwMostrar3="";
    if(isset($_POST["cmbPertenece1"])) $pertenece1= $_POST["cmbPertenece1"]; else $pertenece1="";
    if(isset($_POST["cmbPertenece2"])) $pertenece2= $_POST["cmbPertenece2"]; else $pertenece2="";
    
    
    //VARIABLES IDUSUARIO
    $idSesion= new Sesion();
    $idses = $idSesion->getVariableSession("idusua");
    $dirses = new Sesion();
    $d= $dirses->getVariableSession("direc");

    /********************************************/
    if($_POST["accion"]=='UPD'){
        $query = NULL;
        $error = NULL;
        $objMysql = new Mysql();
        try {
            $query = "UPDATE ".DB_PREFIJO."_sistema set convocatoria='$nSwMostrar2', contactenos='$nSwMostrar1'"
                    . ", directorio='$nSwMostrar3', menu1='$pertenece1', menu2='$pertenece2' "
                    . "where idsistema=1;"; 
            $rs = $objMysql->ejecutar($query);
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
    }
    if($error==1){
            header("Location: UPDSistema.php?idmenu=1;");
        }else{
            header("Location: UPDSistema.php?error=1;");
        }  
}

?>