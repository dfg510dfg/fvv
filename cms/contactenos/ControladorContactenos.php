<?php
include("../_coneccion/conectarDB.php");
$cn = conectarDB();
include("../_config/Globales.php");

if(isset($_POST["txhId"])) $nId= $_POST["txhId"]; else $nId="";
if(isset($_POST["txtnombre"])) $nombre = $_POST["txtnombre"]; else $nombre="";
if(isset($_POST["txtcorreo"])) $correo= $_POST["txtcorreo"]; else $correo="";
if(isset($_POST["txtcorreo1"])) $correo1= $_POST["txtcorreo1"]; else $correo1="";
if(isset($_POST["txtConsulta"])) $comment= $_POST["txtConsulta"]; else $comment="";
if(isset($_POST["txtRespuesta"])) $resp= $_POST["txtRespuesta"]; else $resp="";


if($_POST["accion"]=="DEL_LOG"){  
    $query = "";
    $error = NULL;
        try {
            $query = "DELETE FROM ".DB_PREFIJO."_contactenos
                        WHERE idcontactenos='$nId';";
            $rs = $cn->prepare($query);
            $rs->execute();
            $error=1;
        } catch (PDOException $exc) {
            $error=0;
        }
        echo $error; 
} 
?>