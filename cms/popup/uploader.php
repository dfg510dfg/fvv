<?php
/********************************************************************************
* This script is brought to you by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
*********************************************************************************/
include("../_util/Sesion.php");
$dirses = new Sesion();
$uploaded_files_location = '../imgs_banner/'; //This is the directory where uploaded files are saved on your server
$final_location = $uploaded_files_location . basename($_FILES['file_to_upload']['name']); 

/******************************************************
1.  recuperar el id del banner
2. hacer un selec a la tabla y traer el nombre del banner = ../imgs_banner/foto1.jpg 
3. @unlink($uploaded_files_location);
4. update a la tabla banner  = foto2222.jpg  
******************************************************/

if (move_uploaded_file($_FILES['file_to_upload']['tmp_name'], $final_location)) 
{       
	//Here you can save the uploaded file to your database if you wish before the success message below
	echo "file_uploaded_successfully";
        $dirses->setVariableSession("dir", basename($_FILES['file_to_upload']['name'])); 
}

else 
{
	echo "file_upload_was_unsuccessful";
}
?>