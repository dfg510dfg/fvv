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
        <title>INSERTAR DATOS </title>
        <!-- include para formulario -->
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>
        <!-- fin include para formulario -->
        <script>
            function procesar(){
                if($('#txturl').val()==''){
                    document.getElementById("txturl").value="http://";
                }
                var bol = $('#demo-form').parsley('validate');
                if(bol){
                    $.ajax({
                        type: 'POST',
                        url: 'ControladorDatos.php',
                        data: 'accion=' + $('#accion').val() + '&cmbPosicion=' + $('#cmbPosicion').val() + '&txtnombre=' + $('#txtnombre').val()
                                + '&txtContenido=' + $('#txtContenido').val()+ '&txturl=' + $('#txturl').val(),
                        success:function(msj){
                            if ( msj == 1 ){
                                alert('Dato insertado');
                                $('#txtnombre').val(""); 
                                window.location='MNTDatos.php';
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
                Nuevo Dato de Contacto
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Insertar nuevo Dato de Contacto
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
                        <td valign="top"><label for="cmbClase">Posicion * :</label> </td>
                        <td>    
                            <select name="cmbPosicion" id="cmbPosicion" data-required="true" class="parsley-validated parsley-error"  title="Seleccionar Posicion">
                                <?php
                                $objMysql = new Mysql();
                                $sql = "SELECT * FROM ".DB_PREFIJO."_datos WHERE iddatos >0 ;"; 
                                $res= $objMysql->ejecutar($sql);
                                $i=1;
                                while($row = $res->fetch(PDO::FETCH_ASSOC)){ ?> 
                                    <option value="<?=$i?>"><?=$i?></option> 
                                <?php
                                $i=$i+1;
                                }?> 
                                <option value="<?=$i?>" selected > <?=$i?></option>
                            </select>                            
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="txtnombre">Nombre de Campo * :</label> </td>
                        <td><input type="text" id="txtnombre" name="txtnombre" placeholder="Campo" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="txtContenido">Contenido * :</label> </td>
                        <td><input type="text" id="txtContenido" name="txtContenido" placeholder="Contenido" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="txturl">Enlace URL :</label> </td>
                        <td><input type="text" id="txturl" name="txturl" placeholder="http://" data-required="true" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>

                            
                </table>
                
            
        </form>
        </div>

        
        
    </body>
</html>
