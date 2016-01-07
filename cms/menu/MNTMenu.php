<?
include("../_util/Sesion.php");$objSesion=new Sesion(); if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){ echo "<script>parent.window.location.reload();</script>";}
include("../_util/Datos.php");
//AL PRINCIPIO COMPRUEBO SI HICIERON CLICK EN ALGUNA PaGINA
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
//SI NO DIGO Q ES LA PRIMERA P�GINA
    $page = 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MANTENIMIENTO DE MENU DE OPCIONES</title>
        <!-- include para formulario -->
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <script type="text/javascript" src="../javascripts/_util.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/_tabla.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>


        <!-- fin include para formulario -->
        <script>
           
            $(document).ready(function(){setScrollBar("scrollGrilla",865,250);setFoco("txtValorabuscar");});           
            function irA(accion){
                if(accion=='INS'){
                    window.location='INSMenu.php';
                }else if(accion=='UPD'){
                    var frm = document.forms[0];
                    var f = frm.length;
                    var aleatorio = Math.random();
                    var activo = false;
                    var id="";
                    var msg = "";
                    var index=0;
                    for(var i=0; i <f; i++){
                        if(frm.elements[i].type=="checkbox"){
                            if(frm.elements[i].id != "chkseleAll"){
                                if(frm.elements[i].checked){
                                    activo=true;
                                    id = frm.elements[i].value;
                                    index++;
                                }
                            }
                        }
                    }
                    if(!activo){
                        alert("Debe elegir un registro");
                        return false;
                    } else if(index>1){
                        alert("Debe elegir solo una fila");
                        return false;
                    }else{
                        window.location='UPDMenu.php?id='+id;
                    } 
                }else if(accion=='DEL'){
                    var frm = document.forms[0];
                    var f = frm.length;
                    var aleatorio = Math.random();
                    var activo = false;
                    var id="";
                    var msg = "";
                    var index=0;
                    for(var i=0; i <f; i++){
                        if(frm.elements[i].type=="checkbox"){
                            if(frm.elements[i].id != "chkseleAll"){
                                if(frm.elements[i].checked){
                                    activo=true;
                                    id = frm.elements[i].value;
                                    index++;
                                }
                            }
                        }
                    }
                    if(!activo){
                        alert("Debe elegir un registro");
                        return false;
                    } else if(index>1){
                        alert("Debe elegir solo una fila");
                        return false;
                    }else{
                        $.ajax({
                            type: 'POST',
                            url: 'ControladorMenu.php',
                            data: 'accion=DEL&id=' + id,
                            success:function(msj){
                                if ( msj == 1 ){
                                    alert('El registro fue eliminado satisfactoriamente');
                                    window.location='MNTMenu.php';
                                }
                                else{
                                    if(msj==2){
                                        alert('El registro contiene otros registros');
                                        window.location='MNTMenu.php';
                                    }else{
                                        alert('Error');
                                    }
                                }
                            },
                            error:function(){
                                alert('Error');
                            }
                        });
                    }   
                }   
            }
            
            function validar(){
                var tipo1 = document.getElementById("rdbTipoLista1");
                var tipo2 = document.getElementById("rdbTipoLista2");
                var txtBuscar = document.getElementById("txtValorabuscar");
                if(tipo1.checked){
                    txtBuscar.size=68;
                    txtBuscar.value="";
                    txtBuscar.focus();
                } else {
                    txtBuscar.size=30;
                    txtBuscar.value="";
                    txtBuscar.focus();
                }
            }
           
            function buscar(objform){
                var bol = $('#demo-form').parsley('validate');                
                if(bol){
                    objform.method="post";
                    objform.action="MNTMenu.php";
                    objform.submit();
                }else {
                    return 0;
                }
            }
        </script>
    </head>

    <body>

        <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg);">
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Menu
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Mantenimiento del Menu</h1>
            </div>
            <br/>    

            <form id="demo-form" ata-validate="parsley">
                <!-- BUSCAR DATOS  -->
                <div class="areaForm">
                    <table class="buscador">
                        <tr>
                            <td class="label">Buscar por : </td>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td><input type="radio" name="rdbBuscar" id="rdbTipoLista1" onclick="validar();" value="nombre" checked <?=($_REQUEST["rdbBuscar"]=="nombre")?"checked":""?>/> Nombre Menu</td>
                                                <td width="50"></td>
                                                <td><input type="radio" name="rdbBuscar" id="rdbTipoLista2" onclick="validar();" value="codigo" <?=($_REQUEST["rdbBuscar"]=="codigo")?"checked":""?>/> Código </td>
                                            </tr>
                                        </table> 
                                    </td>
                        </tr>
                        <tr>
                            <td valign="middle"><label for="txtValorabuscar">Palabra a buscar * :</label></td>
                            <td><input type="text" id="txtValorabuscar" name="txtValorabuscar" value="<?=$_REQUEST["txtValorabuscar"]?>" placeholder="Palabra a buscar" data-required="true" style="width:500px;" /></td>
                            <td width="50"> </td>
                            <td valign="top">
                                
                                <button type="button" class="btn btn" id="demo-form-valid" onclick="buscar(this.form);">
                                    <i class="icon-ok"></i>
                                </button>
                                <br/>
                                <input type="hidden" name="superhidden" id="superhidden"/>
                            </td>
                        </tr>
                        

                    </table>
                </div>

                <!-- BUSCAR DATOS  -->

                <!-- GRILLA  -->
                <?
                $objMysql = new Mysql();
                $objDatos = new Datos();
                $mostrarRegistros = 8;
                print($objMysql->getGrillaHTMLTablet(
                        $objDatos->getConsulta(array("listarMenu","",(!$_GET["campo"])?"lista":$_GET["campo"],(!$_GET["ordenar"])?"asc":$_GET["ordenar"],(($_POST["rdbBuscar"])?$_POST["rdbBuscar"]:$_GET["rdbBuscar"]),(($_POST["txtValorabuscar"])?$_POST["txtValorabuscar"]:$_GET["txtValorabuscar"]),$page,$mostrarRegistros)),
                        "850", 
                        array("Código","lista", "Nombre","estado"), 
                        array(198, 198,198,198), 
                        array($_GET["campo"], $_GET["ordenar"], $page, $objDatos->getConsulta(array("listarMenuTot","",(!$_GET["campo"])?"codigo":$_GET["campo"],(!$_GET["ordenar"])?"asc":$_GET["ordenar"],(($_POST["rdbBuscar"])?$_POST["rdbBuscar"]:$_GET["rdbBuscar"]),(($_POST["txtValorabuscar"])?$_POST["txtValorabuscar"]:$_GET["txtValorabuscar"]),"")), (($_POST["txtValorabuscar"])?$_POST["txtValorabuscar"]:$_GET["txtValorabuscar"]), (($_POST["rdbBuscar"])?$_POST["rdbBuscar"]:$_GET["rdbBuscar"]),$mostrarRegistros)
                    ));
                
                
                
                ?>


                <!--  ************************** -->    
            </form>
        </div>



    </body>
</html>
