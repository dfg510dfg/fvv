<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])) header("Location: ../login/logout.php");
include("../_util/Datos.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>INSERTAR PRODUCTO </title>
        <!-- include para formulario --> 
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <script type="text/javascript" src="../javascripts/_util.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>
        <!-- fin include para formulario -->
        <script>
            function procesar(){
                var bol = $('#demo-form').parsley('validate');
                if(bol){
                    $('#demo-form').submit();
                   /* 
                    $.ajax({
                        type: 'POST', // nom idcategoria codpro descrip  
                        enctype: 'multipart/form-data',
                        url: 'ControladorProducto.php',
                        data: 'accion=' + $('#accion').val() + 
                              '&nom=' + $('#txtnombre').val() + 
                              '&idcategoria=' + $('#cmbCategoria').val() + 
                              '&codpro=' + $('#txtCodPro').val() + 
                              '&descrip=' + $('#txaDescrip').val() +  
                              '&edades=' + $('#txtEdades').val() +   
                              '&idgenero=' + $('#cmbGenero').val() +
                              '&swdestacado=' + $('#chkdestacado').val() +
                              '&fileFoto=' + $('#fileFoto').val() ,
                        success:function(msj){ 
                           alert(msj);
                            /*if ( msj == 1 ){
                                alert('**************************\n insertado \n**************************');
                                window.location='MNTproducto.php';
                            }
                            else{
                                alert('Error en la respueta');
                            }
                        },
                        error:function(){
                            alert('Error ');
                        }
                    });*/
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
                Nuevo Producto
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Insertar nuevo producto
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
                        <td><label for="txtnombre">Modelo de producto * :</label> </td>
                        <td><input type="text" id="txtmodelo" name="txtmodelo" placeholder="Modelo" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td><label for="txtnombre">Nombre de producto * :</label> </td>
                        <td><input type="text" id="txtnombre" name="txtnombre" placeholder="Nombre" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td><label for="cmbCategoria">Categoria * :</label> </td>
                        <td>    
                            <select name="cmbCategoria" id="cmbCategoria" data-required="true" title="Seleccionar categoria">
                                    <option value="" selected>[--Selected--]</option>
                                    <?=Datos::getCombo("cmbCategoria",'','')?>
                            </select>                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td><label for="txtnombre">Voltaje * :</label> </td>
                        <td><input type="text" id="txtvoltaje" name="txtvoltaje" placeholder="voltaje" /> </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td><label for="txtnombre">Potencia * :</label> </td>
                        <td><input type="text" id="txtpotencia" name="txtpotencia" placeholder="potencia" /> </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td><label for="txaDescrip">Descripcion * :</label> </td>
                        <td><textarea id="txaDescrip" name="txaDescrip" placeholder="Descripción" style="width: 420px"></textarea> </td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    <tr>
                        <td><label for="fileFoto4">Ficha Tecnica * :</label> </td>
                        <td>
                            <input type="file" name="fileFoto4" id="fileFoto4"/>     
                        </td>
                    </tr>
                    <tr><td colspan="4" height="20"></td></tr>
                    <tr>
                        <td><label for="fileFoto1">Imagen 1 * :</label> </td>
                        <td>
                            <input type="file" name="fileFoto1" id="fileFoto1"/>     
                        </td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    <tr>
                        <td><label for="fileFoto2">Imagen 2 * :</label> </td>
                        <td>
                            <input type="file" name="fileFoto2" id="fileFoto2"/>     
                        </td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    <tr>
                        <td><label for="fileFoto3">Imagen 3 * :</label> </td>
                        <td>
                            <input type="file" name="fileFoto3" id="fileFoto3"/>     
                        </td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    <tr>
                        <td><label for="chkdestacado">Mostrar * :</label> </td>
                        <td><input type="checkbox" name="chkdestacado" id="chkdestacado" value="1" onclick="setTextoCheck('chkdestacado');"/><span id="textoCheck" style="float: left;">(NO)</span></td>
                    </tr>
                    <tr><td colspan="4" height="15"></td></tr>
                    
                </table>
         <br/><br/>
        </div>
        </form>
    </body>
</html> 