<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '../resources/PHPMailer/PHPMailer/src/Exception.php';
	require '../resources/PHPMailer/PHPMailer/src/PHPMailer.php';
	require '../resources/PHPMailer/PHPMailer/src/SMTP.php';
	include('conexion.php');
	$id = $_POST['variable'];
	$fecha_inicio = date('Y-m-d');

	$sql2 = "SELECT * FROM modelos WHERE id =".$id;
	$consulta1 = mysqli_query($conexion,$sql2);
	while($row1 = mysqli_fetch_array($consulta1)) {
		$correo = $row1['correo'];
		$sede = $row1['sede'];
	}

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
		    $mail->AddEmbeddedImage("../img/alerta_recordatorio_cuenta.png", "my-attach", "alerta_recordatorio_cuenta.png");
		    $html = "
		        <h2 style='color:#3F568A; text-align:center; font-family: Helvetica Neue,Helvetica,Arial,sans-serif;'>
		            <p>Recuerda que tienes una cuenta habilitada que no has estrenado</p>
		            <p>Si tienes alguna duda, consultar con tu monitor de confianza.</p>
		        </h2>
		        <div style='text-align:center;'>
		        	<img alt='PHPMailer' src='cid:my-attach'>
		        </div>
		    ";

		    $mail->isHTML(true);
		    $mail->Subject = 'Camaleon Models!';
		    $mail->Body    = $html;
		    $mail->AltBody = 'Alerta!, Recordatorio';
		 
		    $mail->send();

	    } catch (Exception $e) {}

	$datos = [
		"resultado" => "ok",
	];

	echo json_encode($datos);
?>