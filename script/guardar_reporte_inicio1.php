<?php
session_start();
include('conexion.php');
$sql1="SELECT * FROM rooms WHERE sede = ".$_SESSION['sede'];
$consulta1 = mysqli_query($conexion,$sql1);
$fila1 = mysqli_num_rows($consulta1);
$contador1 = 1;

while($row1 = mysqli_fetch_array($consulta1)) {
	$room_id = $row1['id'];
	$room_nombre = $row1['nombre'];
	//$room_color = $row1['color'];
	$contador1 = $contador1 + 1;
}



$datos = [
	"Sql" 	=> $sql1,
];

echo json_encode($datos);

?>