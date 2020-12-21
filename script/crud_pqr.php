<?php
include('conexion.php');
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');

if($condicion=='guardar'){
	$id_modelo 	= $_POST['id_modelo'];
	$mensaje 	= $_POST['mensaje'];
	$tema 		= $_POST['tema'];
	$area 		= 'Modelos';
	$sql1 = "INSERT INTO pqr (responsable,mensaje,tema,area,fecha_inicio) VALUES ('$id_modelo','$mensaje','$tema','$area','$fecha_inicio')";
	$consulta1 = mysqli_query($conexion,$sql1);
}

if($condicion=='asignar'){
	$id_pqr = $_POST['id_pqr'];
	$id_modelo 	= $_POST['id_modelo'];
	$rol_responsable 	= $_POST['value'];
	$sql1 = "UPDATE pqr SET rol_responsable = ".$rol_responsable." WHERE id = ".$id_pqr;
	$consulta1 = mysqli_query($conexion,$sql1);	
}

$datos = [
	"respuesta" => 'ok',
];

echo json_encode($datos);
?>