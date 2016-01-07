<html>
<head>
<title>PHPMailer - MySQL Database - SMTP basic test with authentication</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Lima');

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail                = new PHPMailer();

$body                = file_get_contents('contents.html');
$body                = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host          = "smtp.gmail.com";
$mail->SMTPAuth      = true;                  // enable SMTP authentication
//$mail->SMTPKeepAlive = true;                  // SMTP connection will not close after each email sent
$mail->SMTPSecure    = 'tls'; 
//$mail->Host          = "gmail.com"; // sets the SMTP server
$mail->Port          = 587;                    // set the SMTP port for the GMAIL server
$mail->Username      = "dponce@dezain.com.pe"; // SMTP account username
$mail->Password      = "dezain*100pre";        // SMTP account password
$mail->SetFrom('dponce@dezain.com.pe', 'List manager');
$mail->AddReplyTo('dponce@dezain.com.pe', 'List manager');

$mail->Subject       = "PHPMailer Test Subject via smtp, basic with authentication";

//@MYSQL_CONNECT("localhost","root","password");
//@mysql_select_db("my_company");
//$query  = "SELECT full_name, email, photo FROM employee WHERE id=$id";
//$result = @MYSQL_QUERY($query);

//while ($row = mysql_fetch_array ($result)) {
  $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
  $mail->MsgHTML($body);
  $mail->AddAddress("dponce@coopvaleunperu.com", "Dany Ponce Valeup");
  //$mail->AddStringAttachment($row["photo"], "YourPhoto.jpg");
  //$mail->AddAddress($row["email"], $row["full_name"]);
  //$mail->AddStringAttachment($row["photo"], "YourPhoto.jpg");

  if(!$mail->Send()) {
    //echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail->ErrorInfo . '<br />';
  } else {
    //echo "Message sent to :" . $row["full_name"] . ' (' . str_replace("@", "&#64;", $row["email"]) . ')<br />';
  }
  // Clear all addresses and attachments for next loop
  $mail->ClearAddresses();
  //$mail->ClearAttachments();
//}
?>

</body>
</html>
