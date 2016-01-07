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
    if(isset($_POST["txtnombre"])) $sNombre = $_POST["txtnombre"]; else $sNombre="";
    if(isset($_POST["cmbEnlace"])) $sEnlace = $_POST["cmbEnlace"]; else $sEnlace="";
  
    $dirses = new Sesion();
    $dir= $dirses->getVariableSession("dir");
    
    include("DAOBannerInterno.php");
    $objCategoriaBanner = new EntidadBannerInterior();
    $objCategoriaBanner->setIdbannerinterior($nId);
    $objCategoriaBanner->setUrl($sEnlace);
    $objCategoriaBanner->setDescripcion($sNombre);
    if($dir==""){
        $objMysql=new Mysql();
        $query="select foto from cms_bannerinterior where idbannerinterior=".$nId;
        $rs=$objMysql->ejecutar($query);
        $res=$rs->fetch(PDO::FETCH_ASSOC);
        $dir=$res["foto"];
        $objCategoriaBanner->setFoto($dir);
    }else{
        $objCategoriaBanner->setFoto('imgs_banner_/'.$dir);
    }
    $objCategoriaBanner->setFotochico("");
    $objCategoriaBanner->setEliminado(0);
    $objCategoriaBanner->setFeccrea("");
    $objCategoriaBanner->setFecmodif("");  
    if($_POST["accion"]=='DEL_LOG'){
        if(DAOBannerInterno::mantenimientoBanner($objCategoriaBanner,array($_POST["accion"]))){
            echo "1";
        }else{
            echo "0";
        }       
    }  else {
        if(DAOBannerInterno::mantenimientoBanner($objCategoriaBanner,array($_POST["accion"]))){
            header("Location: MNTbannerInterno.php?idmenu=1;");
        }else{
            header("Location: MNTbannerInterno.php?error=1;");
        }   
    }
}

?>
