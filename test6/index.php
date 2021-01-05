<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../resources/PHPMailer/PHPMailer/src/Exception.php';
require '../resources/PHPMailer/PHPMailer/src/PHPMailer.php';
require '../resources/PHPMailer/PHPMailer/src/SMTP.php';

// Load Composer's autoloader
//require '../vendor/autoload.php';

$correo = 'juanmaldonado.co@gmail.com';

$mail = new PHPMailer(true);
	try {
	    $mail->isSMTP();
	    $mail->Host = 'mail.camaleonmg.com';
	    $mail->SMTPAuth = true;
	    $mail->Port = 587;
	    $mail->SMTPSecure = 'tls';
	    //$mail->SMTPSecure = 'ssl';
	    $mail->Username = 'contactosmodelos@camaleonmg.com';
	    //$mail->Username = 'testemail@camaleonmg.com';
	    $mail->Password = 'juanmaldonado123';

	    $mail->setFrom('contactosmodelos@camaleonmg.com');
	    $mail->addAddress($correo);
	    /*
	    $mail->AddEmbeddedImage("../img/mailing bienvenida.png", "my-attach", "mailing bienvenida.png");
	    $html = "
	        <h2 style='color:#3F568A; text-align:center; font-family: Helvetica Neue,Helvetica,Arial,sans-serif;'>
	            <p>Felicitaciones, has realizado exitosamente el registro de ingreso.</p>
	            <p>Y debes continuar el proceso de vinculación en la familia CAMALEÓN.</p>
	        </h2>
	        <div style='text-align:center;'>
	        	<img alt='PHPMailer' src='cid:my-attach'>
	        </div>
	    ";
	    */

	    $html = 'Hi';

	    $mail->isHTML(true);
	    $mail->Subject = 'Camaleon Models!';
	    $mail->Body    = $html;
	    $mail->AltBody = 'Mensaje automatico del sistema';
	 
	    $mail->send();
	    
	    //echo 'El mensaje ha sido enviado';
    } catch (Exception $e) {
		echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
    }

/*
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.camaleonmg.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'contactosmodelos@camaleonmg.com';                     // SMTP username
    $mail->Password   = 'juanmaldonado123';                               // SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('contactosmodelos@camaleonmg.com');
    $mail->addAddress('juanmaldonado.co@gmail.com');     // Add a recipient
    $mail->addAddress('dajueblog@gmail.com');               // Name is optional
    $mail->addReplyTo('bigkadejj2@gmail.com');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Camaleon Models!';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'Mensaje automatico del sistema';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
*/