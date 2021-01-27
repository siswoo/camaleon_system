<?php
include('conexion.php');
$variable = $_POST['variable'];
$sql1 = "SELECT * FROM pasantes WHERE id = ".$variable;
$registro1 = mysqli_query( $conexion, $sql1 );

while($row = mysqli_fetch_array($registro1)) {
	$tipo_documento 	= $row['tipo_documento'];
	$numero_documento 	= $row['numero_documento'];
	$primer_nombre 		= $row['primer_nombre'];
	$segundo_nombre 	= $row['segundo_nombre'];
	$primer_apellido 	= $row['primer_apellido'];
	$segundo_apellido 	= $row['segundo_apellido'];
	$genero 			= $row['genero'];
	$correo 			= $row['correo'];
	$telefono1 			= $row['telefono1'];
	$barrio 			= $row['barrio'];
	$direccion 			= $row['direccion'];
	$sede 				= $row['sede'];
}

$datos = [
	"id"					=> $variable,
	"tipo_documento"		=> $tipo_documento,
	"numero_documento"		=> $numero_documento,
	"primer_nombre"			=> $primer_nombre,
	"segundo_nombre"		=> $segundo_nombre,
	"primer_apellido"		=> $primer_apellido,
	"segundo_apellido"		=> $segundo_apellido,
	"genero" 				=> $genero,
	"correo" 				=> $correo,
	"telefono1" 			=> $telefono1,
	"barrio" 				=> $barrio,
	"direccion" 			=> $direccion,
	"sede" 					=> $sede,
];

echo json_encode($datos);

?>