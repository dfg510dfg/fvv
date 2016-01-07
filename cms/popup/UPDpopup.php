<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");
$objSesion=new Sesion();
$dirses = new Sesion();
$dirses->setVariableSession("dir", "");  
$valses=$objSesion->getVariableSession("username");
if (!isset($valses)){ 
    echo "<script>window.location='../login/logout.php';</script>";
}
include("../_util/Datos.php");
$objDatos = new Datos();
$vFila=$objDatos->getConsulta(array("f_popup",$_GET["id"]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ACTUALIZAR POPUP </title>
        <!-- include para formulario -->
        <script type="text/javascript" src="../js/jquery_1.5.2.js" ></script>
        <script type="text/javascript" src="../js/ajaxupload.3.5.js" ></script>
        <script type="text/javascript" src="../js/uploader.js" ></script>
        
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <script type="text/javascript" src="../javascripts/util.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>
        
        <link rel="stylesheet" type="text/css" href="../stylesheets/styles.css" />
        <!-- fin include para formulario -->
        <script>
            $(document).ready(function(){
                
            if($("#txhflagfile").val()){
               $("#vpb_upload_button").hide();
            }
                <?php
                $archivo=$vFila["img"];
                $vparam=explode(".",$archivo);
                $path="../imgs_banner/";
                ?>
                mostrar_archivo('<?=$archivo?>','<?=$vparam[1]?>','<?=$path?>');        
                //alert('<?=$archivo?>'+'-'+'<?=$vparam[1]?>'+'-'+'<?=$path?>');
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
       <form id="demo-form" ata-validate="parsley" method="post" enctype="multipart/form-data" action="ControladorPopup.php">
                
         <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg);">
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Actualizar Pop-up
           </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h3 style="padding: 0; margin: 0;">Actualiza Pop-up <?=$vFila["nom"]?>
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
                        <td valign="top"><label for="txtcodigo">Codigo * :</label> </td>
                        <td><input type="text" id="txtcodigo" name="txtcodigo" value="<?=sprintf("%07d",$vFila["idpopup"])?>" placeholder="Codigo" readonly /> </td>
                        <td colspan="3"></td>
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td><label for="txtnombre">Titulo de popup * :</label> </td>
                        <td colspan="4"><input type="text" id="txtnombre" name="txtnombre" value="<?=$vFila["nom"]?>" placeholder="ejemplo" data-required="true" style="width: 550px;" /> </td>                        
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td><label for="txtancho">Ancho :</label> </td>
                        <td colspan="4"><input type="text" id="txtancho" name="txtancho" value="<?=$vFila["ancho"]?>" placeholder="0000" data-required="true" style="width: 550px;" /> </td>                        
                    </tr>
                    <tr>
                        <td><label for="txtalto">Alto :</label> </td>
                        <td colspan="4"><input type="text" id="txtalto" name="txtalto" value="<?=$vFila["alto"]?>" placeholder="0000" data-required="true" style="width: 550px;" /> </td>                        
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td><label for="cmbPosicion">Posicion / Orden * :</label> </td>
                        <td>
                            <select name="cmbPosicion" id="cmbPosicion" title="Seleccionar posicion" data-required="true">
                              <option value="<?=($vFila["position"])?>"><?=($vFila["position"])?></option>
                                    <option value="center">center</option>
                                    <option value="right">right</option>
                                    <option value="left">left</option>
                           </select>
                        </td>
                        <td colspan="3x"></td>
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td><label for="chkmostrar">Mostrar Popup * :</label> </td>
                        <td><input type="checkbox" name="chkmostrar" id="chkmostrar" <?=($vFila["swactivo"])?"checked":""?> value="1" onclick="setTextoCheck(this.name);"/><span id="textoCheck" style="float: left;">Mostrar</span></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="hidden" value="1" id="txhflagfile"/>    
                        <div id="vpb_upload_button">Subir Imagen</div><br clear="all" /><br clear="all" />
                        <center>
                        <div class="vpb_main_demo_wrapper" align="center"><!-- Main Wrapper -->
                        <div id="vpb_uploads_error_displayer"></div><!-- Error Message Displayer -->
                        <div id="vpb_uploads_displayer"></div><!-- Success Message (Files) Displayer -->
                        <br clear="all" />
                        </div>
                        </center>
                        </td>
                    </tr>  
                    <tr><td colspan="2"><label>*No puede subir más de una imagen por Popup</label></td></tr>
                    <tr><td colspan="2"><label>**Si remueve una imagen, tenga en cuenta que debe de reemplazarla por una nueva</label></td></tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                            <td valign="top"><label>Contenido : </label> </td>
                            <td><select name="cmbContenido" id="cmbContenido" style="width:165px;">
                                <option value="1" <?if($vFila["enlace"]==1){echo selected;}?>>SIN ENLACE</option>
                                <option value="2" <?if($vFila["enlace"]==2){echo selected;}?>>ENLACE INTERNO</option>
                                <option value="3" <?if($vFila["enlace"]==3){echo selected;}?>>ENLACE EXTERNO</option>
                            </select></td>
                        </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                        <tr>
                            <td valign="top"><label>Enlace Interno : </label> </td>
                            <td>
                                <select id="cmbEnlace" name="cmbEnlace" style="width:165px" data-required="true" class="parsley-validated parsley-error"  title="Seleccionar Enlace">
                                    <option value="0">--Escoja--</option>
                                    <?if($vFila["enlace"]==2){
                                        echo Datos::getCombo("cmbPagina",'',$vFila["url"]);
                                    }else{
                                        echo Datos::getCombo("cmbPagina",'','');}?>
                                </select>
                            </td>
                        </tr>
                    <tr><td colspan="5" height="15"></td></tr>    
                        <tr>
                            <td valign="top"><label>Enlace Externo : </label> </td>
                            <td>
                                <input type="text" id="txtEnlace" name="txtEnlace" 
                                    <?if($vFila["enlace"]==3){
                                        echo 'value ="'.$vFila["url"].'"';
                                    }else{
                                        echo 'value="http://"';
                                        ?><?}?>
                                    data-required="true" style="width:250px;" />
                            </td>
                        </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                            <td valign="top"><label>Abrir en : </label> </td>
                            <td>
                                <select id="cmbAbrir" name="cmbAbrir" style="width:165px;">
                                    <option value="1" <?if($vFila["abrir"]==1){echo selected;}?>>Misma Pestaña</option>
                                    <option value="2" <?if($vFila["abrir"]==2){echo selected;}?>>Nueva Pestaña</option>
                                    <option value="3" <?if($vFila["abrir"]==3){echo selected;}?>>Nueva Ventana</option>
                                </select>
                            </td>
                        </tr>
                </table>
         <br/><br/>
        </div>
        </form>
    </body>
</html>
