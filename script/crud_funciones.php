<?php
include('conexion.php');
session_start();
$fecha_inicio = date("Y-m-d");
$responsable = $_SESSION["id"];
$condicion = $_POST['condicion'];

if($condicion=='guardar1'){
	$nombre = $_POST['nombre'];
	$cargo = $_POST['cargo'];
	$descripcion1 = $_POST['descripcion1'];
	$descripcion2 = $_POST['descripcion2'];
	$descripcion3 = $_POST['descripcion3'];
	$descripcion4 = $_POST['descripcion4'];
	$descripcion5 = $_POST['descripcion5'];
	$descripcion6 = $_POST['descripcion6'];
	$descripcion7 = $_POST['descripcion7'];
	$descripcion8 = $_POST['descripcion8'];
	$descripcion9 = $_POST['descripcion9'];
	$descripcion10 = $_POST['descripcion10'];
	$descripcion11 = $_POST['descripcion11'];
	$descripcion12 = $_POST['descripcion12'];
	$descripcion13 = $_POST['descripcion13'];
	$descripcion14 = $_POST['descripcion14'];
	$descripcion15 = $_POST['descripcion15'];

	$sql1 = "SELECT * FROM funciones WHERE nombre = '".$nombre."'";
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
		$sql2 = "INSERT INTO funciones (nombre,cargo,descripcion1,descripcion2,descripcion3,descripcion4,descripcion5,descripcion6,descripcion7,descripcion8,descripcion9,descripcion10,descripcion11,descripcion12,descripcion13,descripcion14,descripcion15,responsable,fecha_inicio) VALUES ('$nombre','$cargo','$descripcion1','$descripcion2','$descripcion3','$descripcion4','$descripcion5','$descripcion6','$descripcion7','$descripcion8','$descripcion9','$descripcion10','$descripcion11','$descripcion12','$descripcion13','$descripcion14','$descripcion15','$responsable','$fecha_inicio')";
		$proceso2 = mysqli_query($conexion,$sql2);

		$datos = [
			"estatus" => "ok",
		];
		echo json_encode($datos);
	}
}

if($condicion=='consultar1'){
	$id = $_POST['id'];
	$sql1 = "SELECT * FROM funciones WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	while($row1 = mysqli_fetch_array($proceso1)) {
		$nombre = $row1["nombre"];
		$cargo = $row1["cargo"];
		$descripcion1 = $row1["descripcion1"];
		$descripcion2 = $row1["descripcion2"];
		$descripcion3 = $row1["descripcion3"];
		$descripcion4 = $row1["descripcion4"];
		$descripcion5 = $row1["descripcion5"];
		$descripcion6 = $row1["descripcion6"];
		$descripcion7 = $row1["descripcion7"];
		$descripcion8 = $row1["descripcion8"];
		$descripcion9 = $row1["descripcion9"];
		$descripcion10 = $row1["descripcion10"];
		$descripcion11 = $row1["descripcion11"];
		$descripcion12 = $row1["descripcion12"];
		$descripcion13 = $row1["descripcion13"];
		$descripcion14 = $row1["descripcion14"];
		$descripcion15 = $row1["descripcion15"];
	}
	$datos = [
		"estatus" => "ok",
		"nombre" => $nombre,
		"cargo" => $cargo,
		"descripcion1" => $descripcion1,
		"descripcion2" => $descripcion2,
		"descripcion3" => $descripcion3,
		"descripcion4" => $descripcion4,
		"descripcion5" => $descripcion5,
		"descripcion6" => $descripcion6,
		"descripcion7" => $descripcion7,
		"descripcion8" => $descripcion8,
		"descripcion9" => $descripcion9,
		"descripcion10" => $descripcion10,
		"descripcion11" => $descripcion11,
		"descripcion12" => $descripcion12,
		"descripcion13" => $descripcion13,
		"descripcion14" => $descripcion14,
		"descripcion15" => $descripcion15,
	];
	echo json_encode($datos);
}

if($condicion=='editar1'){
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$cargo = $_POST['cargo'];
	$descripcion1 = $_POST["descripcion1"];
	$descripcion2 = $_POST["descripcion2"];
	$descripcion3 = $_POST["descripcion3"];
	$descripcion4 = $_POST["descripcion4"];
	$descripcion5 = $_POST["descripcion5"];
	$descripcion6 = $_POST["descripcion6"];
	$descripcion7 = $_POST["descripcion7"];
	$descripcion8 = $_POST["descripcion8"];
	$descripcion9 = $_POST["descripcion9"];
	$descripcion10 = $_POST["descripcion10"];
	$descripcion11 = $_POST["descripcion11"];
	$descripcion12 = $_POST["descripcion12"];
	$descripcion13 = $_POST["descripcion13"];
	$descripcion14 = $_POST["descripcion14"];
	$descripcion15 = $_POST["descripcion15"];

	$sql1 = "SELECT * FROM funciones WHERE nombre = '".$nombre."'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1>=2){
		$datos = [
			"estatus" => "repetido",
		];
		echo json_encode($datos);
		exit;
	}else{
		$sql2 = "UPDATE funciones SET nombre = '$nombre', cargo = '$cargo', descripcion1 = '$descripcion1', descripcion2 = '$descripcion2', descripcion3 = '$descripcion3', descripcion4 = '$descripcion4', descripcion5 = '$descripcion5', descripcion6 = '$descripcion6', descripcion7 = '$descripcion7', descripcion8 = '$descripcion8', descripcion9 = '$descripcion9', descripcion10 = '$descripcion10', descripcion11 = '$descripcion11', descripcion12 = '$descripcion12', descripcion13 = '$descripcion13', descripcion14 = '$descripcion14', descripcion15 = '$descripcion15' WHERE id = ".$id;
		$proceso2 = mysqli_query($conexion,$sql2);

		$datos = [
			"estatus" => "ok",
			"nombre" => $nombre,
		];
		echo json_encode($datos);
	}
}

?>