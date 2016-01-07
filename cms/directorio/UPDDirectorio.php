<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");$objSesion=new Sesion(); if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){ echo "<script>parent.window.location.reload();</script>";}
include("../_util/Datos.php");
$objDatos = new Datos();
$vFila=$objDatos->getConsulta(array("f_directorio",$_GET["id"]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MODIFICAR DIRECTORIO</title>
        <!-- include para formulario -->
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>
        
        <script type="text/javascript" src="../javascripts/_util.js"></script>
        <!-- fin include para formulario -->
        <script src="../_select/select.js"></script>

        <script>
            $(document).ready(function(){setTextoCheck("chkmostrar"); setFoco('txtnombre');});
            function procesar1(){
                var bol = $('#demo-form').parsley('validate');
                if(bol){
                    $('#demo-form').submit();
                }else {
                    return 0;
                }
            }
        </script>
        <script>       
            function procesar(){
                if($('#cmbContenido').val()!=3){
                    document.getElementById("txtEnlace").value="http://";
                }
                var bol = $('#demo-form').parsley('validate');
                if(bol){
                    var mostrar=($("#chkmostrar").is(':checked'))?"1":"0";
                    $.ajax({
                        type: 'POST',
                        url: 'ControladorDirectorio.php',
                        data: 'id=' + $('#txhCodigo').val() + '&accion=' + $('#accion').val() + '&nivel=' + $('#cmbNivel').val() +'&pertenece=' + $('#cmbPertenece').val()
                                +'&posicion=' + $('#cmbPosicion').val()+'&campo=' + $('#txtCampo').val() +'&contenido=' + $('#cmbContenido').val() +'&cenlace=' + $('#cmbEnlace').val()
                                +'&tenlace='+ $('#txtEnlace').val()+'&mostrar='+ mostrar +'&abrir=' + $('#cmbAbrir').val(),
                        success:function(msj){
                            if ( msj == 1 ){
                                alert('El registro fue actualizado satisfactoriamente');
                                window.location='MNTDirectorio.php'; 
                            }
                            else{
                                alert(' Error en la respueta');
                            }
                        },
                        error:function(){
                            alert('Error ');
                        }
                    });
                }else {
                    return 0;
                }
            }
        </script>
    </head>
    
    <body>
         <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg);">
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Actualizar Directorio
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Actualizar Directorio <?=$vFila["campo"]?>
                <div style="float: right;padding:5px 0.5em 0 0;">
                    <input type="hidden" name="superhidden" id="superhidden">
                    <span class="btn btn" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                </div>
                </h1>
            </div>
            <br/>    
		
                <form id="demo-form" ata-validate="parsley">
                <input type="hidden" id="accion" name="accion" value="UPD"/>
                <input type="hidden" id="contenedor" name="contenedor" value="<?=$vFila["idcontenedor"]?>"/>
                <input type="hidden" id="txhCodigo" name="txhCodigo" value="<?=$_GET["id"]?>"/>
                <table>
                    <tr>
                        <td valign="top"><label for="txtcodigo">Codigo de categoria * :</label> </td>
                        <td><input type="text" id="txtcodigo" name="txtcodigo" value="<?=sprintf("%07d",$vFila["iddirectorio"])?>" placeholder="Codigo" readonly /> </td>
                    </tr>
                    <tr>
                            <td valign="top"><label> Nivel :</label> </td>
                            <td>    
                                <select name="cmbNivel" id="cmbNivel" disabled>
                                    <option value="1" <?php if($vFila["nivel"]==1){echo 'selected';}?>>TITULO</option>
                                    <option value="2" <?php if($vFila["nivel"]==2){echo 'selected';}?>>SUBTITULO</option>    
                                 </select>                            
                            </td>
                        </tr>
                        <?php if($vFila["nivel"]==2){?>
                        <tr>
                            <td valign="top"><label>Pertenece a :</label> </td>
                            <td>    
                                <select name="cmbPertenece" id="cmbPertenece" onchange="cantidades();">
                                    <?=Datos::getCombo("cmbDirectorio",1,$vFila["idcontenedor"])?>
                                 </select>   
                                <label id="cmbn1"></label>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td valign="top"><label>Posicion :</label> </td>
                            <td>    
                                <select name="cmbPosicion" id="cmbPosicion">
                                        <?=Datos::getCombo("cmbDirectorioPosicion",$vFila["idcontenedor"],$vFila["posicion"])?>
                                 </select>   
                                <label id="cmbn"></label>
                            </td>
                        </tr>
                    
                        <tr>
                            <td valign="middle"><label>Ingrese Campo : </label></td>
                            <td><input type="text" id="txtCampo" name="txtCampo" value="<?=$vFila["campo"]?>" placeholder="Titulo Directorio" data-required="true" style="width:200px;" /></td>
                        </tr>
                            
                        <tr>
                            <td valign="top"><label>Contenido : </label> </td>
                            <td><select name="cmbContenido" id="cmbContenido" style="width:165px;">
                                <option value="1" <?if($vFila["contenido"]==1){?>selected<?}?> >SIN ENLACE</option>
                                <option value="2" <?if($vFila["contenido"]==2){?>selected<?}?> >ENLACE INTERNO</option>
                                <option value="3" <?if($vFila["contenido"]==3){?>selected<?}?> >ENLACE EXTERNO</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td valign="top"><label>Enlace Interno : </label> </td>
                            <td>
                                <select id="cmbEnlace" name="cmbEnlace" style="width:165px" data-required="true" class="parsley-validated parsley-error"  title="Seleccionar Enlace">
                                    <option value="0">--Escoja--</option>
                                    <?if($vFila["contenido"]==2){?>
                                        <?=Datos::getCombo("cmbPagina",'',$vFila["idpaginaweb"])?>
                                    <?}else{?>
                                        <?=Datos::getCombo("cmbPagina",'','')?>
                                    <?}?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td valign="top"><label>Enlace Externo : </label> </td>
                            <td>
                                <input type="text" id="txtEnlace" name="txtEnlace"  
                                    <?if($vFila["contenido"]==3){?>
                                        value ="<?=$vFila["ruta"]?>"
                                    <?}else{?>
                                        value ="http://"
                                    <?}?> data-required="true" style="width:150px;" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td valign="top"><label>Abrir en : </label> </td>
                            <td>
                                <select id="cmbAbrir" name="cmbAbrir" style="width:165px;">
                                    <option value="1" <?if($vFila["abrir"]==1){?>selected<?}?> >Misma Pestaña</option>
                                    <option value="2" <?if($vFila["abrir"]==2){?>selected<?}?> >Nueva Pestaña</option>
                                    <option value="3" <?if($vFila["abrir"]==4){?>selected<?}?> >pop-up</option>
                                </select>
                            </td>
                        </tr>
                    <tr>
                        <td><label for="chkmostrar">Mostrar Opcion * :</label> </td>
                        <td><input type="checkbox" name="chkmostrar" id="chkmostrar" <?=($vFila["mostrar"])?"checked":""?> value="1" onclick="setTextoCheck(this.name);"/><span id="textoCheck" style="float: left;"></span></td>
                        <td colspan="3"></td>
                    </tr>
                </table>
                
            
        </form>
        </div>

        
        
    </body>
</html>
