<?php
session_start();
include('conexion.php');

$id = $_POST['id'];
$condicion = $_POST['condicion'];

if($condicion=='activar'){
	$sql2 = "SELECT * FROM presabana WHERE id = ".$id;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$inicio = $row2['inicio'];
		$fin 	= $row2['fin'];
	}
	$sql1 = "UPDATE presabana SET estatus = 'Activa' WHERE inicio = '".$inicio."' and fin = '".$fin."'";
	$modificar1 = mysqli_query($conexion,$sql1);
}

if($condicion=='desactivar'){
	$sql2 = "SELECT * FROM presabana WHERE id = ".$id;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$inicio = $row2['inicio'];
		$fin 	= $row2['fin'];
	}
	$sql1 = "UPDATE presabana SET estatus = 'Desactivada' WHERE inicio = '".$inicio."' and fin = '".$fin."'";
	$modificar1 = mysqli_query($conexion,$sql1);
}

if($condicion=='eliminar'){
	$sql2 = "SELECT * FROM presabana WHERE id = ".$id;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$inicio = $row2['inicio'];
		$fin 	= $row2['fin'];
	}
	$sql1 = "DELETE FROM  presabana WHERE inicio = '".$inicio."' and fin = '".$fin."'";
	$eliminar1 = mysqli_query($conexion,$sql1);
}

$datos = [
	"sql1" => $sql1,
];

echo json_encode($datos);

?>