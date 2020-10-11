<?php
	$id = $_POST['edit_id'];
	$nombre = $_POST['edit_nombre'];
	$fecha_inicio = date('Y-m-d');

	include('conexion.php');

	$sql1 = "UPDATE seguridad SET nombre = '".$nombre."' WHERE id = ".$id;
	$registro1 = mysqli_query( $conexion, $sql1 );

	$datos = [
		"id" 		=> $id,
		"nombre" 	=> $nombre,
	];

	echo json_encode($datos);
?>