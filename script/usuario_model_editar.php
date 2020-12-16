<?php
include('conexion.php');
$variable = $_POST['variable'];
$sql1 = "SELECT * FROM usuarios WHERE id = ".$variable;
$registro1 = mysqli_query( $conexion, $sql1 );

while($row = mysqli_fetch_array($registro1)) {
	$documento_tipo 	= $row['documento_tipo'];
	$documento_numero 	= $row['documento_numero'];
	$nombre 			= $row['nombre'];
	$apellido 			= $row['apellido'];
	$correo 			= $row['correo'];
	$usuario 			= $row['usuario'];
	$telefono1 			= $row['telefono1'];
	$telefono2 			= $row['telefono2'];
	$rol 				= $row['rol'];
	$sedes 				= $row['sede'];
	$fecha_inicio 		= $row['fecha_inicio'];
}

$datos = [
	"id"					=> $variable,
	"documento_tipo"		=> $documento_tipo,
	"documento_numero"		=> $documento_numero,
	"nombre"				=> $nombre,
	"apellido"				=> $apellido,
	"correo"				=> $correo,
	"usuario"				=> $usuario,
	"telefono1" 			=> $telefono1,
	"telefono2" 			=> $telefono2,
	"rol" 					=> $rol,
	"sedes" 				=> $sedes,
	"fecha_inicio" 			=> $fecha_inicio,
];

echo json_encode($datos);

?>