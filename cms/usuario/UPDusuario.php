<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])) header("Location: ../login/logout.php");
include("../_util/Datos.php");
$objDatos = new Datos();
$vFila=$objDatos->getConsulta(array("f_usuario",$_GET["id"]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ACTUALIZAR USUARIO </title>
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
                        url: 'ControladorUsuario.php',
                        data: 'accion=' + $('#accion').val() + '&txtnombre=' + $('#txtnombre').val() + '&txtcorreo=' + $('#txtcorreo').val() + '&txtclave=' + $('#txtclave').val() + '&cmbPerfil=' + $('#cmbPerfil').val() + '&id=' + $('#txhCodigo').val(),
                        success:function(msj){
                            if ( msj == 1 ){
                                alert('****************************************\n REGISTRO ACTUALIZADO SATISFACTORIAMENTE \n :) \n****************************************');
                                window.location='MNTusuario.php';
                            }
                            else{
                                alert('Error en la respueta \n' +  msj);
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
        <form id="demo-form" ata-validate="parsley">
         <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg);">
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Actualizar Usuario
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h3 style="padding: 0; margin: 0;">Actualizar usuario <?=$vFila["usuario"]?>
                <div style="float: right;padding:5px 0.5em 0 0;">
                    <input type="hidden" name="superhidden" id="superhidden">
                    <span class="btn btn" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                </div>
                    </h3>
            </div>
            <br/>    
                <input type="hidden" id="accion" name="accion" value="UPD"/>
                <input type="hidden" id="txhCodigo" name="txhCodigo" value="<?=$_GET["id"]?>"/>
                <table>
                    <tr>
                        <td valign="top"><label for="txtcodigo">Codigo de usuario * :</label> </td>
                        <td><input type="text" id="txtcodigo" name="txtcodigo" value="<?=sprintf("%07d",$vFila["idusuario"])?>" placeholder="Codigo" readonly /> </td>
                    </tr>
                    <tr><td colspan="2" style="height:10px;"></td></tr>
                    <tr>
                        <td valign="top"><label for="txtnombre">Nombre de usuario * :</label> </td>
                        <td><input type="text" id="txtnombre" name="txtnombre" placeholder="Usuario" value="<?=$vFila["usuario"]?>"  data-required="true" style="width: 200px;" /> </td>
                    </tr>
                    <tr><td colspan="2" style="height:10px;"></td></tr>
                    <tr>
                        <td valign="top"><label for="txtcorreo">Correo * :</label> </td>
                        <td><input type="text" id="txtcorreo" name="txtcorreo" data-type="email" data-trigger="change" value="<?=$vFila["correo"]?>"  placeholder="Correo"  data-required="true" style="width: 500px;"/> </td>
                    </tr>
                    <tr><td colspan="2" style="height:10pt;"></td></tr>
                    <tr>
                        <td valign="top"><label for="cmbPerfil">Perfil * :</label> </td>
                        <td>    
                            <select name="cmbPerfil" id="cmbPerfil" data-required="true" title="Seleccionar Perfil">
                                    <option value="0" selected>[--Selected--]</option>
                                    <?=Datos::getCombo("cmbPerfil",'',$vFila["idperfil"])?>
                                </select>                            
                        </td>
                    </tr>
                    <tr><td colspan="2" style="height:10px;"></td></tr>
                    <tr><td colspan="2" style="height:10px;font-size: 10px;text-align:left;">Si deseas cambiar la contraseña del usuario, escribe aquí dos veces la nueva. En caso contrario, deja las casillas en blanco.</td></tr>
                    <tr>
                        <td valign="top"><label for="txtclave">Nueva contraseña* :</label> </td>
                        <td><input type="text" id="txtclave" name="txtclave" data-equalto="#txtclave" placeholder="Clave" /> </td>
                    </tr>
                    <tr><td colspan="2" style="height:10px;"></td></tr>
                    <tr>
                        <td valign="top"><label for="txtclaverep">Repetir nueva contraseña* :</label> </td>
                        <td><input type="text" id="txtclaverep" name="txtclaverep" data-equalto="#txtclave" placeholder="Repetir clave" /> </td>
                    </tr>
                    
                </table>
                <br/>
            </div>
        </form>

        
    </body>
</html>
