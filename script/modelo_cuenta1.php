<?php
	$id_modelo = $_POST['cuentas2_id'];
	$pagina = $_POST['select_paginas'];
	$cuenta = $_POST['cuenta1'];
	$clave = $_POST['clave1'];
	$correo = $_POST['correo1'];
	$link = $_POST['link1'];
	$fecha_inicio = date('Y-m-d');

	include('conexion.php');

	$sql1 = "INSERT INTO modelos_cuentas (id_modelos,id_paginas,usuario,clave,correo,link,estatus,fecha_inicio) VALUES ('$id_modelo','$pagina','$cuenta','$clave','$correo','$link','Proceso','$fecha_inicio')";
	$registro1 = mysqli_query($conexion, $sql1);

	$datos = [
		"Sql" 	=> $sql1,
		"resultado" => "ok",
	];

	echo json_encode($datos);
?>