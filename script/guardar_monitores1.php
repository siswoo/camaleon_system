<?php
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$tipo_documento = $_POST['tipo_documento'];
	$numero_documento = $_POST['numero_documento'];
	$correo = $_POST['correo'];
	$usuario2 = $_POST['usuario'];
	$telefono1 = $_POST['telefono1'];
	$telefono2 = $_POST['telefono2'];
	$sede = $_POST['sede'];
	$rol = 6;
	$clave = md5($_POST['clave']);
	$fecha_inicio = date('Y-m-d');

	include('conexion.php');

	$sql1 = "INSERT INTO usuarios (nombre,apellido,documento_tipo,documento_numero,correo,usuario,clave,telefono1,telefono2,rol,sede,fecha_inicio) VALUES ('$nombre','$apellido','$tipo_documento','$numero_documento','$correo','$usuario2','$clave','$telefono1','$telefono2','$rol','$sede','$fecha_inicio')";
	$registro1 = mysqli_query($conexion, $sql1);

	$datos = [
		"Sql" 	=> $sql1,
		"resultado" => "ok",
	];

	echo json_encode($datos);
?>