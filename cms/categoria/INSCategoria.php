<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");$objSesion=new Sesion(); if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){ echo "<script>parent.window.location.reload();</script>";}
include("../_util/Datos.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>INSERTAR CATEGORÍA </title>
        <!-- include para formulario -->
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>
        <!-- fin include para formulario -->
        <script>
            function procesar(){
                var bol = $('#demo-form').parsley('validate');
                if(bol){
                    $.ajax({
                        type: 'POST',
                        url: 'ControladorCategoria.php',
                        data: 'accion=' + $('#accion').val() + '&nom=' + $('#txtnombre').val() + '&idclase=' + $('#cmbClase').val(),
                        success:function(msj){
                            if ( msj == 1 ){
                                alert('Categoria insertada');
                                $('#txtnombre').val(""); 
                                window.location='MNTCategoria.php';
                            }
                            else{
                                alert('Error en la respueta');
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
                Nuevo Categoria
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Insertar nueva categoria
                    <div style="float: right;padding:5px 0.5em 0 0;">
                        <input type="hidden" name="superhidden" id="superhidden">
                        <span class="btn btn" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                    </div>
                </h1>
            </div>
            <br/>    
		
                <form id="demo-form" data-validate="parsley">
                <input type="hidden" id="accion" name="accion" value="INS"/>
                <table>
                    <tr>
                        <td valign="top"><label for="cmbClase">Familia * :</label> </td>
                        <td>    
                            <select name="cmbClase" id="cmbClase" data-required="true" class="parsley-validated parsley-error"  title="Seleccionar Clase">
                                    <option value>[--Selected--]</option>
                                    <?=Datos::getCombo("cmbClase",'','')?>
                                </select>                            
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="txtnombre">Nombre de categoria * :</label> </td>
                        <td><input type="text" id="txtnombre" name="txtnombre" placeholder="Categoria" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>

                            
                </table>
                
            
        </form>
        </div>

        
        
    </body>
</html>
