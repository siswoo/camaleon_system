<?php
	$id 				= $_POST['edit_id'];
	$documento_tipo 	= $_POST['edit_documento_tipo'];
	$documento_numero 	= $_POST['edit_documento_numero'];
	$nombre 			= $_POST['edit_nombre'];
	$apellido 			= $_POST['edit_apellido'];
	$correo 			= $_POST['edit_correo'];
	$usuario2 			= $_POST['edit_usuario'];
	$telefono1 			= $_POST['edit_telefono1'];
	$telefono2 			= $_POST['edit_telefono2'];
	$sedes 				= $_POST['edit_sedes'];

	include('conexion.php');

	$sql1 = "UPDATE usuarios SET documento_tipo = '$documento_tipo', documento_numero = '$documento_numero', nombre = '$nombre', apellido = '$apellido',correo = '$correo', usuario = '$usuario2', telefono1 = '$telefono1',telefono2 = '$telefono2',sede = '$sedes' WHERE id = ".$id;
	$modificar1 = mysqli_query($conexion, $sql1);

	/*
	$sql2 = "UPDATE modelos SET documento_tipo = '$documento_tipo', documento_numero = '$documento_numero', nombre1 = '$nombre', apellido1 = '$apellido', correo = '$correo', telefono1 = '$telefono1', telefono2 = '$telefono2', usuario = '$usuario2' WHERE usuario_modelo = ".$id;
	$modificar2 = mysqli_query($conexion, $sql2);
	*/

	$datos = [
		"Sql1" => $sql1,
	];

	echo json_encode($datos);
?>