<?php
// aqui falta validar preguntando si la seccion esta activa ************

if(!empty($_POST["accion"])){  
    if(isset($_POST["id"])) $sId = $_POST["id"]; else $sId="";
    if(isset($_POST["nivel"])) $sNivel = $_POST["nivel"]; else $sNivel="";
    if(isset($_POST["pertenece"])) $sPertenece = $_POST["pertenece"]; else $sPertenece="";
    if(isset($_POST["campo"])) $sCampo = $_POST["campo"]; else $sCampo="";
    if(isset($_POST["contenido"])) $sContenido = $_POST["contenido"]; else $sContenido="";
    if(isset($_POST["posicion"])) $sPosicion = $_POST["posicion"]; else $sPosicion="";
    if(isset($_POST["cenlace"])) $sCenlace = $_POST["cenlace"]; else $sCenlace="";
    if(isset($_POST["tenlace"])) $sTenlace = $_POST["tenlace"]; else $sTenlace="";
    if(isset($_POST["abrir"])) $sAbrir = $_POST["abrir"]; else $sAbrir="";
    if(isset($_POST["mostrar"])) $nSwMostrar= $_POST["mostrar"]; else $nSwMostrar="";
    include("DAODirectorio.php");
    $objDirectorioEntidad = new EntidadDirectorio();
    $objDirectorioEntidad->setIdDirectorio($sId);
    $objDirectorioEntidad->setNombre($sCampo);
    $objDirectorioEntidad->setNivel($sNivel);
    $objDirectorioEntidad->setPosicion($sPosicion);
    $objDirectorioEntidad->setContenido($sContenido);
    if($sContenido==1){
        $objDirectorioEntidad->setIdpagina('');
        $objDirectorioEntidad->setRuta('');
    }elseif($sContenido==2){
        $objDirectorioEntidad->setIdpagina($sCenlace);
        $objDirectorioEntidad->setRuta('');
    }elseif ($sContenido==3) {
        $objDirectorioEntidad->setIdpagina('');
        $objDirectorioEntidad->setRuta($sTenlace);
    }
    $objDirectorioEntidad->setAbrir($sAbrir);
    $objDirectorioEntidad->setIdcontenedor($sPertenece);
    $objDirectorioEntidad->setEliminado(0);
    $objDirectorioEntidad->setMostrar($nSwMostrar);
    echo DAODirectorio::mantenimientoDirectorio($objDirectorioEntidad,array($_POST["accion"]));
}

?>