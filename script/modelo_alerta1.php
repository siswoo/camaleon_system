<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '../resources/PHPMailer/PHPMailer/src/Exception.php';
	require '../resources/PHPMailer/PHPMailer/src/PHPMailer.php';
	require '../resources/PHPMailer/PHPMailer/src/SMTP.php';
	include('conexion.php');
	$id = $_POST['variable'];
	$modelo_cuenta_id = $_POST['modelo_cuenta_id'];
	$fecha_inicio = date('Y-m-d');

	$sql2 = "SELECT * FROM modelos WHERE id =".$id;
	$consulta1 = mysqli_query($conexion,$sql2);
	while($row1 = mysqli_fetch_array($consulta1)) {
		$correo = $row1['correo'];
		$sede = $row1['sede'];
	}

	$sql3 = "SELECT * FROM modelos_cuentas WHERE id =".$modelo_cuenta_id;
	$consulta2 = mysqli_query($conexion,$sql3);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$cuenta_usuario = $row2['usuario'];
		$cuenta_clave = $row2['clave'];
		$cuenta_correo = $row2['correo'];
		$cuenta_link = $row2['link'];
	}

	$html = '';

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
		    
		    $html.='
		    	<p style="text-align:center;">Datos Cuenta Creada</p>
		    	<p style="text-align:center;">Usuario: '.$cuenta_usuario.'</p>
		    	<p style="text-align:center;">Clave: '.$cuenta_clave.'</p>
		    ';

		    if($cuenta_correo!=''){
		    	$html.='
		    		<p style="text-align:center;">Correo: '.$cuenta_correo.'</p>
		    	';
		    }

		    if($cuenta_link!=''){
		    	$html.='
		    		<p style="text-align:center;">Link: '.$cuenta_link.'</p>
		    	';
		    }

		    $html .= "
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