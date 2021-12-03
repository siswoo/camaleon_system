<?php
include('conexion.php');
$variable = $_POST['variable'];
$sql1 = "SELECT * FROM seguridad WHERE id = ".$variable;
$registro1 = mysqli_query( $conexion, $sql1 );

while($row = mysqli_fetch_array($registro1)) {
	$id = $row['id'];
	$nombre = $row['nombre'];
}

$datos = [
	"id" 				=> $id,
	"nombre" 			=> $nombre,
];

echo json_encode($datos);

?>