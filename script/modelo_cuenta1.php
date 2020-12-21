<?php
$id_modelo = $_POST['cuentas2_id'];
$pagina = $_POST['select_paginas'];
$cuenta = $_POST['cuenta1'];
$clave = $_POST['clave1'];
$correo = $_POST['correo1'];
$link = $_POST['link1'];
$fecha_inicio = date('Y-m-d');

include('conexion.php');

$contador3 = 0;

/*
if($pagina == 1 or $pagina == 5 or $pagina == 7){
	$contador1 = 0;
}else{
	$sql2 = "SELECT * FROM modelos_cuentas WHERE id_paginas = ".$pagina." and usuario = '".$cuenta."' and id_modelos != ".$id_modelo;
	$registro1 = mysqli_query($conexion,$sql2);
	$contador1 = mysqli_num_rows($registro1);
}
*/

$sql2 = "SELECT * FROM modelos_cuentas WHERE usuario = '".$cuenta."' and id_modelos != ".$id_modelo." GROUP BY id_modelos";
$registro1 = mysqli_query($conexion,$sql2);
$contador1 = mysqli_num_rows($registro1);

if($contador1>=1){
	$contador2 = 0;
	while($row1 = mysqli_fetch_array($registro1)) {
		$contador2 = $contador2+1;
		$sql3 = "SELECT * FROM modelos WHERE id =".$row1['id_modelos'];
		$consulta2 = mysqli_query($conexion,$sql3);
		while($row2 = mysqli_fetch_array($consulta2)) {
			$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
			$documentos_modelo = $row2['documento_numero'];
		}
		$duplicados_nombres[$contador2] = $nombre_modelo;
		$duplicados_documentos[$contador2] = $documentos_modelo;
	}
	$datos = [
		"resultado" => "duplicados",
		"duplicados_nombres" => $duplicados_nombres,
		"duplicados_documentos" => $duplicados_documentos,
	];

	echo json_encode($datos);
	exit;
}

/*
if($pagina != 1 and $pagina != 5 and $pagina != 7){
	$sql4 = "SELECT * FROM modelos_cuentas WHERE usuario = '".$cuenta."' and id_modelos = ".$id_modelo;
	$registro4 = mysqli_query($conexion,$sql4);
	$contador3 = mysqli_num_rows($registro4);
}
*/

$sql4 = "SELECT * FROM modelos_cuentas WHERE usuario = '".$cuenta."' and id_modelos != ".$id_modelo;
$registro4 = mysqli_query($conexion,$sql4);
$contador3 = mysqli_num_rows($registro4);

if($contador3>=1){
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