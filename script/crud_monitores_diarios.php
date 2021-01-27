<?php
session_start();
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');

include('../script/conexion.php');

if($condicion == 'registro'){
	$monitor = $_POST['monitor_registro'];
	$fecha = $_POST['fecha_registro'];
	$tokens = $_POST['tokens_registro'];
	$sql1 = "INSERT INTO monitores_registro_diario (monitor,fecha,tokens,fecha_inicio) VALUES ('$monitor','$fecha','$tokens','$fecha_inicio')";
	$registro1 = mysqli_query($conexion, $sql1);

	$datos = [
		"resultado" => "ok",
	];

	echo json_encode($datos);

}

if($condicion == 'editar'){
	$id = $_POST['variable'];
	$sql1 = "SELECT * FROM monitores_registro_diario WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);
	while($row1 = mysqli_fetch_array($consulta1)) {
		$monitor = $row1['monitor'];
		$fecha = $row1['fecha'];
		$tokens = $row1['tokens'];
		$fecha_inicio = $row1['fecha_inicio'];
	}

	$datos = [
		"id" => $id,
		"monitor" => $monitor,
		"fecha" => $fecha,
		"tokens" => $tokens,
		"fecha_inicio" => $fecha_inicio,
	];

	echo json_encode($datos);
}

if($condicion == 'actualizar'){
	$id = $_POST['id'];
	$monitor = $_POST['monitor'];
	$fecha = $_POST['fecha'];
	$tokens = $_POST['tokens'];
	$sql1 = "UPDATE monitores_registro_diario SET monitor = '$monitor', fecha = '$fecha', tokens = '$tokens' WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
	];

	echo json_encode($datos);
}

if($condicion == 'eliminar'){
	$id = $_POST['variable'];
	$sql1 = "DELETE FROM monitores_registro_diario WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
	];

	echo json_encode($datos);
}


?>