<?php
	$nombre = $_POST['nombre'];
	$ciudad = $_POST['ciudad'];
	$direccion = $_POST['direccion'];

	$fecha_inicio = date('Y-m-d');

	include('conexion.php');

	$sql1 = "INSERT INTO sedes (nombre,ciudad,direccion) VALUES ('$nombre','$ciudad','$direccion')";
	$registro1 = mysqli_query($conexion, $sql1);

	$datos = [
		"Sql" 	=> $sql1,
		"resultado" => "ok",
	];

	echo json_encode($datos);
?>