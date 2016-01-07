<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])) header("Location: ../login/logout.php");
if(!empty($_POST["accion"])){    
    if(isset($_POST["id"])) $nId = $_POST["id"]; else $nId="";
    if(isset($_POST["txtnombre"])) $sNombre = $_POST["txtnombre"]; else $sNombre="";
    if(isset($_POST["txtcorreo"])) $sCorreo= $_POST["txtcorreo"]; else $sCorreo="";
    if(isset($_POST["txtclave"])) $sClave= $_POST["txtclave"]; else $sClave="";
    if(isset($_POST["cmbPerfil"])) $nIdperdil= $_POST["cmbPerfil"]; else $nIdperdil="";
    include("DAOUsuario.php");
    $objUsuarioEntidad = new EntidadUsuario();
    $objUsuarioEntidad->setUsuario($sNombre);
    $objUsuarioEntidad->setIdusuario($nId);
    $objUsuarioEntidad->setCorreo($sCorreo);
    $objUsuarioEntidad->setClave($sClave);
    $objUsuarioEntidad->setIdperfil($nIdperdil);
    $objUsuarioEntidad->setEliminado(1);
    print (DAOUsuario::mantenimientoUsuario($objUsuarioEntidad,array($_POST["accion"])));
}

?>
