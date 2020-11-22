<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '../resources/PHPMailer/PHPMailer/src/Exception.php';
	require '../resources/PHPMailer/PHPMailer/src/PHPMailer.php';
	require '../resources/PHPMailer/PHPMailer/src/SMTP.php';
	include('conexion.php');
	$id_modelo = $_POST['id'];
	$fecha_inicio = date('Y-m-d');

	$sql2 = "SELECT * FROM modelos WHERE id =".$id_modelo;
	$consulta1 = mysqli_query($conexion,$sql2);
	while($row1 = mysqli_fetch_array($consulta1)) {
		$usuario_modelo = $row1['usuario_modelo'];
		$correo_modelo = $row1['correo'];
	}

	$clave_generada = rand(999, 9999);
	$clave = md5($clave_generada);

	$sql4 = "SELECT * FROM usuarios WHERE id =".$usuario_modelo;
	$consulta3 = mysqli_query($conexion,$sql4);
	while($row1 = mysqli_fetch_array($consulta3)) {
		$usuario_modelo_nombre = $row1['usuario'];
	}

	$sql3 = "UPDATE usuarios SET clave = '$clave' WHERE id =".$usuario_modelo;
	$consulta2 = mysqli_query($conexion,$sql3);
	
	$html = '';

		/***************APARTADO DE CORREO*****************/
		$mail = new PHPMailer(true);
		try {
		    $mail->isSMTP();
		    $mail->CharSet = "UTF-8";
		    $mail->Host = 'mail.camaleonmg.com';
		    $mail->SMTPAuth = true;
		    $mail->Username = 'contactosmodelos@camaleonmg.com';
		    $mail->Password = 'juanmaldonado123';
		    $mail->SMTPSecure = 'tls';
		    $mail->Port = 587;

		    $mail->setFrom('contactosmodelos@camaleonmg.com');
		    //$mail->addAddress($correo_modelo);
		    $mail->addAddress($correo_modelo);
		    $mail->AddEmbeddedImage("../img/mailing modelo1.png", "my-attach", "mailing modelo1.png");
		    $html = "
		        <h2 style='color:#3F568A; text-align:center; font-family: Helvetica Neue,Helvetica,Arial,sans-serif;'>
		            <p>Felicitaciones tu perfil ha sido aprobado para formar parte de la familia Camaleón!.</p>
		            <p>El siguiente paso es completar tu formulario de contacto, puedes ingresar al sistema con los siguientes datos.</p>
		            <p>Usuario: ".$usuario_modelo_nombre." | Clave: ".$clave_generada." </p>
		            <p>En el link.. https://www.camaleonmg.com</p>
		        </h2>
		        <div style='text-align:center;'>
		        	<img alt='PHPMailer' src='cid:my-attach'>
		        </div>
		    ";

		    $mail->isHTML(true);
		    $mail->Subject = 'Aprobacion Camaleon!';
		    $mail->Body    = $html;
		    $mail->AltBody = 'Este es el contenido del mensaje en texto plano';
		 
		    $mail->send();
		} catch (Exception $e) {}
		/**************************************************/

	$datos = [
		"resultado" => "ok",
	];

	echo json_encode($datos);
?>