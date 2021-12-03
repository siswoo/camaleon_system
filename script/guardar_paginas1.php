<?php
	$nombre = $_POST['nombre'];
	$tasa = $_POST['tasa'];
	$url = $_POST['url'];
	$moneda = $_POST['moneda'];

	include('conexion.php');

	$sql1 = "INSERT INTO paginas (nombre,tasa,url,moneda) VALUES ('$nombre','$tasa','$url','$moneda')";
	$registro1 = mysqli_query($conexion, $sql1);

	$datos = [
		"Sql" 	=> $sql1,
		"resultado" => "ok",
	];

	echo json_encode($datos);
?>