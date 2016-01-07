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
    if(isset($_POST["cmbContenido"])) $sContenido = $_POST["cmbContenido"]; else $sContenido="";
    if(isset($_POST["cmbEnlace"])) $sEnlace = $_POST["cmbEnlace"]; else $sEnlace="";
    if(isset($_POST["txtEnlace"])) $sExterno = $_POST["txtEnlace"]; else $sExterno="";
    if(isset($_POST["cmbAbrir"])) $sAbrir = $_POST["cmbAbrir"]; else $sAbrir="";
    if(isset($_POST["chkmostrar"])) $nSwMostrar= $_POST["chkmostrar"]; else $nSwMostrar="";
    
    $dirses = new Sesion();
    $dir= $dirses->getVariableSession("dir");
    
    include("DAOProyecto.php");
    $objProyectoEntidad = new EntidadProyecto();
    
    $objProyectoEntidad->setIdproyecto($nId);
    $objProyectoEntidad->setDescripcion($sDescripcion);
    $objProyectoEntidad->setContenido($sContenido);
    switch($sContenido){
        case 1: $objProyectoEntidad->setUrl("#");break;
        case 2: $objProyectoEntidad->setUrl($sEnlace);break;
        case 3: $objProyectoEntidad->setUrl($sExterno);break;
    }
    if($dir==""){
        $objMysql=new Mysql();
        $query="select foto from cms_proyecto where idproyecto=".$nId;
        $rs=$objMysql->ejecutar($query);
        $res=$rs->fetch(PDO::FETCH_ASSOC);
        $dir=$res["foto"];
        $objProyectoEntidad->setFoto($dir);
    }else{
        $objProyectoEntidad->setFoto('imgs_proyecto/'.$dir);
    }
    $objProyectoEntidad->setMostrar($nSwMostrar);
    $objProyectoEntidad->setAbrir($sAbrir);    
    if($_POST["accion"]=='DEL_FIS'){
        if(DAOProyecto::mantenimientoProyecto($objProyectoEntidad,array($_POST["accion"]))){
            echo "1";
        }else{
            echo "0";
        }       
    }  else {
        if(DAOProyecto::mantenimientoProyecto($objProyectoEntidad,array($_POST["accion"]))){
            header("Location: MNTProyecto.php?idmenu=1;");
        }else{
            header("Location: MNTProyecto.php?error=1;");
        }   
    }
}

?>
