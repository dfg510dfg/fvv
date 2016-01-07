<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");
$objSesion=new Sesion(); 
$valses=$objSesion->getVariableSession("username");
//echo $valses;
if (!isset($valses)){ 
    echo "<script>window.location='../login/logout.php';</script>";
}
include("../_util/Datos.php");
$objDatos = new Datos();
$vFila=$objDatos->getConsulta(array("f_contactenos",$_GET["id"]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MODIFICAR PAGINA </title>
        
        <script src="../ckeditorFull/ckeditor.js" type="text/javascript"></script>
	<script src="../ckfinder/ckfinder.js" type="text/javascript"></script>        
        
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>
        <!-- fin include para formulario -->
        
        <link rel="stylesheet" type="text/css" href="../stylesheets/styles.css" />
        
        <!-- JS y CSS para HTMLAREA-->
        <script type="text/javascript" src="../js/jHtmlArea-0.7.5.js"></script>
        <link rel="Stylesheet" type="text/css" href="../stylesheets/jHtmlArea.css" />
        
        
        
        <script>
            $(document).ready(function(){
             
            if($("#txhflagfile").val()){
               $("#vpb_upload_button").hide();
            }                          
                <?php
                $archivo=$vFila["direccimag"];
                $vparam=explode(".",$archivo);
                $path="../imgs_banner/";
                ?>
                mostrar_archivo('<?=$archivo?>','<?=$vparam[1]?>','<?=$path?>');        
                //alert('<?=$archivo?>'+'-'+'<?=$vparam[1]?>'+'-'+'<?=$path?>');
                
                $("#test").htmlarea();
                $("textarea").htmlarea();     
                setTextoCheck("chkdestacado"); setFoco('txtnombre');
            });
            function procesar(){
                var bol = $('#demo-form').parsley('validate');
                if(bol){
                  $('#demo-form').submit();  
                }else {
                    return 0;
                }
            }
        </script>
        
    </head>
    <body>
        <form id="demo-form" ata-validate="parsley" method="post" enctype="multipart/form-data" action="enviar.php">
         
        <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg);">
            
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Responder Consulta
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h3 style="padding: 0; margin: 0;">Responder Consulta <?=$vFila["fechaa"]." ".$vFila["horaa"]?>
                <div style="float: right;padding:5px 0.5em 0 0;">
                    <input type="hidden" name="superhidden" id="superhidden">
                    <span class="btn btn" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                </div>
                </h3>
            </div>
            <br/> 
                <input type="hidden" id="accion" name="accion" value="UPD"/>
                <input type="hidden" id="txhId" name="txhId" value="<?=$_GET["id"]?>"/>
                <input type="hidden" id="cmbTipo" name="cmbTipo" value="1"/>
                <table>
                    <tr>
                        <td valign="top"><label for="txtcodigo">Codigo de Consulta * :</label> </td>
                        <td><input type="text" id="txtcodigo" name="txtcodigo" value="<?=sprintf("%07d",$vFila["idcontactenos"])?>" placeholder="Codigo" readonly /> </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="txtnombre">Contacto * :</label> </td>
                        <td><input type="text" id="txtnombre" name="txtnombre" value="<?=$vFila["nombre"]?>" placeholder="Nombre" readonly/> </td>
                    </tr>
                    
                    <tr>
                        <td valign="top"><label for="txtnombre">Telefono * :</label> </td>
                        <td><input type="text" id="txttelefono" name="txttelefono" value="<?=$vFila["telefono"]?>" placeholder="Nombre" readonly/> </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="txtcorreo">Correo * :</label> </td>
                        <td><input type="text" id="txtcorreo" name="txtcorreo" value="<?=$vFila["email"]?>" placeholder="Correo" readonly/> </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="txtcorreo1">Correo * :</label> </td>
                        <td><input type="text" id="txtcorreo1" name="txtcorreo1" value="satelliteroot@gmail.com" placeholder="Correo" data-required="true" /> </td>
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td valign="top"><label for="txtConsulta">Comentario * :</label> </td>
                        <td ><textarea  style="width:450px;height:110px;" type="text" id="txtConsulta" name="txtConsulta" placeholder="Consulta" data-required="true" readonly><?=$vFila["comentario"]?></textarea> </td>
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td valign="top"><label for="txtRespuesta">Repuesta :</label> </td>
                        <td ><textarea  style="width:450px;height:110px;" type="text" id="txtRespuesta" name="txtRespuesta" placeholder="Respuesta" data-required="true" ><?=$vFila["respuesta"]?></textarea> </td>
                    </tr>
                    
					
                </table>
        </form>
        </div>
    </body>
</html>
