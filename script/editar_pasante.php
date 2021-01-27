<?php
	$id 				= $_POST['edit_id'];
	$tipo_documento 	= $_POST['edit_tipo_documento'];
	$numero_documento 	= $_POST['edit_numero_documento'];
	$primer_nombre 		= $_POST['edit_primer_nombre'];
	$segundo_nombre 	= $_POST['edit_segundo_nombre'];
	$primer_apellido 	= $_POST['edit_primer_apellido'];
	$segundo_apellido 	= $_POST['edit_segundo_apellido'];
	$genero 			= $_POST['edit_genero'];
	$correo 			= $_POST['edit_correo'];
	$telefono1 			= $_POST['edit_telefono1'];
	$barrio 			= $_POST['edit_barrio'];
	$direccion 			= $_POST['edit_direccion'];
	$sede 				= $_POST['edit_sede'];
	$fecha_inicio 		= date('Y-m-d');

	include('conexion.php');

	$sql1 = "UPDATE pasantes SET tipo_documento = '$tipo_documento', numero_documento = '$numero_documento', primer_nombre = '$primer_nombre', segundo_nombre = '$segundo_nombre',primer_apellido = '$primer_apellido', segundo_apellido = '$segundo_apellido', genero = '$genero',correo = '$correo', telefono1 = '$telefono1', barrio = '$barrio', direccion = '$direccion', sede = '$sede' WHERE id = ".$id;
	$registro1 = mysqli_query( $conexion, $sql1 );

	$datos = [
		"Sql"		=> $sql1,
	];

	echo json_encode($datos);
?>