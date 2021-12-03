<?php
session_start();
$tipo_documento = $_POST['tipo_documento'];
$numero_documento = $_POST['numero_documento'];
$primer_nombre = $_POST['primer_nombre'];
$primer_apellido = $_POST['primer_apellido'];
$correo = $_POST['correo'];
$telefono1 = $_POST['telefono1'];
$usuario2 = $_POST['usuario'];
$sede = $_POST['sedes'];
$rol = $_POST['rol'];
$clave = md5($_POST['clave']);
//$sede = $_SESSION['sede'];
$fecha_inicio = date('Y-m-d');

include('conexion.php');

$sql2 = "SELECT * FROM usuarios WHERE usuario = '".$usuario2."'";
$consulta1 = mysqli_query($conexion, $sql2);
$fila1 = mysqli_num_rows($consulta1);

if($fila1>=1){
	$datos = [
		"resultado" => "no",
	];
}else{
	$sql1 = "INSERT INTO usuarios (documento_tipo,documento_numero,nombre,apellido,correo,telefono1,usuario,clave,fecha_inicio,rol,sede) VALUES ('$tipo_documento','$numero_documento','$primer_nombre','$primer_apellido','$correo','$telefono1','$usuario2','$clave','$fecha_inicio','$rol','$sede')";
	$registro1 = mysqli_query($conexion, $sql1);

	$datos = [
		"resultado" => "ok",
	];
}

echo json_encode($datos);

?>