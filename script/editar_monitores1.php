<?php
	$id = $_POST['edit_id'];
	$nombre = $_POST['edit_nombre'];
	$apellido = $_POST['edit_apellido'];
	$tipo_documento = $_POST['edit_tipo_documento'];
	$numero_documento = $_POST['edit_numero_documento'];
	$correo = $_POST['edit_correo'];
	$telefono1 = $_POST['edit_telefono1'];
	$telefono2 = $_POST['edit_telefono2'];
	//$rol = $_POST['edit_rol'];
	$sede = $_POST['edit_sede'];


	include('conexion.php');

	$sql1 = "UPDATE usuarios SET nombre = '".$nombre."', apellido = '".$apellido."', documento_tipo = '".$tipo_documento."', documento_numero = '".$numero_documento."', correo = '".$correo."', telefono1 = '".$telefono1."', telefono2 = '".$telefono2."', sede = ".$sede." WHERE id = ".$id;
	$registro1 = mysqli_query( $conexion, $sql1 );

	$datos = [
		"id" 				=> $id,
		"nombre" 			=> $nombre,
		"apellido" 			=> $apellido,
		"tipo_documento" 	=> $tipo_documento,
		"numero_documento" 	=> $numero_documento,
		"correo" 			=> $correo,
		"telefono1" 		=> $telefono1,
		"telefono2" 		=> $telefono2,
		"sede" 				=> $sede,
	];

	echo json_encode($datos);
?>