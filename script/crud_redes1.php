<?php
session_start();	
include('conexion.php');
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];

if($condicion=='guardar'){
	$add_redes1 	= $_POST['add_redes1'];
	$add_link_red1 	= $_POST['add_link_red1'];
	$id_modelo 		= $_POST['id_modelo'];
	$sql1 = "INSERT INTO redes_sociales (id_modelo,link,red,responsable,fecha_inicio) VALUES ('$id_modelo','$add_link_red1','$add_redes1','$responsable','$fecha_inicio')";
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"respuesta" => 'ok',
	];

	echo json_encode($datos);
}

if($condicion=='eliminar'){
	$id_modelo 	= $_POST['id_modelo'];
	$add_redes1 	= $_POST['add_redes1'];
	$sql1 = "DELETE FROM redes_sociales WHERE id_modelo = ".$id_modelo." and red = '".$add_redes1."'";
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"respuesta" => 'ok',
	];

	echo json_encode($datos);
}

?>