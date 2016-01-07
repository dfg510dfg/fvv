<?php
// aqui falta validar preguntando si la seccion esta activa ************

if(!empty($_POST["accion"])){    
    if(isset($_POST["nom"])) $sNombre = $_POST["nom"]; else $sNombre="";
    if(isset($_POST["id"])) $nId= $_POST["id"]; else $nId="";
    if(isset($_POST["idclase"])) $nIdclase= $_POST["idclase"]; else $nIdclase="";
    include("DAOCategoria.php");
    $objCategoriaEntidad = new EntidadCategoria();
    $objCategoriaEntidad->setNombre($sNombre);
    $objCategoriaEntidad->setIdcategoria($nId);
    $objCategoriaEntidad->setIdclase($nIdclase);
    $objCategoriaEntidad->setEliminado(1);
    if(DAOCategoria::mantenimientoCategoria($objCategoriaEntidad,array($_POST["accion"]))){
        echo "1";
    }else{
        echo "0";
    }
}

?>
