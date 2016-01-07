<?php
// aqui falta validar preguntando si la seccion esta activa ************
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");
$objSesion=new Sesion(); 
$valses=$objSesion->getVariableSession("username");
if (!isset($valses)){ 
    echo "<script>window.location='../login/logout.php';</script>";
}
if(!empty($_POST["accion"])){    
    if(isset($_POST["txhId"])) $nId= $_POST["txhId"]; else $nId="";
    if(isset($_POST["txtdescripcion"])) $sDescripcion = $_POST["txtdescripcion"]; else $sDescripcion="";
    
    if(isset($_POST["fecini"])) $sFecIni = $_POST["fecini"]; else $sFecIni="";
    if(isset($_POST["fecfin"])) $sFecFin = $_POST["fecfin"]; else $sFecFin="";
    if(isset($_POST["chkmostrar"])) $nSwMostrar= $_POST["chkmostrar"]; else $nSwMostrar="";
    $dirses = new Sesion();
    $dir= $dirses->getVariableSession("dir");
    
    include("DAOConvocatoria.php");
    $objCategoriaConvocatoria = new EntidadConvocatoria();
    
    $objCategoriaConvocatoria->setIdconvocatoria($nId);
    $objCategoriaConvocatoria->setDescripcion($sDescripcion);
    $objCategoriaConvocatoria->setFec_ini($sFecIni);
    $objCategoriaConvocatoria->setFec_fin($sFecFin);
    $objCategoriaConvocatoria->setMostrar($nSwMostrar);
    if($dir==""){
        $objMysql=new Mysql();
        $query="select docconv from cms_convocatoria where idconvocatoria=".$nId;
        $rs=$objMysql->ejecutar($query);
        $res=$rs->fetch(PDO::FETCH_ASSOC);
        $dir=$res["docconv"];
        $objCategoriaConvocatoria->setDoc_conv($dir);
    }else{
        $objCategoriaConvocatoria->setDoc_conv('convocatorias/'.$dir);
    }    
    if($_POST["accion"]=='DEL_LOG'){
        if(DAOConvocatoria::mantenimientoConvocatoria($objCategoriaConvocatoria,array($_POST["accion"]))){
            echo "1";
        }else{
            echo "0";
        }       
    }  else {
        if(DAOConvocatoria::mantenimientoConvocatoria($objCategoriaConvocatoria,array($_POST["accion"]))){
            header("Location: MNTConvocatoria.php?idmenu=1;");
        }else{
            header("Location: MNTConvocatoria.php?error=1;");
        }   
    }
}

?>
