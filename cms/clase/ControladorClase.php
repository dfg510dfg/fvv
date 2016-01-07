<?php
// aqui falta validar preguntando si la seccion esta activa ************

if(!empty($_POST["accion"])){    
    if(isset($_POST["nom"])) $sNombre = $_POST["nom"]; else $sNombre="";
    if(isset($_POST["id"])) $nId= $_POST["id"]; else $nId="";
    include("DAOClase.php");
    $objClaseEntidad = new EntidadClase();
    $objClaseEntidad->setNombre($sNombre);
    $objClaseEntidad->setIdclase($nId);
    $objClaseEntidad->setEliminado(1);
    if(DAOClase::mantenimientoClase($objClaseEntidad,array($_POST["accion"]))){
        echo "1";
    }else{
        echo "0";
    }
}

?>
