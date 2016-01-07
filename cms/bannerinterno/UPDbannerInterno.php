<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");$objSesion=new Sesion(); if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){ echo "<script>parent.window.location.reload();</script>";}
include("../_util/Datos.php");
$objDatos = new Datos();
$vFila=$objDatos->getConsulta(array("f_bannerinterno",$_GET["id"]));
$dirses = new Sesion();
$dirses->setVariableSession("dir", ""); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ACTUALIZAR BANNER INTERIOR</title>
        <!-- include para formulario --> 
        <script type="text/javascript" src="../js/jquery_1.5.2.js" ></script>
        <script type="text/javascript" src="../js/ajaxupload.3.5.js" ></script>
        <script type="text/javascript" src="../js/uploader4.js" ></script>
        
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <script type="text/javascript" src="../javascripts/_util.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/styles.css" />
        <!-- fin include para formulario -->
        <script>
            $(document).ready(function(){setTextoCheck("chkmostrar"); setFoco('txtnombre');});
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
        <form id="demo-form" ata-validate="parsley" method="post" enctype="multipart/form-data" action="ControladorBannerInterno.php">
                
         <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg);">
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Actualizar Banner Interior
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h3 style="padding: 0; margin: 0;">Actualiza banner <?=$vFila["titulo"]?>
                <div style="float: right;padding:5px 0.5em 0 0;">
                    <input type="hidden" name="superhidden" id="superhidden">
                    <span class="btn btn" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                </div>
                </h3>
            </div>
            <br/>    
		
                <input type="hidden" id="accion" name="accion" value="UPD"/>
                <input type="hidden" id="txhId" name="txhId" value="<?=$_GET["id"]?>"/>
                <table>
                    <tr>
                        <td valign="top"><label for="txtcodigo">Codigo de banner * :</label> </td>
                        <td><input type="text" id="txtcodigo" name="txtcodigo" value="<?=sprintf("%07d",$vFila["idbannerinterior"])?>" placeholder="Codigo" readonly /> </td>
                        <td colspan="3"></td>
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    
                    <tr>
                        <td><label for="txtnombre">Titulo de banner * :</label> </td>
                        <td colspan="4"><input type="text" id="txtnombre" name="txtnombre" value="<?=$vFila["titulo"]?>" placeholder="Nombre" data-required="true" style="width: 550px;" /> </td>                        
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td valign="top"><label for="fileFoto">Imagen Actual * :</label> </td>
                        <td colspan="4"> 
                            <img src="../<?=$vFila["foto"]?>" width="150" border="0" style="float:left;" />
                        </td>
                    </tr>                   
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td colspan="4"> 
                        <div id="vpb_upload_button">Nueva Imagen</div><br clear="all" /><br clear="all" />
                        <center>
                        <div class="vpb_main_demo_wrapper" align="center"><!-- Main Wrapper -->
                        <div id="vpb_uploads_error_displayer"></div><!-- Error Message Displayer -->
                        <div id="vpb_uploads_displayer">      
                        </div><!-- Success Message (Files) Displayer -->
                        <br clear="all" />
                        </div>
                        </center>
                        </td>
                    </tr>
                    <tr><td colspan="2"><label>*No puede subir más de una imagen por Banner</label></td></tr> 
<!--                    <tr>
                        <td><label for="fileFoto">Foto grande [930x360px] * :</label> </td>
                        <td colspan="4">
                            <input type="file" name="fileFoto" id="fileFoto" data-required="true"/>     
                        </td>
                    </tr>-->
                    <tr><td colspan="5" height="15"></td></tr>
                        <tr>
                            <td valign="top"><label>Pagina Asociada : </label> </td>
                            <td>
                                <select id="cmbEnlace" name="cmbEnlace" style="width:165px" data-required="true" class="parsley-validated parsley-error"  title="Seleccionar Enlace">
                                    <option value="0">--Escoja--</option>
                                    <?echo Datos::getCombo("cmbPagina",'',$vFila["idpagina"]);?>
                                </select>
                            </td>
                        </tr>
                    
                </table>
         <br/><br/>
        </div>
        </form>
    </body>
</html>
