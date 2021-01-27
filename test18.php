<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'resources/PHPMailer/PHPMailer/src/Exception.php';
require 'resources/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'resources/PHPMailer/PHPMailer/src/SMTP.php';

$email = 'juanmaldonado.co@gmail.com';

$mail = new PHPMailer(true);
try {
	$mail->isSMTP();
	$mail->Host = 'mail.camaleonmg.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'contactosmodelos@camaleonmg.com';
	$mail->Password = 'juanmaldonado123';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 465;

	$mail->setFrom('contactosmodelos@camaleonmg.com');
	$mail->addAddress($email);
	$html = "Hola de prueba";

	    $mail->isHTML(true);
	    $mail->Subject = 'Camaleon Models!';
	    $mail->Body    = $html;
	    $mail->AltBody = 'Mensaje automatico del sistema';
	 	
	    $mail->send();
	    
	    //echo 'El mensaje ha sido enviado';
    } catch (Exception $e) {
		echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
    }

?>