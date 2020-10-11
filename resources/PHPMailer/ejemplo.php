<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
 
$mail = new PHPMailer(true);
try {
    //$mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
    $mail->isSMTP();
    $mail->Host = 'mail.camaleonmg.com';  // Host de conexión SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'info@camaleonmg.com';                 // Usuario SMTP
    $mail->Password = 'juanmaldonado123';                           // Password SMTP
    $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
    $mail->Port = 587;                                    // Puerto SMTP

    #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
    #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
    #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
 
    $mail->setFrom('info@camaleonmg.com');		// Mail del remitente
    $mail->addAddress('juanmaldonado.co@gmail.com');     // Mail del destinatario
    $mail->AddEmbeddedImage("mailing bienvenida.png", "my-attach", "mailing bienvenida.png");
    //$mail->Body = 'Embedded Image: <img alt="PHPMailer" src="cid:my-attach"> Here is an image!';
    $html = "
        <h2 style='color:#3F568A;'>
            <p>Felicitaciones, has realizado exitosamente el registro de ingreso.</p>
            <p>Y debes continuar el proceso de vinculación en la familia CAMALEÓN.</p>
        </h2>
        <img alt='PHPMailer' src='cid:my-attach'>
    ";

    $mail->isHTML(true);
    $mail->Subject = 'Pre-ingreso al equipo!';  // Asunto del mensaje
    //$mail->Body    = 'Este es el contenido del mensaje <b>en negrita!</b>';    // Contenido del mensaje (acepta HTML)
    $mail->Body    = $html;
    $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)
 
    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}
