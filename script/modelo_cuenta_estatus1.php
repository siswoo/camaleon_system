<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '../resources/PHPMailer/PHPMailer/src/Exception.php';
	require '../resources/PHPMailer/PHPMailer/src/PHPMailer.php';
	require '../resources/PHPMailer/PHPMailer/src/SMTP.php';
	include('conexion.php');
	$estatus = $_POST['estatus'];
	$pagina = $_POST['pagina'];
	$id = $_POST['id'];
	$pagina_id = $_POST['pagina_id'];
	$modelo_cuenta_id = $_POST['modelo_cuenta_id'];
	$fecha_inicio = date('Y-m-d');

	$sql2 = "SELECT * FROM modelos WHERE id =".$id;
	$consulta1 = mysqli_query($conexion,$sql2);
	while($row1 = mysqli_fetch_array($consulta1)) {
		$correo = $row1['correo'];
		$sede = $row1['sede'];
	}

	$sql3 = "SELECT * FROM usuarios WHERE rol = 7 and sede =".$sede;
	$consulta2 = mysqli_query($conexion,$sql3);
	$fila1 = mysqli_num_rows($consulta2);

	if($fila1>=1 and $estatus!='Rechazada'){
		$asunto = 'Validar Nueva Cuenta de Modelo';
		$sql4 = "INSERT INTO tarea_jefe_monitores (id_modelo,asunto,sede,fecha_inicio) VALUES ('$id','$asunto','$sede','$fecha_inicio')";
		$registro2 = mysqli_query($conexion,$sql4);
	}

	$sql1 = "UPDATE modelos_cuentas SET estatus = '$estatus' WHERE id = ".$modelo_cuenta_id;
	$modificar1 = mysqli_query($conexion,$sql1);

	if($estatus=='Aprobada'){

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
		    $mail->AddEmbeddedImage("../img/alerta_habilitada.png", "my-attach", "alerta_habilitada.png");
		    $html = "
		        <h2 style='color:#3F568A; text-align:center; font-family: Helvetica Neue,Helvetica,Arial,sans-serif;'>
		            <p>Tu cuenta en la página de ".$pagina."</p>
		            <p>Si tienes alguna duda, consultar con tu monitor de confianza.</p>
		        </h2>
		        <div style='text-align:center;'>
		        	<img alt='PHPMailer' src='cid:my-attach'>
		        </div>
		    ";

		    $mail->isHTML(true);
		    $mail->Subject = 'Camaleon Models!';
		    $mail->Body    = $html;
		    $mail->AltBody = 'Cuenta Aprobada!';
		 
		    $mail->send();

	    } catch (Exception $e) {}
	}

	$datos = [
		"resultado" => "ok",
	];

	echo json_encode($datos);
?>