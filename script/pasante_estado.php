<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

	$id 			= $_POST['variable'];
	$condicional 	= $_POST['condicional'];
	$fecha_inicio = date('Y-m-d');

	include('conexion.php');

	$sql1 = "UPDATE pasantes SET estatus = '$condicional' WHERE id = ".$id;
	$registro1 = mysqli_query( $conexion, $sql1 );

	$sql3 = "SELECT * FROM pasantes WHERE id = ".$id;
	$consultar1 = mysqli_query( $conexion, $sql3 );
	while($row = mysqli_fetch_array($consultar1)) {
		$tipo_documento = $row['tipo_documento'];
		$numero_documento = $row['numero_documento'];
		$primer_nombre = $row['primer_nombre'];
		$segundo_nombre = $row['segundo_nombre'];
		$primer_apellido = $row['primer_apellido'];
		$segundo_apellido = $row['segundo_apellido'];
		$genero = $row['genero'];
		$correo = $row['correo'];
		$telefono1 = $row['telefono1'];
		$barrio = $row['barrio'];
		$sede = $row['sede'];
		$direccion = $row['direccion'];
	}

	if($condicional=='Aceptada'){

		/******************VALIDACION DE REPETIDOS*******************/
		$Vsql1 = "SELECT * FROM modelos WHERE documento_tipo = '".$tipo_documento."' and documento_numero = '".$numero_documento."' LIMIT 1";
		$Vconsulta1 = mysqli_query( $conexion, $Vsql1 );
		$Vcontador1 = mysqli_num_rows($Vconsulta1);
		if($Vcontador1>=1){
			$Vsql2 = "UPDATE modelos SET estatus = 'Activa' WHERE documento_tipo = '".$tipo_documento."' and documento_numero = '".$numero_documento."'";
			$Vmodificar1 = mysqli_query( $conexion, $Vsql2 );
			$datos = [
				"respuesta" => 'no',
			];

			echo json_encode($datos);
			exit;
		}
		/************************************************************/
		
		$sql2 = "INSERT INTO modelos (documento_tipo, documento_numero, nombre1, nombre2, apellido1, apellido2, genero, correo, telefono1, barrio, direccion, fecha_inicio, sede) VALUES ('$tipo_documento','$numero_documento','$primer_nombre','$segundo_nombre','$primer_apellido','$segundo_apellido','$genero','$correo','$telefono1','$barrio','$direccion','$fecha_inicio','$sede')";
		$registro2 = mysqli_query($conexion,$sql2);

		$id_modelo = mysqli_insert_id($conexion);
		$usuario = $primer_nombre.$id_modelo;
		$clave_generica = rand(999, 9999);
		$clave = md5($clave_generica);

		$sql4 = "UPDATE modelos SET usuario = '$usuario', clave = '$clave' WHERE id = ".$id_modelo;
		$registro3 = mysqli_query($conexion,$sql4);

		$sql5 = "INSERT INTO usuarios (nombre,apellido,documento_tipo,documento_numero,correo,usuario,clave,telefono1,rol,sede,fecha_inicio) VALUES ('$primer_nombre','$primer_apellido','$tipo_documento','$numero_documento','$correo','$usuario','$clave','$telefono1','5','$sede','$fecha_inicio')";
		$registro4 = mysqli_query($conexion,$sql5);

		$id_usuario = mysqli_insert_id($conexion);
		
		$sql6 = "UPDATE modelos SET usuario_modelo = '$id_usuario' WHERE id = ".$id_modelo;
		$registro5 = mysqli_query($conexion,$sql6);

		/***************APARTADO DE CORREO*****************/
		require '../resources/PHPMailer/PHPMailer/src/Exception.php';
		require '../resources/PHPMailer/PHPMailer/src/PHPMailer.php';
		require '../resources/PHPMailer/PHPMailer/src/SMTP.php';

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
		    $mail->addAddress($correo);
		    $mail->AddEmbeddedImage("../img/mailing modelo1.png", "my-attach", "mailing modelo1.png");
		    $html = "
		        <h2 style='color:#3F568A; text-align:center; font-family: Helvetica Neue,Helvetica,Arial,sans-serif;'>
		            <p>Felicitaciones tu perfil ha sido aprobado para formar parte de la familia Camaleón!.</p>
		            <p>El siguiente paso es completar tu formulario de contacto, puedes ingresar al sistema con los siguientes datos.</p>
		            <p>Usuario: ".$usuario." | Clave: ".$clave_generica." </p>
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
	}else{
		$sql2 = "UPDATE modelos SET estatus = 'Inactiva' WHERE documento_tipo = '".$tipo_documento."' and documento_numero = '".$numero_documento."'";
		$modificar1 = mysqli_query( $conexion, $sql2 );

		$sql2 = "UPDATE usuarios SET clave = '5f4dcc3b5aa765d61d8327deb882cf99' WHERE documento_tipo = '".$tipo_documento."' and documento_numero = '".$numero_documento."'";
		$modificar1 = mysqli_query( $conexion, $sql2 );
	}

	$datos = [
		"respuesta" => $sql2,
	];

	echo json_encode($datos);
?>