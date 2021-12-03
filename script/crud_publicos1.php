<?php
session_start();	
include('conexion.php');
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];

if($condicion=='publico'){
	$id_modelo 		= $_POST['id_modelo'];
	$sql1 = "DELETE FROM publicas WHERE id_modelo = ".$id_modelo;
	$consulta1 = mysqli_query($conexion,$sql1);
	$sql2 = "INSERT INTO publicas (id_modelo,responsable,fecha_inicio) VALUES ('$id_modelo','$responsable','$fecha_inicio')";
	$consulta2 = mysqli_query($conexion,$sql2);

	$datos = [
		"respuesta" => 'ok',
	];

	echo json_encode($datos);
}

if($condicion=='privado'){
	$id_modelo 	= $_POST['id_modelo'];
	$sql1 = "DELETE FROM publicas WHERE id_modelo = ".$id_modelo;
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"respuesta" => 'ok',
	];

	echo json_encode($datos);
}

?>