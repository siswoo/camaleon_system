<?php
include('conexion.php');
$condicion = $_POST['condicion'];

if($condicion=='cambiar_clave1'){
	$usuario = $_POST['usuario'];
	$password1 = md5($_POST['password1']);
	$password2 = md5($_POST['password2']);

	$sql1 = "UPDATE usuarios SET clave = '".$password1."' WHERE usuario = '".$usuario."'";
	$actualizar1 = mysqli_query($conexion,$sql1);
}

$datos = [
	"sql" 		=> $sql1,
];

echo json_encode($datos);

?>