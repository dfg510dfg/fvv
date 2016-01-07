<?php
/********************************************************************************
* This script is brought to you by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
*********************************************************************************/
include("../util/Mysql.php");
include("../util/Sesion.php");
$direc=$_POST["file_to_remove"];

//ACTUALIZAMOS LA SESION PARA QUE SE ACTUALICE EL VALOR DEL CAMPO DE DIRECIMAG A VACIO EN LA TABLA BANNER
$dirses = new Sesion();
$dirses->setVariableSession("direc", ""); 
//$objMysql->ejecutar("update ".DB_PREFIJO."_banner set direccimag='' where direccimag=".$direc);

if(isset($_POST["file_to_remove"]) && !empty($_POST["file_to_remove"]))
{   
        $uploaded_files_location = '../imgs_banner/'.strip_tags($_POST["file_to_remove"]);
	chmod($uploaded_files_location,0777);
	unlink($uploaded_files_location);
	
	//Here you can also delete the file from your database if you wish assuming you also saved the file to your database during upload
}
?>