<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");$objSesion=new Sesion(); if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){ header("Location: ../login/logout.php");}
include("../_util/Datos.php");
$dirses = new Sesion();
$dirses->setVariableSession("dir", ""); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>INSERTAR CONVOCATORIA </title>
        <!-- include para formulario --> 
        
        <script type="text/javascript" src="../js/jquery_1.5.2.js" ></script>
        <script type="text/javascript" src="../js/ajaxupload.3.5.js" ></script>
        <script type="text/javascript" src="../js/uploader6.js" ></script>
        
        <script src = "../js/jquery.maskedinput.js"  type = "text/javascript" ></script>
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
        <form id="demo-form" ata-validate="parsley" method="post" enctype="multipart/form-data" action="ControladorConvocatoria.php">
                
         <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg);">
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Nuevo Convocatoria
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Insertar nueva convocatoria
                <div style="float: right;padding:5px 0.5em 0 0;">
                    <input type="hidden" name="superhidden" id="superhidden">
                    <span class="btn btn" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                </div>
                </h1>
            </div>
            <br/>    
		
                <input type="hidden" id="accion" name="accion" value="INS"/>
                <table>
                    <tr>
                        <td><label for="txtdescripcion">Descripcion del trabajo * :</label> </td>
                        <td colspan="4"><input type="text" id="txtdescripcion" name="txtdescripcion" placeholder="Descripcion" data-required="true" style="width: 550px;" /> </td>                        
                    </tr>

                    
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td colspan="4"> 
                        <div id="vpb_upload_button">Cargar Archivo</div><br clear="all" /><br clear="all" />
                        <center>
                        <div class="vpb_main_demo_wrapper" align="center"><!-- Main Wrapper -->
                        <div id="vpb_uploads_error_displayer"></div><!-- Error Message Displayer -->
                        <div id="vpb_uploads_displayer"></div><!-- Success Message (Files) Displayer -->
                        <br clear="all" />
                        </div>
                        </center>
                        </td>
                    </tr>
                    <tr><td colspan="2"><label>*No puede subir más de un archivo por Convocatoria</label></td></tr> 
<!--                    <tr>
                        <td><label for="fileFoto">Foto grande [930x360px] * :</label> </td>
                        <td colspan="4">
                            <input type="file" name="fileFoto" id="fileFoto" data-required="true"/>     
                        </td>
                    </tr>-->
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td><label for="txtnombre">Fecha de Inicio * :</label> </td>
                        <td><input id="fecini" name="fecini" type="date" class="cajaMedia" value="">
                        </td>                       
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td><label for="txtnombre">Fecha Final * :</label> </td>
                        <td><input id="fecfin" name="fecfin" type="date" class="cajaMedia" value="">
                        </td>                        
                    </tr>
                    
                    <tr>
                        <td><label for="chkmostrar">Mostrar Convocatoria * :</label> </td>
                        <td><input type="checkbox" name="chkmostrar" id="chkmostrar" value="1" onclick="setTextoCheck(this.name);"/><span id="textoCheck" style="float: left;"></span></td>
                        <td colspan="3"></td>
                    </tr>
                    
                </table>
         <br/><br/>
        </div>
        </form>
    </body>
</html>
