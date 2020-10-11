<?php
include('conexion.php');
$variable = $_POST['variable'];
$sql1 = "SELECT * FROM usuarios WHERE id = ".$variable;
$registro1 = mysqli_query( $conexion, $sql1 );

while($row = mysqli_fetch_array($registro1)) {
	/***********PERSONALES*************/
	$id					= $row['id'];
	$nombre				= $row['nombre'];
	$apellido 			= $row['apellido'];
	$documento_tipo 	= $row['documento_tipo'];
	$documento_numero 	= $row['documento_numero'];
	$correo 			= $row['correo'];
	$usuario 			= $row['usuario'];
	$telefono1 			= $row['telefono1'];
	$telefono2 			= $row['telefono2'];
	$rol 				= $row['rol'];
	$sede 				= $row['sede'];
}

$datos = [
	"id" 					=> $id,
	"nombre" 				=> $nombre,
	"apellido" 				=> $apellido,
	"documento_tipo" 		=> $documento_tipo,
	"documento_numero" 		=> $documento_numero,
	"correo" 				=> $correo,
	"usuario" 				=> $usuario,
	"telefono1" 			=> $telefono1,
	"telefono2" 			=> $telefono2,
	"rol" 					=> $rol,
	"sede" 					=> $sede,
];

echo json_encode($datos);

?>