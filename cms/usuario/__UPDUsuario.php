<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
//session_start();
//if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])) header("Location: ../login/logout.php");
include("../_util/Datos.php");
$objDatos = new Datos();
$vFila=$objDatos->getConsulta(array("f_categoria",$_GET["id"]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MODIFICAR CATEGORIA </title>
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
                        data: 'accion=' + $('#accion').val() + '&nom=' + $('#txtnombre').val() + '&id=' + $('#txhCodigo').val() + '&idclase=' + $('#cmbClase').val(),
                        success:function(msj){
                            if ( msj == 1 ){
                                alert('El registro fue actualizado satisfactoriamente');
                                window.location='MNTCategoria.php';
                            }
                            else{
                                alert('Error');
                            }
                        },
                        error:function(){
                            alert('errro');
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
                Actualizar Categoria
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Actualizar Categoria <?=$vFila["nombre"]?></h1>
            </div>
            <br/>    
		
                <form id="demo-form" ata-validate="parsley">
                <input type="hidden" id="accion" name="accion" value="UPD"/>
                <input type="hidden" id="txhCodigo" name="txhCodigo" value="<?=$_GET["id"]?>"/>
                <table>
                    <tr>
                        <td valign="top"><label for="txtcodigo">Codigo de categoria * :</label> </td>
                        <td><input type="text" id="txtcodigo" name="txtcodigo" value="<?=sprintf("%07d",$vFila["idcategoria"])?>" placeholder="Codigo" readonly /> </td>
                    </tr>
                    <tr style="height:10px;"><td colspan="2"> </td></tr>
                    <tr>
                        <td valign="top"><label for="cmbClase">Clase * :</label> </td>
                        <td>    
                            <select name="cmbClase" id="cmbClase" data-required="true" title="Seleccionar Clase">
                                    <option value="0" selected>[--Selected--]</option>
                                    <?=Datos::getCombo("cmbClase",'',$vFila["idclase"])?>
                                </select>                            
                        </td>
                    </tr>
                    <tr style="height:10px;"><td colspan="2"> </td></tr>
                    <tr>
                        <td valign="top"><label for="txtnombre">Nombre de clase * :</label> </td>
                        <td><input type="text" id="txtnombre" name="txtnombre" value="<?=$vFila["nombre"]?>" placeholder="Nombre" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="superhidden" id="superhidden">
                            <br/><span class="btn btn" id="demo-form-valid" onclick="procesar('');"><i class="icon-ok"></i></span>
                        </td>
                    </tr>
                    
                </table>
                
            
        </form>
        </div>

        
        
    </body>
</html>
