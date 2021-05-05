<?php
session_start();	
include('conexion.php');
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];

if($condicion=='guardar1'){
	$valor 	= $_POST['valor'];
	$select = $_POST['select'];

	$sql2 = "SELECT * FROM presabana WHERE id = ".$select;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$inicio = $row2["inicio"];
		$fin = $row2["fin"];
	}

	$sql1 = "INSERT INTO trm1 (valor,inicio,fin,fecha_inicio) VALUES ('$valor','$inicio','$fin','$fecha_inicio')";
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"respuesta" => 'ok',
	];

	echo json_encode($datos);
}

if($condicion=='eliminar1'){
	$id = $_POST['id'];
	$sql1 = "DELETE FROM trm1 WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"respuesta" => 'ok',
	];

	echo json_encode($datos);
}
?>