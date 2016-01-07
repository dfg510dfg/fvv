<?php session_start();
include('../_config/Configuracion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title><?=TITULO_LOGIN?></title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css" />
                <link href="../../imagenes/favicon.png" rel="shortcut icon" type="image/x-icon">
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="functions.ajax.js"></script>
	</head>
	<body><div id="allContent"><table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td align="center" valign="middle" height="100%" width="100%">
		
		<div id="alertBoxes"></div>
		<span class="loginBlock"><span class="inner">
			<?php
if ( isset($_SESSION['username']) && isset($_SESSION['userid']) && $_SESSION['username'] != '' && $_SESSION['userid'] != '0' ){
    
    ?>
        <script>
            window.location.href = "../_sistema/cpanel.php";
        </script>
   <?
}
else{
    ?>
	<form method="post">
		<img src="<?=IMG_LOGIN?>" width="400"/>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td>Usuario:</td>
				<td><input type="text" name="login_username" id="login_username" /></td>
			</tr>
			<tr>
				<td>Contrase&ntilde;a:</td>
				<td><input type="password" name="login_userpass" id="login_userpass" /></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><span class="timer" id="timer"></span><button id="login_userbttn">Login</button></td>
			</tr>
		</table>
	</form>
        <?
}
			?>
		
		</span></span>
		
	</td></tr></table></div></body>
</html>