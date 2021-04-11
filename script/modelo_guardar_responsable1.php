<?php
$modelo_id = $_POST['id_modelo'];
$responsable = $_POST['id_responsable'];
$fecha_inicio = date('Y-m-d H:i:s');

include('conexion.php');

$sql2 = "SELECT * FROM soporte_responsable_modelo WHERE id_modelo =".$modelo_id;
$consulta1 = mysqli_query($conexion,$sql2);
$contador1 = mysqli_num_rows($consulta1);

if($contador1>=1 or $responsable==''){
	$sql1 = "DELETE FROM soporte_responsable_modelo WHERE id_modelo = ".$modelo_id;
	$eliminar1 = mysqli_query($conexion,$sql1);
}

if($responsable!=''){
	$sql3 = "INSERT INTO soporte_responsable_modelo (id_modelo,id_soporte,fecha_inicio) VALUES ($modelo_id,$responsable,'$fecha_inicio')";
	$registro1 = mysqli_query($conexion,$sql3);
}

$datos = [
	"sql1" => $sql1,
	"sql3" => $sql3,
	"status" => 'ok',
];

echo json_encode($datos);








/*
$modelo_id = $_POST['variable'];
$responsable = $_POST['responsable'];
//$fecha_inicio = date('Y-m-d');
$fecha_inicio = date('Y-m-d H:i:s');

include('conexion.php');

$sql2 = "SELECT * FROM soporte_responsable_modelo WHERE id_modelo =".$modelo_id." and id_soporte = ".$responsable;
$consulta1 = mysqli_query($conexion,$sql2);
$contador1 = mysqli_num_rows($consulta1);

if($contador1>=1){
	$datos = [
		"resultado" => 'error',
	];
}else{
	$sql1 = "INSERT INTO soporte_responsable_modelo (id_modelo,id_soporte,fecha_inicio) VALUES ($modelo_id,$responsable,'$fecha_inicio')";
	$registro1 = mysqli_query($conexion,$sql1);
	$datos = [
		"resultado" => 'ok',
	];
}

echo json_encode($datos);
*/
?>