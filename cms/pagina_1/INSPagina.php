<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");
$objSesion=new Sesion(); 
$valses=$objSesion->getVariableSession("username");
//echo $valses;
if (!isset($valses)){ 
    echo "<script>window.location='../login/logout.php';</script>";
}include("../_util/Datos.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>INSERTAR PAGINA </title>
        
	<script src="../ckeditorFull/ckeditor.js" type="text/javascript"></script>
	<script src="../ckfinder/ckfinder.js" type="text/javascript"></script>   
        
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../stylesheets/forms.css"/>
        
        <script>
            $(document).ready(function(){
            $("#test").htmlarea();
            $("textarea").htmlarea();        
            setTextoCheck("chkmostrar"); setFoco('txtnombre');});
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
        <form id="demo-form" data-validate="parsley" method="post" enctype="multipart/form-data" action="ControladorPagina.php">
         
            <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../img/bgpanel.jpg); ">
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Nuevo P&aacute;gina
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Insertar nueva p&aacute;gina
                <div style="float: right;padding:5px 0.5em 0 0;">
                    <input type="hidden" name="superhidden" id="superhidden">
                    <span class="btn btn" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                </div>
                </h1>
            </div>
            <br/>    
		<input type="hidden" id="accion" name="accion" value="INS"/>
		<input type="hidden" id="cmbTipo" name="cmbTipo" value="1"/>
                <table>
                    
                    <tr>
                        <td><label for="txtnombre">Titulo de P&aacute;gina * :</label> </td>
                        <td colspan="4"><input type="text" id="txtnombre" name="txtnombre" placeholder="Titulo" data-required="true" style="width: 550px;" /> </td>                        
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    <tr>
                        <td><label for="txttag">Tag * :</label> </td>
                        <td colspan="4"><input type="text" id="txttag" name="txttag" placeholder="Tag" data-required="true" style="width: 550px;" /> </td>                        
                    </tr>
                    <tr><td colspan="5" height="15"></td></tr>
                    
                </table>
                <table width="97%">  
                    <tr>
                        <td><textarea class="ckeditor" cols="80" id="editor1" name="area" rows="10"></textarea>
							<script type="text/javascript">
							var editor = CKEDITOR.replace( 'editor1', {
								filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
								filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
								filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
								filebrowserUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
								filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
								filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
							});
							CKFinder.setupCKEditor(editor, '../../' );
							</script>				
						</td>
                    </tr>
                </table>

        </form>
        </div>

        
        
    </body>
</html>
