<?php
	$nombre = $_POST['nombre'];
	$modelo_view = $_POST['modelo_view'];
	$modelo_edit = $_POST['modelo_edit'];
	$modelo_delete = $_POST['modelo_delete'];
	/*
	$roles_view = $_POST['roles_view'];
	$roles_edit = $_POST['roles_edit'];
	$roles_delete = $_POST['roles_delete'];
	*/
	$pasante_view = $_POST['pasante_view'];
	$pasante_edit = $_POST['pasante_edit'];
	$pasante_delete = $_POST['pasante_delete'];

	$fecha_inicio = date('Y-m-d');

	include('conexion.php');

	$sql1 = "INSERT INTO roles (nombre,modelo_view,modelo_edit,modelo_delete,pasante_view,pasante_edit,pasante_delete) VALUES ('$nombre','$modelo_view','$modelo_edit','$modelo_delete','$pasante_view','$pasante_edit','$pasante_delete')";
	$registro1 = mysqli_query($conexion, $sql1);

	$datos = [
		"Sql" 	=> $sql1,
		"resultado" => "ok",
	];

	echo json_encode($datos);
?>