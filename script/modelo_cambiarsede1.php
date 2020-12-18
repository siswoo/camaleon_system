<?php
session_start();
include('conexion.php');

$id_sede = $_POST['sede'];
$id_modelo = $_POST['modelo'];

$sql1 = "UPDATE modelos SET sede = ".$id_sede." WHERE id = ".$id_modelo;
$registro1 = mysqli_query($conexion,$sql1);

$sql2 = "SELECT * FROM sedes WHERE id = ".$id_sede;
$registro2 = mysqli_query($conexion,$sql2);
while($row1 = mysqli_fetch_array($registro2)) {
	$nombre_sede = $row1['nombre'];
}

$datos = [
	"estatus"	=> 'correcto',
	"sede"		=> $nombre_sede,
];

echo json_encode($datos);

?>