<?php
include('conexion.php');

$password = md5($_POST['password1']);
$id_recuperar = $_POST['id_recuperar'];
$condicion = $_POST['condicion'];
$id_usuario = $_POST['id_usuario'];

$sql1 = "UPDATE recuperar_password SET verificado = 1 WHERE id = ".$id_recuperar;
$consulta1 = mysqli_query($conexion,$sql1);

$sql2 = "UPDATE usuarios SET clave = '".$password."' WHERE id = ".$id_usuario;
$consulta2 = mysqli_query($conexion,$sql2);

$datos = [
	"resultado" => 'ok',
];

echo json_encode($datos);

?>