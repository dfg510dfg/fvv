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
    if(isset($_POST["txttag"])) $sTag = $_POST["txttag"]; else $sTag="";
    //if(isset($_POST["cmbOrden"])) $nOrden= $_POST["cmbOrden"]; else $nOrden="";
    //if(isset($_POST["chkmostrar"])) $nSwMostrar= $_POST["chkmostrar"]; else $nSwMostrar="";
    if(isset($_POST["area"])) $sArea= $_POST["area"]; else $sArea="";
    if(isset($_POST["cmbTipo"])) $sTipo= $_POST["cmbTipo"]; else $sTipo="";  
    if(isset($_POST["desc"])) $sDesc= $_POST["desc"]; else $sDesc="";
	if(isset($_POST["cmbClase"])) $nIdclase= $_POST["cmbClase"]; else $nIdclase="";
    //if(isset($_FILES["imag"]['name'])) $sImag= $_FILES["imag"]['name']; else $sImag="";
    
    //VARIABLES IDUSUARIO
    $idSesion= new Sesion();
    $idses = $idSesion->getVariableSession("idusua");
    $dirses = new Sesion();
    $d= $dirses->getVariableSession("direc");
    
    include("DAOPagina.php");
    
    $objPaginaEntidad = new EntidadPagina();
    $objPaginaEntidad->setIdpagweb($nId);
    $objPaginaEntidad->setIdusuario($idses);
    $objPaginaEntidad->setTitulo($sNombre);
    $objPaginaEntidad->setTag($sTag);
    $objPaginaEntidad->setContenido($sArea);
    $objPaginaEntidad->setDirecimag($d);
    $objPaginaEntidad->setTipo($sTipo);
    $objPaginaEntidad->setDesc($sDesc);
	$objPaginaEntidad->setIdclase($nIdclase);
    if ($_POST["accion"]=="UPD"){
		if($sTipo==2){
			/********GUARDA LA IMAGEN EN LA CARPETA IMG********/
			if(!empty($_FILES['imag']['tmp_name'])){
				$uploaded_files_location = '../img/'; //This is the directory where uploaded files are saved on your server
				$final_location = $uploaded_files_location . basename($_FILES['imag']['name']); 
				move_uploaded_file($_FILES['imag']['tmp_name'], $final_location);
				$objPaginaEntidad->setImagen($_FILES['imag']['name']);
			}else{
				$objMysql= new Mysql();
				$query="select imagen from intelog_pagina where idpaginaweb=".$nId;
				$rs=$objMysql->ejecutar($query);
				$vFila=$rs->fetch(PDO::FETCH_ASSOC);
				$objPaginaEntidad->setImagen($vFila['imagen']);
			}
		}	
	} 
		/********************************************/
		if($_POST["accion"]=='DEL_LOG'){
			if(DAOPagina::mantenimientoPagina($objPaginaEntidad,array($_POST["accion"]))){
				echo "1";
			}else{
				echo "0";
			}       
		}  else {
			if(DAOPagina::mantenimientoPagina($objPaginaEntidad,array($_POST["accion"]))){
			echo "<script>location.href='MNTPagina.php?idmenu=3'</script>";
			}else{
			echo "<script>location.href='INSPagina.php?error=1'</script>";
			}   
		}
	
}

?>