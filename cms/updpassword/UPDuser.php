<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])) header("Location: ../login/logout.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add New Association</title>
	<!-- include para formulario -->
        <script type="text/javascript" src="../javascripts/jquery.js"></script>
        <script type="text/javascript" src="../javascripts/parsley.js"></script>
        <script type="text/javascript" src="../javascripts/jquery.easing.1.3.js"></script>
        <link rel="stylesheet" type="text/css" href="../_css/bootstrap.css"/>
        
        
        <link href="../pschecker/style/demo.css" rel="stylesheet" type="text/css" />
        <link href="../pschecker/style/style.css" rel="stylesheet" type="text/css" />
    <script src="../pschecker/js/pschecker.js" type="text/javascript"></script>
        
        <!-- fin include para formulario -->
        <script>
            function procesar(){
                var macthvalido = $('#macthvalido').val();
                var bol = $('#demo-form').parsley('validate');
                if(bol){
                    if(macthvalido==1){
                        $('#msgFile').html('');
                        $.ajax({
                            type: 'POST',
                            url: '../_controlador/UsuarioControlador.php',
                            data: 'accion=' + $('#accion').val() + '&pass=' + $('#txtpassword').val() + '&passrep=' + $('#txtpasswordrepeat').val() + '&idusuario=' + $('#idusuario').val(),
                            success:function(msj){
                                if (msj==1){
                                    alert('*************************************************\n - MENSAJE DEL SISTEMA - \n*************************************************\n\n The password was changed successfully.\n\n');
                                    //window.location='MNTclase.php';
                                    $(":password").each(function(){	
                                        $($(this)).val('');
                                    });
                                    $("#txtpassword").focus();
                                }
                                else{
                                    alert('Error : \n '+ msj);
                                }
                            },
                            error:function(){
                                alert('Error fatal');
                            }
                        });
                        //$('#demo-form').submit();
                    }else{
                        $('#msgFile').html('<p style=\"color:red;\">(*) Not match. The different passwords.!!! </p>');
                    }
                }
            }
            
            $(window).keypress(function(e) {
                if(e.keyCode == 13) {
                    procesar();
                }
            });

            $(document).ready(function () {           
            //Demo code
            $('.password-container').pschecker({ onPasswordValidate: validatePassword, onPasswordMatch: matchPassword });

            var submitbutton = $('.btn');
            var errorBox = $('.error');

            errorBox.css('visibility', 'hidden');
            //submitbutton.attr("disabled", +++++++++++++++++ "disabled");

            //this function will handle onPasswordValidate callback, which mererly checks the password against minimum length
            function validatePassword(isValid) {
                var pasvalido=$('#pasvalido');
                if (!isValid)
                    errorBox.css('visibility', 'visible');
                else
                    errorBox.css('visibility', 'hidden');
            }
            //this function will be called when both passwords match
            
            function matchPassword(isMatched) {
                var macthvalido=$('#macthvalido');
                if (isMatched) {
                    //submitbutton.addClass('unlocked').removeClass('locked');
                    //submitbutton.removeAttr("disabled", "disabled");
                    macthvalido.val('1');
                }else {
                    //submitbutton.attr("disabled", "disabled");
                    //submitbutton.addClass('locked').removeClass('unlocked');
                    macthvalido.val('0');
                }
            }
        });
        </script>
    </head>
	<body>
           <form id="demo-form" ata-validate="parsley" method="post" style="list-style:none;" action="../_controlador/AsociacionControlador.php">
         <div style="width: auto; border-radius:10px; border:solid 5px #000;background-image:url(../_img/bgpanel.jpg);">
            <div style="background-color:#555555;height:20px;text-align: left;color:#fff;padding-left: 5px; ">
                Password
            </div>
            <div style="height:40px;background-color:grey; text-align: left;color:#fff;padding-left: 5px;">
                <h3 style="padding:0px; margin: 0;">Reset Password
                 <span class="btn btn" style="float:right;margin:5px 5px 0 0;" id="demo-form-valid" onclick="procesar();"><i class="icon-ok"></i></span>
                </h3>
                
            </div>
            <br/>
                <input type="hidden" id="accion" name="accion" value="UPD"/>
                <input type="hidden" value="0"  name="txhmacthvalido" id="macthvalido">
                <div class="wrapper">
        <div class="logo">
            <img src="../pschecker/images/logo.jpg" alt="logo" /></div>
        <p>
            <span class="error">Password must be 8 characters long</span>
        </p>
        <div id="msgFile"></div>
        <div class="password-container">
            <p>
                <label for="txtpassword">Enter Password:</label>
                <input class="strong-password" type="password" id="txtpassword" name="txtpassword" placeholder="Password" data-required="true" />
            </p>
        </br></br></br>
            <p>
                <label for="txtpasswordrepeat">
                    Confirm Password:</label>
                <input class="strong-password" type="password" id="txtpasswordrepeat" name="txtpasswordrepeat" placeholder="Repeat Password" data-required="true"/>
            </p>
            <p>
                <!--<a class="submit-button locked" href="#">Submit</a>-->
            </p>
        </br></br></br>
            <div class="strength-indicator" style="padding-left:12em;">
                <div class="meter" style="padding-left:12em;">
                </div>
                Strong passwords contain 8-16 characters, do not include common words or names,
                and combine uppercase letters, lowercase letters, numbers, and symbols.
            </div>
        </div>
    </div>    

            </div>
        </div>            
        </form>        
    </body>
</html>
