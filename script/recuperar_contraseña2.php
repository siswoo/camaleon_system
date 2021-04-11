<?php
include('conexion.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../resources/PHPMailer/PHPMailer/src/Exception.php';
require '../resources/PHPMailer/PHPMailer/src/PHPMailer.php';
require '../resources/PHPMailer/PHPMailer/src/SMTP.php';
$usuario = $_POST['usuario'];
$fecha_inicio = date('Y-m-d');


$caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$longitud = 12;
$codigo = substr(str_shuffle($caracteres_permitidos), 0, $longitud);

$sql1 = "SELECT * FROM usuarios WHERE (usuario = '".$usuario."' or correo = '".$usuario."') and rol = 5";
$consulta1 = mysqli_query($conexion,$sql1);
$contador1 = mysqli_num_rows($consulta1);

if($contador1>=1){
	while($row1 = mysqli_fetch_array($consulta1)) {
		$id = $row1['id'];
		$documento_numero = $row1['documento_numero'];
	}
	$clave_nueva = md5($documento_numero);
	$sql2 = "UPDATE usuarios SET clave = '".$clave_nueva."' WHERE id = ".$id;
	$consulta2 = mysqli_query($conexion,$sql2);
	
	$datos = [
		"sql" => $sql2,
		"contador" => $contador1,
	];

	echo json_encode($datos);
}else{
	$datos = [
		"sql" => $sql1,
		"contador" => $contador1,
	];

	echo json_encode($datos);
}

/*
if($contador1>=1){
	while($row1 = mysqli_fetch_array($consulta1)) {
		$correo = $row1['correo'];
		$responsable = $row1['id'];
	}

	$sql2 = "INSERT INTO recuperar_password (responsable,codigo,verificado,fecha_inicio) VALUES ('$responsable','$codigo',0,'$fecha_inicio')";
	$consulta2 = mysqli_query($conexion,$sql2);

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
		    
		    $html.='
		    	<p style="text-align:center;">Proceso de Recordar Cuenta</p>
		    	<p style="text-align:center;">Ingresar al siguiente link de verificación</p>
		    	<p style="text-align:center;">https://www.camaleonmg.com/recuperar_contraseña3.php?key='.$codigo.'</p>
		    ';

		    $mail->isHTML(true);
		    $mail->Subject = 'Camaleon Models!';
		    $mail->Body    = $html;
		    $mail->AltBody = 'Recuperar Cuenta';
		 
		    $mail->send();

	    } catch (Exception $e) {}
}
*/
?>