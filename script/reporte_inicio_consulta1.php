<?php
session_start();
include('conexion.php');
$responsable = $_POST['responsable'];
$turno = $_POST['turno'];
$fecha = $_POST['hidden_fecha'];

$condicional1 = 'nada';

$sql1="SELECT * FROM reporte_inicio WHERE responsable = '".$responsable."' and turno = '".$turno."' and fecha_inicio = '".$fecha."' and sede = ".$_SESSION['sede']." LIMIT 1";
$consulta1 = mysqli_query($conexion,$sql1);
$fila1 = mysqli_num_rows($consulta1);
$contador1 = 1;

while($row1 = mysqli_fetch_array($consulta1)) {
	$reporteM_id = $row1['id'];
}

if($fila1>=1){
	$sql2 = "SELECT * FROM reporte_inicio_filas WHERE id_reporte_inicio = ".$reporteM_id." ORDER BY id_room";
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$fila_estatus[$contador1] = $row2['estatus'];
		$asunto[$contador1] = $row2['asunto'];
		$id_room[$contador1] = $row2['id_room'];
		$id_modelo[$contador1] = $row2['id_modelo'];
		$id_monitor[$contador1] = $row2['id_monitor'];

		$sql3 = "SELECT * FROM rooms WHERE id = ".$id_room[$contador1];
		$consulta3 = mysqli_query($conexion,$sql3);
		while($row3 = mysqli_fetch_array($consulta3)) {
			$room_nombre[$contador1] = $row3['nombre'];
		}

		$sql4 = "SELECT * FROM modelos_temporal WHERE id = ".$id_modelo[$contador1];
		$consulta4 = mysqli_query($conexion,$sql4);
		while($row4 = mysqli_fetch_array($consulta4)) {
			$modelo_nombre[$contador1] = $row4['nombre'];
		}

		$contador1 = $contador1 +1;
	}
}

$datos = [
	"fila_estatus" 	=> $fila_estatus,
	"asunto" 		=> $asunto,
	"room_nombre" 	=> $room_nombre,
	"contador1" 	=> $contador1,
];

echo json_encode($datos);

?>