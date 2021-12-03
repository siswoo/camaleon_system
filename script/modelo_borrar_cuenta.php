<?php
$id = $_POST['modelo_cuenta_id'];

include('conexion.php');

$sql1 = "DELETE FROM modelos_cuentas WHERE id = ".$id;
$registro1 = mysqli_query( $conexion, $sql1 );

$datos = [
	"id" 		=> $sql1,
];

echo json_encode($datos);

?>