<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/src/Exception.php';
require 'mail/src/PHPMailer.php';
require 'mail/src/SMTP.php';

$mail = new PHPMailer(true); 

// Passing `true` enables exceptions
$datos = array();
if (!isset($_POST['name']) || $_POST['name'] == "") {
    $datos['mensaje'] = "error";
    echo json_encode($datos);
} else {


try {
    //Server settings
    $mail->SMTPDebug = 0;                                   // Enable verbose debug output
    $mail->isSMTP();                                        // Set mailer to use SMTP
    $mail->CharSet = 'UTF-8';
    $mail->Host = 'smtp.dreamhost.com';                         // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
    $mail->Username = 'contacto@bourgeoiscompany.com.ar';    // SMTP username
    $mail->Password = 'bougal20194';                           // SMTP password
    $mail->SetFrom('contacto@bourgeoiscompany.com.ar','Bourgeois Company');
    $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                      // TCP port to connect to

    //Recipients
    $mail->addAddress('emabourgeois@live.com', 'Ema');     // Add a recipient

    //Attachments
    //$mail->AddAttachment($_FILES['attachFile']['tmp_name'],$_FILES['attachFile']['name']); 

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Nueva mensaje desde la web';
    $mail->Body     = 'Nuevo contacto desde bourgeoiscompany.com.ar<br><br>';
    $mail->Body    .='<b>Nombre:</b> ' . $_POST['name'] . '<br>';
    $mail->Body    .= '<b>Email:</b> ' . $_POST['email'].'<br>';
    $mail->Body    .= '<b>Tel&eacute;fono:</b> ' . $_POST['phone'].'<br>';
    $mail->Body    .= '<b>Mensaje:</b><br>' . $_POST['message'].'<br>';

    $mail->send();

    $datos['mensaje'] = "ok";

    echo json_encode($datos);
    
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}