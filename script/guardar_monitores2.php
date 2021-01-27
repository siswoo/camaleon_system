<?php
session_start();
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$numero_documento = $_POST['numero_documento'];
$tipo_documento = $_POST['tipo_documento'];
$numero_documento = $_POST['numero_documento'];
$telefono1 = $_POST['telefono1'];
$fecha_inicio = date('Y-m-d');

include('../script/conexion.php');

$sql1 = "INSERT INTO monitores (nombre,apellido,tipo_documento,numero_documento,telefono,fecha_inicio) VALUES ('$nombre','$apellido','$tipo_documento','$numero_documento','$telefono1','$fecha_inicio')";
$registro1 = mysqli_query($conexion, $sql1);

$datos = [
	"resultado" => $sql1,
];

echo json_encode($datos);

?>