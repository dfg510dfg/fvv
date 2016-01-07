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
        <title>INSERTAR MENU </title>
        <!-- include para formulario -->
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>
        <!-- fin include para formulario -->
        
        <script type="text/javascript" src="../javascripts/_util.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/styles.css" />
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
            function OcultarMenu(){
                $("#pertenencia").fadeOut();
                $("#enlaceInterno").fadeOut();
                $("#enlaceExterno").fadeOut();
                $("#abrirEnlace").fadeOut();
                $("#enlaceClase").fadeOut();
                $("#enlaceCategoria").fadeOut();
                $("#enlaceProducto").fadeOut();
            }
            function MostrarMenu(){
                if($('#cmbNivel').val()==2 || $('#cmbNivel').val()==3)
                {
                    $("#pertenencia").fadeIn();
                    $('#cmbPosicion').html('<option value="0">[---]</option>');
                }
                else
                {
                    $("#pertenencia").fadeOut();
                    cantidad();
                }
            }
            function  enlacesMenu(){
                if($('#cmbContenido').val()==2){
                    $("#enlaceInterno").fadeIn();
                    $("#enlaceExterno").fadeOut();
                    $("#abrirEnlace").fadeIn();
                    $("#enlaceClase").fadeOut();
                    $("#enlaceCategoria").fadeOut();
                    $("#enlaceProducto").fadeOut();
                }else{
                    if($('#cmbContenido').val()==3){
                        $("#enlaceInterno").fadeOut();
                        $("#enlaceExterno").fadeIn();
                        $("#abrirEnlace").fadeIn();
                        $("#enlaceClase").fadeOut();
                        $("#enlaceCategoria").fadeOut();
                        $("#enlaceProducto").fadeOut();
                    }else{
                        if($('#cmbContenido').val()==4){
                            $("#enlaceInterno").fadeOut();
                            $("#enlaceExterno").fadeOut();
                            $("#abrirEnlace").fadeIn();
                            $("#enlaceClase").fadeIn();
                            $("#enlaceCategoria").fadeOut();
                            $("#enlaceProducto").fadeOut();
                        }else{
                            if($('#cmbContenido').val()==5){
                                $("#enlaceInterno").fadeOut();
                                $("#enlaceExterno").fadeOut();
                                $("#abrirEnlace").fadeIn();
                                $("#enlaceClase").fadeOut();
                                $("#enlaceCategoria").fadeIn();
                                $("#enlaceProducto").fadeOut();
                            }else{
                                if($('#cmbContenido').val()==6){
                                    $("#enlaceInterno").fadeOut();
                                    $("#enlaceExterno").fadeOut();
                                    $("#abrirEnlace").fadeIn();
                                    $("#enlaceClase").fadeOut();
                                    $("#enlaceCategoria").fadeOut();
                                    $("#enlaceProducto").fadeIn();
                                }else{
                                    $("#enlaceInterno").fadeOut();
                                    $("#enlaceExterno").fadeOut();
                                    $("#abrirEnlace").fadeOut();
                                    $("#enlaceClase").fadeOut();
                                    $("#enlaceCategoria").fadeOut();
                                    $("#enlaceProducto").fadeOut();
                                }
                            }
                        }
                    }
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
                        url: 'ControladorMenu.php',
                        data: 'accion=' + $('#accion').val() + '&nivel=' + $('#cmbNivel').val() +'&pertenece=' + $('#cmbPertenece').val()
                                +'&posicion=' + $('#cmbPosicion').val()+'&campo=' + $('#txtCampo').val() +'&contenido=' + $('#cmbContenido').val() +'&cenlace=' + $('#cmbEnlace').val()
                                +'&tenlace='+ $('#txtEnlace').val()+'&mostrar='+ mostrar+'&abrir=' + $('#cmbAbrir').val()+'&cClase=' + $('#cmbClase').val()+'&cCategoria=' + $('#cmbCategoria').val()+'&cProducto=' + $('#cmbProducto').val(),
                        success:function(msj){
                            
                            if ( msj == 1 ){
                                alert('Opcion insertado');
                                window.location='MNTMenu.php';
                            }
                            else{
                                alert(msj+' Error en la respueta');
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

    <body onload="OcultarMenu()">    
        
         <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg);">
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Nuevo Opcion
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Insertar nueva Opcion
                <div style="float: right;padding:5px 0.5em 0 0;">
                    <input type="hidden" name="superhidden" id="superhidden">
                    <span class="btn btn" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                </div>
                </h1>
            </div>
            <br/>    
		
                <form id="demo-form" data-validate="parsley">
                <input type="hidden" id="accion" name="d" value="INS"/>
                <table>
                        
                        <tr>
                            <td valign="top"><label> Nivel :</label> </td>
                            <td>    
                                <select name="cmbNivel" id="cmbNivel" onchange="buscar();MostrarMenu()">
                                        <option value="0">[--Selected--]</option>
                                        <option value="1">NIVEL 1</option>
                                        <option value="2">NIVEL 2</option>
                                        <option value="3">NIVEL 3</option>
                                 </select>                            
                            </td>
                        </tr>
                        
                        <tr id="pertenencia">
                            <td valign="top"><label>Pertenece a :</label> </td>
                            <td>    
                                <select name="cmbPertenece" id="cmbPertenece" onclick="cantidad();">
                                        <option value="0">[--Selected--]</option>
                                 </select>   
                                <label id="cmbn1"></label>
                            </td>
                        </tr>
                        
                        <tr>
                            <td valign="top"><label>Posicion :</label> </td>
                            <td>    
                                <select name="cmbPosicion" id="cmbPosicion">
                                        <option value="0">[---]</option>
                                 </select>   
                                <label id="cmbn"></label>
                            </td>
                        </tr>
                    
                        <tr>
                            <td valign="middle"><label>Ingrese Campo : </label></td>
                            <td><input type="text" id="txtCampo" name="txtCampo" value="<?=$_REQUEST["txtCampo"]?>" placeholder="Nombre del menu" data-required="true" style="width:200px;" /></td>
                        </tr>
                            
                        <tr>
                            <td valign="top"><label>Contenido : </label> </td>
                            <td><select name="cmbContenido" id="cmbContenido" style="width:165px;" onclick="enlacesMenu();">
                                <option value="1">SIN ENLACE</option>
                                <option value="2">ENLACE INTERNO</option>
                                <option value="3">ENLACE EXTERNO</option>
                                <option value="4">CLASE</option>
                                <option value="5">CATEGORIA</option>
                                <option value="6">PRODUCTO</option>
                            </select></td>
                        </tr>
                        <tr id="enlaceInterno">
                            <td valign="top"><label>Enlace Interno : </label> </td>
                            <td>
                                <select id="cmbEnlace" name="cmbEnlace" style="width:165px" data-required="true" class="parsley-validated parsley-error"  title="Seleccionar Enlace">
                                    <option value="0">--Escoja--</option>
                                    <?=Datos::getCombo("cmbPagina",'','')?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr id="enlaceExterno">
                            <td valign="top"><label>Enlace Externo : </label> </td>
                            <td>
                                <input type="text" id="txtEnlace" name="txtEnlace"  value ="http://" data-required="true" style="width:250px;" />
                            </td>
                        </tr>
                        <tr id="enlaceClase">
                            <td valign="top"><label>Clase : </label> </td>
                            <td>
                                <select id="cmbClase" name="cmbClase" style="width:165px" data-required="true" class="parsley-validated parsley-error"  title="Seleccionar Enlace">
                                    <option value="0">--Escoja--</option>
                                    <?=Datos::getCombo("cmbClase",'','')?>
                                </select>
                            </td>
                        </tr>
                        <tr id="enlaceCategoria">
                            <td valign="top"><label>Categoria : </label> </td>
                            <td>
                                <select id="cmbCategoria" name="cmbCategoria" style="width:165px" data-required="true" class="parsley-validated parsley-error"  title="Seleccionar Enlace">
                                    <option value="0">--Escoja--</option>
                                    <?=Datos::getCombo("cmbCategoria",'','')?>
                                </select>
                            </td>
                        </tr>
                        <tr id="enlaceProducto">
                            <td valign="top"><label>Producto : </label> </td>
                            <td>
                                <select id="cmbProducto" name="cmbProducto" style="width:165px" data-required="true" class="parsley-validated parsley-error"  title="Seleccionar Enlace">
                                    <option value="0">--Escoja--</option>
                                    <?=Datos::getCombo("cmbProductos",'','')?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr id="abrirEnlace">
                            <td valign="top"><label>Abrir en : </label> </td>
                            <td>
                                <select id="cmbAbrir" name="cmbAbrir" style="width:165px;">
                                    <option value="1">Misma Pestaña</option>
                                    <option value="2">Nueva Pestaña</option>
                                    <option value="3">pop-up</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="chkmostrar">Mostrar Opcion * :</label> </td>
                            <td><input type="checkbox" name="chkmostrar" id="chkmostrar" value="1" onclick="setTextoCheck(this.name);"/><span id="textoCheck" style="float: left;"></span></td>
                            <td colspan="3"></td>
                        </tr>
                </table>
                
            
        </form>
        </div>

        
        
    </body>
</html>
