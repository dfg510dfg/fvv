<?php
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
    if(isset($_POST["txtancho"])) $sAncho = $_POST["txtancho"]; else $sAncho="";
    if(isset($_POST["txtalto"])) $sAlto = $_POST["txtalto"]; else $sAlto="";
    if(isset($_POST["cmbPosicion"])) $nPosicion= $_POST["cmbPosicion"]; else $nPosicion="";
    if(isset($_POST["chkmostrar"])) $nSwMostrar= $_POST["chkmostrar"]; else $nSwMostrar="";
    
    if(isset($_POST["cmbContenido"])) $sContenido = $_POST["cmbContenido"]; else $sContenido="";
    if(isset($_POST["cmbEnlace"])) $sEnlace = $_POST["cmbEnlace"]; else $sEnlace="";
    if(isset($_POST["txtEnlace"])) $sExterno = $_POST["txtEnlace"]; else $sExterno="";
    if(isset($_POST["cmbAbrir"])) $sAbrir = $_POST["cmbAbrir"]; else $sAbrir="";
    //VARIABLES IDUSUARIO, Y FECHA ACTUAL
    $idSesion= new Sesion();
    $idses = $idSesion->getVariableSession("idusua");
    $dirses = new Sesion();
    $dir= $dirses->getVariableSession("dir");
    
    include("DAOPopup.php");
    /********SI NO SE SUBE NINGUNA IMAGEN SE PREGUNTA EN LA BD*************/
    if ($dir==""){
    $objMysql=new Mysql();
    $query="select img from cms_popup where idpopup=".$nId;
    $rs=$objMysql->ejecutar($query);
    $res=$rs->fetch(PDO::FETCH_ASSOC);
    $dir=$res["img"];
    //echo "<script>alert(\"$dir\")</script>";
    }
    /**************************************************************/
    $objPopupEntidad = new EntidadPopup();
    $objPopupEntidad->setIdpopup($nId); 
    $objPopupEntidad->setNom($sNombre);
    $objPopupEntidad->setImg($dir);
    $objPopupEntidad->setAncho($sAncho);
    $objPopupEntidad->setAlto($sAlto);
    $objPopupEntidad->setResizable($nOrden);
    $objPopupEntidad->setPosition($nPosicion);
    $objPopupEntidad->setSwactivo($nSwMostrar);

    $objPopupEntidad->setEnlace($sContenido);
    switch($sContenido){
        case 1: $objPopupEntidad->setUrl("#");break;
        case 2: $objPopupEntidad->setUrl($sEnlace);break;
        case 3: $objPopupEntidad->setUrl($sExterno);break;
    }
    $objPopupEntidad->setAbrir($sAbrir); 
    
    if($_POST["accion"]=='DEL'){
        if(DAOPopup::mantenimientoPopup($objPopupEntidad,array($_POST["accion"]))){
            echo "1";
        }else{
            echo "0";
        }       
    }  else {
        if(DAOPopup::mantenimientoPopup($objPopupEntidad,array($_POST["accion"]))){
            header("Location: MNTpopup.php?idmenu=1;");
        }else{
            header("Location: INSpopup.php?error=1;");
        }   
    }
}
?>