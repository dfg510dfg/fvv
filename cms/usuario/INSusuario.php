<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
//session_start();
//if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])) header("Location: ../login/logout.php");
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
                        url: 'ControladorUsuario.php',
                        data: 'accion=' + $('#accion').val() + '&txtnombre=' + $('#txtnombre').val() + '&txtcorreo=' + $('#txtcorreo').val() + '&txtclave=' + $('#txtclave').val() + '&cmbPerfil=' + $('#cmbPerfil').val(),
                        success:function(msj){
                            if ( msj == 1 ){
                                alert('****************************************\n Insertado \n****************************************');
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
                Nuevo Usuario
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Insertar nueva usuario
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
                        <td valign="top"><label for="txtnombre">Nombre de usuario * :</label> </td>
                        <td><input type="text" id="txtnombre" name="txtnombre" placeholder="Usuario" data-required="true" style="width: 200px;" /> </td>
                    </tr>
                    <tr><td colspan="2" style="height:10px;"></td></tr>
                    <tr>
                        <td valign="top"><label for="txtcorreo">Correo * :</label> </td>
                        <td><input type="text" id="txtcorreo" name="txtcorreo" data-type="email" data-trigger="change"  placeholder="Correo"  data-required="true" style="width: 500px;"/> </td>
                    </tr>
                    <tr><td colspan="2" style="height:10px;"></td></tr>
                    <tr>
                        <td valign="top"><label for="txtclave">Clave* :</label> </td>
                        <td><input type="text" id="txtclave" name="txtclave" data-equalto="#txtclave" placeholder="Clave" data-required="true" /> </td>
                    </tr>
                    <tr><td colspan="2" style="height:10px;"></td></tr>
                    <tr>
                        <td valign="top"><label for="txtclaverep">Repetir clave* :</label> </td>
                        <td><input type="text" id="txtclaverep" name="txtclaverep" data-equalto="#txtclave" placeholder="Repetir clave" data-required="true" /> </td>
                    </tr>
                    <tr><td colspan="2" style="height:10px;"></td></tr>
                    <tr>
                        <td valign="top"><label for="cmbPerfil">Perfil * :</label> </td>
                        <td>    
                            <select name="cmbPerfil" id="cmbPerfil" data-required="true" title="Seleccionar Perfil">
                                    <option value="0" selected>[--Selected--]</option>
                                    <?=Datos::getCombo("cmbPerfil",'','')?>
                                </select>                            
                        </td>
                    </tr>
                </table>
                <br/>
            </div>
        </form>

        
    </body>
</html>
