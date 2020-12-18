<?php
$id_modelo = $_POST['cuentas2_id'];
$pagina = $_POST['select_paginas'];
$cuenta = $_POST['cuenta1'];
$clave = $_POST['clave1'];
$correo = $_POST['correo1'];
$link = $_POST['link1'];
$fecha_inicio = date('Y-m-d');

include('conexion.php');

if($pagina == 1 or $pagina == 5 or $pagina == 7){
	$contador1 = 0;
}else{
	$sql2 = "SELECT * FROM modelos_cuentas WHERE id_paginas = ".$pagina." and usuario = '".$cuenta."'";
	$registro1 = mysqli_query($conexion,$sql2);
	$contador1 = mysqli_num_rows($registro1);
}

if($contador1>=1){
	$datos = [
		"resultado" => "error",
	];

	echo json_encode($datos);
	exit;
}

$sql1 = "INSERT INTO modelos_cuentas (id_modelos,id_paginas,usuario,clave,correo,link,estatus,fecha_inicio) VALUES ('$id_modelo','$pagina','$cuenta','$clave','$correo','$link','Proceso','$fecha_inicio')";
$registro1 = mysqli_query($conexion, $sql1);

$datos = [
	"resultado" => "ok",
];

echo json_encode($datos);
?>