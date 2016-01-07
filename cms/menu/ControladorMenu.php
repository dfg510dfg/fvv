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
    if(isset($_POST["cClase"])) $sClase = $_POST["cClase"]; else $sClase="";
    if(isset($_POST["cCategoria"])) $sCategoria = $_POST["cCategoria"]; else $sCategoria="";
    if(isset($_POST["cProducto"])) $sProducto = $_POST["cProducto"]; else $sProducto="";
    if(isset($_POST["abrir"])) $sAbrir = $_POST["abrir"]; else $sAbrir="";
    if(isset($_POST["mostrar"])) $nSwMostrar= $_POST["mostrar"]; else $nSwMostrar="";
    
    include("DAOMenu.php");
    $objMenuEntidad = new EntidadMenu();
    $objMenuEntidad->setIdmenu($sId);
    $objMenuEntidad->setNombre($sCampo);
    $objMenuEntidad->setNivel($sNivel);
    $objMenuEntidad->setPosicion($sPosicion);
    $objMenuEntidad->setContenido($sContenido);
    if($sContenido==1){
        $objMenuEntidad->setIdpagina('');
        $objMenuEntidad->setRuta('');
    }elseif($sContenido==2){
        $objMenuEntidad->setIdpagina($sCenlace);
        $objMenuEntidad->setRuta('');
    }elseif ($sContenido==3) {
        $objMenuEntidad->setIdpagina('');
        $objMenuEntidad->setRuta($sTenlace);
    }elseif($sContenido==4){
        $objMenuEntidad->setIdpagina($sClase);
        $objMenuEntidad->setRuta('');
    }elseif($sContenido==5){
        $objMenuEntidad->setIdpagina($sCategoria);
        $objMenuEntidad->setRuta('');
    }elseif($sContenido==6){
        $objMenuEntidad->setIdpagina($sProducto);
        $objMenuEntidad->setRuta('');
    }
    
    $objMenuEntidad->setAbrir($sAbrir);
    $objMenuEntidad->setIdcontenedor($sPertenece);
    $objMenuEntidad->setEliminado(0);
    $objMenuEntidad->setMostrar($nSwMostrar);
    echo DAOMenu::mantenimientoMenu($objMenuEntidad,array($_POST["accion"]));
}

?>