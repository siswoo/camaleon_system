<?php
include('conexion.php');
$variable = $_POST['variable'];
$sql1 = "SELECT * FROM sedes WHERE id = ".$variable;
$registro1 = mysqli_query( $conexion, $sql1 );

while($row = mysqli_fetch_array($registro1)) {
	$id					= $row['id'];
	$nombre				= $row['nombre'];
	$direccion 			= $row['direccion'];
	$ciudad 			= $row['ciudad'];
}

$datos = [
	"id" 				=> $id,
	"nombre" 			=> $nombre,
	"direccion" 		=> $direccion,
	"ciudad" 			=> $ciudad,
];

echo json_encode($datos);

?>