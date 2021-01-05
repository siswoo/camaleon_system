<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../resources/PHPMailer/PHPMailer/src/Exception.php';
require '../resources/PHPMailer/PHPMailer/src/PHPMailer.php';
require '../resources/PHPMailer/PHPMailer/src/SMTP.php';

$tipo_documento 	= $_POST['tipo_documento'];
$numero_documento 	= $_POST['numero_documento'];
$primer_nombre 		= $_POST['primer_nombre'];
$segundo_nombre 	= $_POST['segundo_nombre'];
$primer_apellido 	= $_POST['primer_apellido'];
$segundo_apellido 	= $_POST['segundo_apellido'];
$genero 			= $_POST['genero'];
$correo 			= $_POST['correo'];
$telefono1 			= $_POST['telefono1'];
$barrio 			= $_POST['barrio'];
$direccion 			= $_POST['direccion'];
$sede 				= $_POST['sede'];
$enterado 			= $_POST['enterado'];
$fecha_inicio 		= date('Y-m-d');

include('conexion.php');

/******************VALIDACION DE REPETIDOS*******************/
	$Vsql1 = "SELECT * FROM pasantes WHERE tipo_documento = '".$tipo_documento."' and numero_documento = '".$numero_documento."' LIMIT 1";
	$Vconsulta1 = mysqli_query( $conexion, $Vsql1 );
	$Vcontador1 = mysqli_num_rows($Vconsulta1);
	if($Vcontador1>=1){
		$datos = [
			"Sql" 	=> $Vsql1,
			"contador" => $Vcontador1,
		];

		echo json_encode($datos);
		exit;
	}
/************************************************************/

	$sql1 = "INSERT INTO pasantes (tipo_documento,numero_documento,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,genero,d,telefono1,barrio,direccion,fecha_inicio,sede,enterado) VALUES ('$tipo_documento','$numero_documento','$primer_nombre','$segundo_nombre','$primer_apellido','$segundo_apellido','$genero','$correo','$telefono1','$barrio','$direccion','$fecha_inicio','$sede','$enterado')";
	$registro1 = mysqli_query( $conexion, $sql1 );

	$datos = [
		"Sql" 	=> $sql1,
		"resultado" => "ok",
		"contador" => 0,
	];

	$mail = new PHPMailer(true);
	try {
	    $mail->isSMTP();
	    $mail->Host = 'mail.camaleonmg.com';
	    $mail->SMTPAuth = true;
	    $mail->Username = 'contactosmodelos@camaleonmg.com';
	    $mail->Password = 'juanmaldonado123';
	    $mail->SMTPSecure = 'tls';
	    $mail->Port = 587;

	    $mail->setFrom('contactosmodelos@camaleonmg.com');
	    $mail->addAddress($correo);
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

	    $mail->isHTML(true);
	    $mail->Subject = 'Camaleon Models!';
	    $mail->Body    = $html;
	    $mail->AltBody = 'Mensaje automatico del sistema';
	 
	    $mail->send();
	    
	    //echo 'El mensaje ha sido enviado';
    } catch (Exception $e) {
		//echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
    }

	echo json_encode($datos);
?>