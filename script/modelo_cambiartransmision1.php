<?php
session_start();
include('conexion.php');

$transmision = $_POST['value'];
$id_modelo = $_POST['modelo'];

$sql1 = "UPDATE modelos SET Htransmision = '".$transmision."' WHERE id = ".$id_modelo;
$registro1 = mysqli_query($conexion,$sql1);

$datos = [
	"estatus"	=> 'correcto',
	"sql"	=> $sql1,
];

echo json_encode($datos);

?>