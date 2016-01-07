<?php
// aqui falta validar preguntando si la seccion esta activa ************

if(!empty($_POST["accion"])){    
    if(isset($_POST["cmbPosicion"])) $sPosicion = $_POST["cmbPosicion"]; else $sPosicion="";
    if(isset($_POST["txtnombre"])) $sNombre = $_POST["txtnombre"]; else $sNombre="";
    if(isset($_POST["txtContenido"])) $sContenido = $_POST["txtContenido"]; else $sContenido="";
    if(isset($_POST["txturl"])) $sUrl = $_POST["txturl"]; else $sUrl="";
    if(isset($_POST["id"])) $nIddatos= $_POST["id"]; else $nIddatos="";
    include("DAODatos.php");
    if($sUrl=="http://"){
        $sUrl="#";
    }
    $objDatosEntidad = new EntidadDatos();
    $objDatosEntidad->setIddatos($nIddatos);
    $objDatosEntidad->setPosicion($sPosicion);
    $objDatosEntidad->setNombre($sNombre);
    $objDatosEntidad->setContenido($sContenido);
    $objDatosEntidad->setUrl($sUrl);
    if(DAODatos::mantenimientoDatos($objDatosEntidad,array($_POST["accion"]))){
        echo "1";
    }else{
        echo "0";
    }
}

?>
