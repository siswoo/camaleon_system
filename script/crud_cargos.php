<?php
include('conexion.php');
session_start();
$fecha_inicio = date("Y-m-d");
$responsable = $_SESSION["id"];
$condicion = $_POST['condicion'];

if($condicion=='guardar1'){
	$nombre = $_POST['nombre'];

	$sql1 = "SELECT * FROM cargos WHERE nombre = '".$nombre."'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1>=1){
		$datos = [
			"estatus" => "repetido",
			"sql1" => $sql1,
		];
		echo json_encode($datos);
		exit;
	}else{
		$sql2 = "INSERT INTO cargos (nombre,responsable,fecha_inicio) VALUES ('$nombre','$responsable','$fecha_inicio')";
		$proceso2 = mysqli_query($conexion,$sql2);

		$datos = [
			"estatus" => "ok",
		];
		echo json_encode($datos);
	}
}

if($condicion=='consultar1'){
	$id = $_POST['id'];
	$sql1 = "SELECT * FROM cargos WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	while($row1 = mysqli_fetch_array($proceso1)) {
		$nombre = $row1["nombre"];
	}
	$datos = [
		"estatus" => "ok",
		"nombre" => $nombre,
	];
	echo json_encode($datos);
}

if($condicion=='editar1'){
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];

	$sql1 = "SELECT * FROM cargos WHERE nombre = '".$nombre."'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1>=2){
		$datos = [
			"estatus" => "repetido",
		];
		echo json_encode($datos);
		exit;
	}else{
		$sql2 = "UPDATE cargos SET nombre = '$nombre' WHERE id = ".$id;
		$proceso2 = mysqli_query($conexion,$sql2);

		$datos = [
			"estatus" => "ok",
			"nombre" => $nombre,
		];
		echo json_encode($datos);
	}
}

?>