<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");$objSesion=new Sesion(); if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){ echo "<script>parent.window.location.reload();</script>";}
include("../_util/Datos.php");
$objDatos = new Datos();
$vFila=$objDatos->getConsulta(array("f_producto",$_GET["id"]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MODIFICAR PRODUCTO</title>
        <!-- include para formulario -->
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>
        <!-- fin include para formulario -->
        <script>
            $(document).ready(function(){setTextoCheck("chkdestacado"); setFoco('txtnombre');});
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
         <form id="demo-form" ata-validate="parsley" method="post" enctype="multipart/form-data" action="ControladorProducto.php">
                
         <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg);">
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Actualizar Producto
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h3 style="padding: 0; margin: 0;">Actalizar producto <?=$vFila["nombre"]?>
                <div style="float: right;padding:5px 0.5em 0 0;">
                    <input type="hidden" name="superhidden" id="superhidden">
                    <span class="btn btn" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                </div>
                </h3>
            </div>
            <br/>    
                <input type="hidden" id="accion" name="accion" value="UPD"/>
                <input type="hidden" id="txhId" name="txhId" value="<?=$_GET["id"]?>"/>
                <input type="hidden" id="tmpFoto1" name="tmpFoto1" value="<?=$vFila["foto1"]?>"/>
                <input type="hidden" id="tmpFoto2" name="tmpFoto2" value="<?=$vFila["foto2"]?>"/>
                <input type="hidden" id="tmpFoto3" name="tmpFoto3" value="<?=$vFila["foto3"]?>"/>
                <input type="hidden" id="tmpFoto4" name="tmpFoto4" value="<?=$vFila["documento"]?>"/>
                <table>
                    <tr>
                        <td valign="top"><label for="txtcodigo">Codigo de categoria * :</label> </td>
                        <td><input type="text" id="txtcodigo" name="txtcodigo" value="<?=sprintf("%07d",$vFila["idproducto"])?>" placeholder="Codigo" readonly /> </td>
                    </tr>
                    <tr>
                        <td><label for="txtnombre">Modelo de producto * :</label> </td>
                        <td><input type="text" id="txtmodelo" name="txtmodelo" value="<?=$vFila["codigo"];?>" placeholder="Modelo" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td><label for="txtnombre">Nombre de producto * :</label> </td>
                        <td><input type="text" id="txtnombre" name="txtnombre" value="<?=$vFila["nombre"];?>" placeholder="Nombre" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td><label for="cmbCategoria">Categoria * :</label> </td>
                        <td>    
                            <select name="cmbCategoria" id="cmbCategoria" data-required="true" title="Seleccionar categoria">
                                    <option value="" selected>[--Selected--]</option>
                                    <?=Datos::getCombo("cmbCategoria",'',$vFila["idcategoria"])?>
                            </select>                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td><label for="txtnombre">Voltaje * :</label> </td>
                        <td><input type="text" id="txtvoltaje" name="txtvoltaje" value="<?=$vFila["voltaje"];?>" placeholder="voltaje" /> </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td><label for="txtnombre">Potencia * :</label> </td>
                        <td><input type="text" id="txtpotencia" name="txtpotencia" value="<?=$vFila["potencia"];?>" placeholder="potencia" /> </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td><label for="txaDescrip">Descripcion * :</label> </td>
                        <td><textarea id="txaDescrip" name="txaDescrip" placeholder="Descripción" style="width: 420px"><?=$vFila["descripcion"];?></textarea> </td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    <tr>
                        <td><label for="fileFoto1">Ficha Tecnica * :</label> </td>
                        <td>
                            <input type="file" name="fileFoto4" id="fileFoto4" />     
                            <br/>
                            <?php
                            if($vFila["documento"]!='0'){
                                echo '<img src="../../'.$vFila["documento"].'" width="150" border="0" />';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    <tr>
                        <td><label for="fileFoto1">Imagen 1 * :</label> </td>
                        <td>
                            <input type="file" name="fileFoto1" id="fileFoto" />     
                            <br/>
                            <?php
                            if($vFila["foto1"]!='0'){
                                echo '<img src="../../'.$vFila["foto1"].'" width="150" border="0" />';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    <tr>
                        <td><label for="fileFoto2">Imagen 2 * :</label> </td>
                        <td>
                            <input type="file" name="fileFoto2" id="fileFoto" />     
                            <br/>
                            <?php
                            if($vFila["foto2"]!='0'){
                                echo '<img src="../../'.$vFila["foto2"].'" width="150" border="0" />';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    <tr>
                        <td><label for="fileFoto3">Imagen 3 * :</label> </td>
                        <td>
                            <input type="file" name="fileFoto3" id="fileFoto" />     
                            <br/>
                            <?php
                            if($vFila["foto3"]!='0'){
                                echo '<img src="../../'.$vFila["foto3"].'" width="150" border="0" />';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    <tr>
                        <td><label for="chkdestacado">Mostrar * :</label> </td>
                        <td><input type="checkbox" name="chkdestacado" id="chkdestacado" <?=($vFila["destacado"])?"checked":""?> value="1" onclick="setTextoCheck('chkdestacado');"/><span id="textoCheck" style="float: left;"></span></td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    
                </table>
         <br/><br/>
        </div>
        </form>
    </body>
</html>
