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
$vFila=$objDatos->getConsulta(array("f_sistema",1));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ACTUALIZAR ENCABEZADO </title>
        
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
        <form id="demo-form" ata-validate="parsley" method="post" enctype="multipart/form-data" action="ControladorPagina.php">
         
        <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg);">
            
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Configuracion del Sistema
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h3 style="padding: 0; margin: 0;">Configuracion del Sistema
                <div style="float: right;padding:5px 0.5em 0 0;">
                    
                    <input type="hidden" name="superhidden" id="superhidden">
                    <span class="btn btn" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                </div>
                </h3>
            </div>
            <br/> 
                <input type="hidden" id="accion" name="accion" value="UPD"/>
                <table>
                    <tr>
                        <td></td>
                        <?if($vFila["contactenos"]==1){$CT='checked="true"';}else{$CT='';}?>
                        <td><label for="chkmostrarContactenos">Mostrar Contactenos </label><input type="checkbox" name="chkmostrar1" id="chkmostrar1" value="1" <?=$CT?> onclick="setTextoCheck(this.name);"/><span id="textoCheck1" style="float: left;"></span></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr style="height:15px;"><td colspan="2"> </td></tr>
                    <tr>
                        <td></td>
                        <?if($vFila["convocatoria"]==1){$CV='checked="true"';}else{$CV='';}?>
                        <td><label for="chkmostrarConvocatoria">Mostrar Convocatorias </label><input type="checkbox" name="chkmostrar2" id="chkmostrar2" value="1" <?=$CV?> onclick="setTextoCheck(this.name);"/><span id="textoCheck2" style="float: left;"></span></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr style="height:15px;"><td colspan="2"> </td></tr>
                    <tr>
                        <td></td>
                        <?if($vFila["directorio"]==1){$CV='checked="true"';}else{$CV='';}?>
                        <td><label for="chkmostrarDirectorio">Mostrar Proyectos </label><input type="checkbox" name="chkmostrar3" id="chkmostrar3" value="1" <?=$CV?> onclick="setTextoCheck(this.name);"/><span id="textoCheck3" style="float: left;"></span></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr style="height:20px;"><td colspan="2"> </td></tr>
                    <tr><td colspan="2"><label>PIE DE PAGINA</label> </td></tr>
                    <tr>
                        <td></td>
                        <td valign="top"><label>Seleccionado 1 : </label> </td>
                        <td>    
                            <select name="cmbPertenece1" id="cmbPertenece1">
                                <option value="0" <?php if($vFila["menu2"]==0){echo ' selected';}?>>[--Selected--]</option>
                                <?=Datos::getCombo("cmbNivel",1,$vFila["menu1"])?>   
                             </select>   
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td valign="top"><label>Seleccionado 2 : </label> </td>
                        <td>    
                            <select name="cmbPertenece2" id="cmbPertenece2">
                                <option value="0" <?php if($vFila["menu2"]==0){echo ' selected';}?>>[--Selected--]</option>
                                <?=Datos::getCombo("cmbNivel",1,$vFila["menu2"])?>
                             </select>   
                        </td>
                    </tr>
                </table>
        </form>
        </div>

        
        
    </body>
</html>
