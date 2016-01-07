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
    if(isset($_POST["txtnombre"])) $sNombre = $_POST["txtnombre"]; else $sNombre="";
    if(isset($_POST["txhId"])) $nId= $_POST["txhId"]; else $nId="";
    if(isset($_POST["txtdescripcion"])) $sDescripcion = $_POST["txtdescripcion"]; else $sDescripcion="";
    if(isset($_POST["cmbOrden"])) $sOrden = $_POST["cmbOrden"]; else $sOrden="";
    if(isset($_POST["cmbContenido"])) $sContenido = $_POST["cmbContenido"]; else $sContenido="";
    if(isset($_POST["cmbEnlace"])) $sEnlace = $_POST["cmbEnlace"]; else $sEnlace="";
    if(isset($_POST["txtEnlace"])) $sExterno = $_POST["txtEnlace"]; else $sExterno="";
    if(isset($_POST["cmbAbrir"])) $sAbrir = $_POST["cmbAbrir"]; else $sAbrir="";
    if(isset($_POST["chkmostrar"])) $nSwMostrar= $_POST["chkmostrar"]; else $nSwMostrar="";
    if(isset($_POST["idclase"])) $nIdclase= $_POST["idclase"]; else $nIdclase="";
    
    $dirses = new Sesion();
    $dir= $dirses->getVariableSession("dir");
    
    include("DAOBanner.php");
    $objCategoriaBanner = new EntidadBanner();
    
    $objCategoriaBanner->setIdbanner($nId);
    $objCategoriaBanner->setTitulo($sNombre);
    $objCategoriaBanner->setDescripcion($sDescripcion);
    $objCategoriaBanner->setEnlace($sContenido);
    switch($sContenido){
        case 1: $objCategoriaBanner->setUrl("#");break;
        case 2: $objCategoriaBanner->setUrl($sEnlace);break;
        case 3: $objCategoriaBanner->setUrl($sExterno);break;
    }
    $objCategoriaBanner->setOrden($sOrden);
    if($dir==""){
        $objMysql=new Mysql();
        $query="select foto from cms_banner where idbanner=".$nId;
        $rs=$objMysql->ejecutar($query);
        $res=$rs->fetch(PDO::FETCH_ASSOC);
        $dir=$res["foto"];
        $objCategoriaBanner->setFoto($dir);
    }else{
        $objCategoriaBanner->setFoto('imgs_banner/'.$dir);
    }
    $objCategoriaBanner->setFotochico("");
    $objCategoriaBanner->setEliminado(1);
    $objCategoriaBanner->setCargaurl("");
    $objCategoriaBanner->setMostrar($nSwMostrar);
    $objCategoriaBanner->setFeccrea("");
    $objCategoriaBanner->setFecmodif("");
    $objCategoriaBanner->setIdcatempre($nIdclase);
    $objCategoriaBanner->setAbrir($sAbrir);    
    if($_POST["accion"]=='DEL_FIS'){
        if(DAOBanner::mantenimientoBanner($objCategoriaBanner,array($_POST["accion"]))){
            echo "1";
        }else{
            echo "0";
        }       
    }  else {
        if(DAOBanner::mantenimientoBanner($objCategoriaBanner,array($_POST["accion"]))){
            header("Location: MNTbanner.php?idmenu=1;");
        }else{
            header("Location: MNTbanner.php?error=1;");
        }   
    }
}

?>
