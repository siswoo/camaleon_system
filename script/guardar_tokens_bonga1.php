<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$id = $_POST['id'];
$dolares = $_POST['dolares'];
$fecha_desde_Bonga = $_POST['fecha_desde_Bonga'];
$fecha_hasta_Bonga = $_POST['fecha_hasta_Bonga'];
$tokens = $dolares/0.05;
$responsable = $_SESSION['id'];

$sql2 = "DELETE FROM bonga WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde_Bonga."' AND  '".$fecha_hasta_Bonga."' and fecha_hasta BETWEEN  '".$fecha_desde_Bonga."' AND  '".$fecha_hasta_Bonga."'";
$registro2 = mysqli_query($conexion,$sql2);

$sql1 = "INSERT INTO bonga (id_modelo,tokens,dolares,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id','$tokens','$dolares','$fecha_desde_Bonga','$fecha_hasta_Bonga','$responsable','$fecha_inicio')";
$registro1 = mysqli_query($conexion,$sql1);

echo 'Correcto';

?>