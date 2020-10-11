<?php
$nombre = $_POST['new_nombre'];
$fecha_inicio = date('Y-m-d');

include('conexion.php');

$sql1 = "INSERT INTO seguridad (nombre,fecha_inicio) VALUES ('$nombre','$fecha_inicio')";
$registro1 = mysqli_query( $conexion, $sql1 );

$datos = [
	"id" 		=> $sql1,
	"nombre" 	=> $nombre,
];

echo json_encode($datos);

?>