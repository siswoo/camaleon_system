<?php
$id = $_POST['variable'];

include('conexion.php');

$sql1 = "DELETE FROM reporte_inicio WHERE id = ".$id;
$eliminar1 = mysqli_query($conexion,$sql1);

$sql2 = "DELETE FROM reporte_inicio_filas WHERE id_reporte_inicio = ".$id;
$eliminar2 = mysqli_query($conexion,$sql2);

$datos = [
	"sql1" 	=> $sql1,
	"sql2" 	=> $sql2,
	"id" 	=> $id,
];

echo json_encode($datos);
?>