<?php
include("../_coneccion/conectarDB.php");
$cn = conectarDB();
include("../_config/Globales.php");

if (isset($_POST["txhId"]))
    $nId = $_POST["txhId"];
else
    $nId = "";
if (isset($_POST["txtnombre"]))
    $nombre = $_POST["txtnombre"];
else
    $nombre = "";
if (isset($_POST["txttelefono"]))
    $telefono = $_POST["txttelefono"];
else
    $telefono = "";
if (isset($_POST["txtcorreo"]))
    $correo = $_POST["txtcorreo"];
else
    $correo = "";
if (isset($_POST["txtcorreo1"]))
    $correo1 = $_POST["txtcorreo1"];
else
    $correo1 = "";
if (isset($_POST["txtConsulta"]))
    $comment = $_POST["txtConsulta"];
else
    $comment = "";
if (isset($_POST["txtRespuesta"]))
    $resp = $_POST["txtRespuesta"];
else
    $resp = "";
/* --------------------------------------------------------------------------------------- */

$query = "";
$error = NULL;
try {
    $query = "UPDATE ".DB_PREFIJO."_contactenos
                        SET
                        respuesta = '" . $resp . "',
                        estado = 1
                        WHERE idcontactenos ='$nId';";
    $rs = $cn->prepare($query);
    $rs->execute();

    require_once('../librerias/PHPMailer_v5_1/class.phpmailer.php');
    /*     * ****************Enviar Mail*********************** */
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "mail.indeesac.com";
    $mail->Username = "consultas@indeesac.com";
    $mail->Password = "consultas*100";
    $mail->Port = 26;
    $mail->From = "consultas@indeesac.com";
    $mail->FromName = utf8_decode("INDEESAC");
    $mail->AddAddress(strtolower($correo1));
    $mail->IsHTML(true);
    $mail->Subject = utf8_decode("Consultas - Indeesac");
    $body = "<html>"
            . "<title></title>"
            . "<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head><div><table>"
            . "<tr>"
            . "<a href='http://www.indeesac.com'><img src='http://www.indeesac.com/imagenes/logo.png'></a>"
            . "</tr>"
            . "<tr>"
            . "<td align=right><font color='#3299CC'>" . utf8_decode("Nombre o Razón Social: ") . "<font></td>"
            . "<td>$nombre</td>"
            . "</tr>"
            . "<tr>"
            . "<td align=right><font color='#3299CC'>Telefono: <font></td>"
            . "<td>$telefono</td>"
            . "</tr>"
            . "<tr>"
            . "<td align=right><font color='#3299CC'>Correo: <font></td>"
            . "<td><a href='mailto:$correo?subject=Informes'>$correo</a></td>"
            . "<tr>"
            . "<td align=right><font color='#3299CC'>Decripcion del Pedido: <font></td>"
            . "<td>" . utf8_decode($comment) . "</td>"
            . "</tr>"
            . "<tr>"
            . "<td align=right><font color='#3299CC'>Decripcion del Pedido: <font></td>"
            . "<td>" . utf8_decode($resp) . "</td>"
            . "</tr>"
            . "</table>"
            . "</div></html>";
    $body.= "";
    $mail->Body = $body;
    $exito = $mail->Send();

    if ($correo != "") {
        $mail = "";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "mail.klimacyalta.com";
        $mail->Username = "webmaster@klimacyalta.com";
        $mail->Password = "webmaster@10";
        $mail->Port = 26;

        $mail->From = "ventas@klimacyalta.com";
        $mail->FromName = utf8_decode("Klimacyalta");
        $mail->AddAddress(strtolower($correo));
        $mail->AddCC("ventas@klimacyalta.com");
//$mail->AddCC("d.c.ponce@hotmail.com");
        $mail->IsHTML(true);
        $mail->Subject = utf8_decode("Consultas - KLIMACYALTA Contratistas Generales");
        $body = "<html>"
                . "<title></title>"
                . "<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head>"
                . "<div><table>"
                . "<tr>"
                . "<a href='http://www.klimacyalta.com'><img src='http://www.klimacyalta.com/imagenes/logo-01.png'></a>"
                . "</tr>"
                . "</table>"
                . "Gracias por acceder a nuestra pagina web." . "<br>"
                . "<br><br>"
                . "<table>"
                . "<tr>"
                . "<td align=right><font color='#3299CC'>" . utf8_decode("Nombre o Razón Social: ") . "<font></td>"
                . "<td>$nombre</td>"
                . "</tr>"
                . "<tr>"
                . "<td align=right><font color='#3299CC'>Correo: <font></td>"
                . "<td><a href='mailto:$correo?subject=Informes'>$correo</a></td>"
                . "</tr>"
                . "<tr>"
                . "<td align=right><font color='#3299CC'>Consulta: <font></td>"
                . "<td>" . utf8_decode($comment) . "</td>"
                . "</tr>"
                . "</tr>"
                . "<tr>"
                . "<td align=right><font color='#3299CC'>Respuesta: <font></td>"
                . "<td>" . utf8_decode($resp) . "</td>"
                . "</tr>"
                . "</table>"
                . "<br><br>"
                . "Saludos."
                . "<br><br>"
                . utf8_decode("Klimacyalta")
                . "<br>"
                . "<a href='mailto:ventas@klimacyalta.com?subject=Informes'>ventas@klimacyalta.com</a>"
                . "<br>"
                . "<a href='http://www.klimacyalta.com'>www.klimacyalta.com</a>" . "<br><br>"
                . "<div style='background-color:blue;'>"
                . "</div>"
                . "</div></html>";
        $body.= "";
        $mail->Body = $body;
        if (!$mail->Send()) {
            ?><script>
                    alert("Problema al enviar el Correo!!!!");
                    window.location = 'MNTContactenos.php';
            </script><?php
        } else {
            ?><script>
                    alert("Correo enviado!!!!");
                    window.location = 'MNTContactenos.php';
            </script><?php
        }
        // Clear all addresses and attachments for next loop
        $mail->ClearAddresses();
    }
} catch (PDOException $exc) {?>
    <script>
        alert("Error al enviar correo!!!!");
        window.location = 'MNTContactenos.php';
    </script><?php
}
?>