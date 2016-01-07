<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>INSERTAR CLASE </title>
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
                        url: 'ControladorClase.php',
                        data: 'accion=' + $('#accion').val() + '&nom=' + $('#txtnombre').val(),
                        success:function(msj){
                            if ( msj == 1 ){
                                alert('Clase insertada');
                                $('#txtnombre').val("");
                                window.location='MNTclase.php';
                            }
                            else{
                                alert('Error');
                            }
                        },
                        error:function(){
                            alert('error');
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
                Nuevo Clase
            </div>
            <div style="width: 900px;height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h1 style="padding: 0; margin: 0;">Insertar nueva clase
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
                        <td valign="top"><label for="fullname">Nombre de clase * :</label> </td>
                        <td><input type="text" id="txtnombre" name="txtnombre" placeholder="Nombre" data-required="true" /> </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                </table>
                
            
        </form>
        </div>

        
        
    </body>
</html>
