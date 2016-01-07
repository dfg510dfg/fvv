<?php
// aqui falta validar preguntando si la seccion esta activa ************

if(!empty($_POST["accion"])){    
    
    if(isset($_POST["txhId"])) $nId= $_POST["txhId"]; else $nId="";
    if(isset($_POST["txtmodelo"])) $sModelo = $_POST["txtmodelo"]; else $sModelo="";
    if(isset($_POST["txtnombre"])) $sNombre = $_POST["txtnombre"]; else $sNombre="";
    if(isset($_POST["cmbCategoria"])) $sCategoria = $_POST["cmbCategoria"]; else $sCategoria="";
    if(isset($_POST["txtvoltaje"])) $sVoltaje = $_POST["txtvoltaje"]; else $sVoltaje="";
    if(isset($_POST["txtpotencia"])) $sPotencia = $_POST["txtpotencia"]; else $sPotencia="";
    if(isset($_POST["txaDescrip"])) $sDescrip = $_POST["txaDescrip"]; else $sDescrip="";
    if(isset($_POST["tmpFoto1"])) $sTmpFoto1= $_POST["tmpFoto1"]; else $sTmpFoto1="0";
    if(isset($_POST["tmpFoto2"])) $sTmpFoto2= $_POST["tmpFoto2"]; else $sTmpFoto2="0";
    if(isset($_POST["tmpFoto3"])) $sTmpFoto3= $_POST["tmpFoto3"]; else $sTmpFoto3="0";
    if(isset($_POST["tmpFoto4"])) $sTmpFoto4= $_POST["tmpFoto4"]; else $sTmpFoto4="0";
    if(isset($_POST["chkdestacado"])) $sSwdestacado= $_POST["chkdestacado"]; else $sSwdestacado="";
    
    include("DAOProducto.php");
    $objProductoEntidad = new EntidadProducto();
    $objProductoEntidad->setIdproducto($nId); 
    $objProductoEntidad->setCodigo($sModelo);
    $objProductoEntidad->setNombre($sNombre);
    $objProductoEntidad->setIdcategoria($sCategoria);
    $objProductoEntidad->setDescripcion($sDescrip);
    $objProductoEntidad->setPotencia($sPotencia);
    $objProductoEntidad->setVoltaje($sVoltaje);
    $objProductoEntidad->setEdades($sEdades);
    $objProductoEntidad->setIdgenero($nIdgenero);
    $objProductoEntidad->setDestacado($sSwdestacado);
    $objProductoEntidad->setEliminado(1);
    $objProductoEntidad->setCaracter($caracteristicas);
    
    if(!empty($_FILES['fileFoto1']['tmp_name'])){
        $uploaded_files_location = '../../fotos/'; //This is the directory where uploaded files are saved on your server
        $final_location = $uploaded_files_location . basename($_FILES['fileFoto1']['name']); 
        move_uploaded_file($_FILES['fileFoto1']['tmp_name'], $final_location);
        $objProductoEntidad->setFoto1("fotos/".$_FILES['fileFoto1']['name']);
    }else{
        $objProductoEntidad->setFoto1($sTmpFoto1);
    }
    if(!empty($_FILES['fileFoto2']['tmp_name'])){
        $uploaded_files_location = '../../fotos/'; //This is the directory where uploaded files are saved on your server
        $final_location = $uploaded_files_location . basename($_FILES['fileFoto2']['name']); 
        move_uploaded_file($_FILES['fileFoto2']['tmp_name'], $final_location);
        $objProductoEntidad->setFoto2("fotos/".$_FILES['fileFoto2']['name']);
    }else{
        $objProductoEntidad->setFoto2($sTmpFoto2);
    }
    if(!empty($_FILES['fileFoto3']['tmp_name'])){
        $uploaded_files_location = '../../fotos/'; //This is the directory where uploaded files are saved on your server
        $final_location = $uploaded_files_location . basename($_FILES['fileFoto3']['name']); 
        move_uploaded_file($_FILES['fileFoto3']['tmp_name'], $final_location);
        $objProductoEntidad->setFoto3("fotos/".$_FILES['fileFoto3']['name']);
    }else{
        $objProductoEntidad->setFoto3($sTmpFoto3);
    }
    if(!empty($_FILES['fileFoto4']['tmp_name'])){
        $uploaded_files_location = '../../fichas/'; //This is the directory where uploaded files are saved on your server
        $final_location = $uploaded_files_location . basename($_FILES['fileFoto4']['name']); 
        move_uploaded_file($_FILES['fileFoto4']['tmp_name'], $final_location);
        $objProductoEntidad->setDocumento("fichas/".$_FILES['fileFoto4']['name']);
    }else{
        $objProductoEntidad->setDocumento($sTmpFoto4);
    }
    
    if($_POST["accion"]=='DEL_LOG'){
        if(DAOProducto::mantenimientoProducto($objProductoEntidad,array($_POST["accion"]))){
            echo "1";
        }else{
            echo "0";
        }       
    }  else {
        if(DAOProducto::mantenimientoProducto($objProductoEntidad,array($_POST["accion"]))){
            header("location: MNTproducto.php");
        }else{
            header("location: INSproducto.php?error=1");
        }   
    }
    
}
?>
