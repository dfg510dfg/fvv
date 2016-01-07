<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");$objSesion=new Sesion(); if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){ echo "<script>parent.window.location.reload();</script>";}
include("../_util/Datos.php");
$objDatos = new Datos();
$vFila=$objDatos->getConsulta(array("f_datos",$_GET["id"]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MODIFICAR DATOS</title>
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
                        data: 'accion=' + $('#accion').val() + '&id=' + $('#txhCodigo').val() +'&cmbPosicion=' + $('#cmbPosicion').val() + '&txtnombre=' + $('#txtnombre').val()
                                + '&txtContenido=' + $('#txtContenido').val()+ '&txturl=' + $('#txturl').val(),
                        success:function(msj){
                            if ( msj == 1 ){
                                alert('El registro fue actualizado satisfactoriamente');
                                window.location='MNTDatos.php';
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
                Actualizar Dato de Contacto
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Actualizar Dato de Contacto <?=$vFila["nombre"]?>
                    <div style="float: right;padding:5px 0.5em 0 0;">
                        <input type="hidden" name="superhidden" id="superhidden">
                        <span class="btn btn" id="demo-form-valid" onclick="procesar('');"><i class="icon-ok"></i></span>
                    </div></h1>
            </div>
            <br/>    
		
                <form id="demo-form" ata-validate="parsley">
                <input type="hidden" id="accion" name="accion" value="UPD"/>
                <input type="hidden" id="txhCodigo" name="txhCodigo" value="<?=$_GET["id"]?>"/>
                <table>
                    <tr>
                        <td valign="top"><label for="txtcodigo">Codigo de dato * :</label> </td>
                        <td><input type="text" id="txtcodigo" name="txtcodigo" value="<?=sprintf("%07d",$vFila["iddatos"])?>" placeholder="Codigo" readonly /> </td>
                    </tr>
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
                                    <option value="<?=$i?>" <?php if($vFila["posicion"]==$i){echo 'selected ';}?> ><?=$i?></option> 
                                <?php
                                $i=$i+1;
                                }?> 
                            </select>                            
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="txtnombre">Nombre de Campo * :</label> </td>
                        <td><input type="text" id="txtnombre" name="txtnombre" value="<?=$vFila["campo"]?>" placeholder="Campo" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="txtContenido">Contenido * :</label> </td>
                        <td><input type="text" id="txtContenido" name="txtContenido" value="<?=$vFila["contenido"]?>" placeholder="Contenido" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="txturl">Enlace URL :</label> </td>
                        <td><input type="text" id="txturl" name="txturl" value="<? if($vFila["url"]!='#'){echo $vFila["url"];}?>" placeholder="http://" data-required="true" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                </table>
        </form>
        </div>

        
        
    </body>
</html>
