<?php
$id = $_POST['variable'];

include('conexion.php');

$sql1 = "DELETE FROM seguridad WHERE id = ".$id;
$registro1 = mysqli_query( $conexion, $sql1 );

$datos = [
	"id" 		=> $sql1,
	"variable" 	=> $id,
];

echo json_encode($datos);

?>