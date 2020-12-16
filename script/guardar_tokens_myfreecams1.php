<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$id = $_POST['id'];
$tokens = $_POST['tokens'];
$fecha_desde_Myfreecams = $_POST['fecha_desde_Myfreecams'];
$fecha_hasta_Myfreecams = $_POST['fecha_hasta_Myfreecams'];
$dolares = $tokens*0.05;
$responsable = $_SESSION['id'];

$sql2 = "DELETE FROM myfreecams WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde_Myfreecams."' AND  '".$fecha_hasta_Myfreecams."' and fecha_hasta BETWEEN  '".$fecha_desde_Myfreecams."' AND  '".$fecha_hasta_Myfreecams."'";
$registro2 = mysqli_query($conexion,$sql2);

$sql1 = "INSERT INTO myfreecams (id_modelo,tokens,dolares,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id','$tokens','$dolares','$fecha_desde_Myfreecams','$fecha_desde_Myfreecams','$responsable','$fecha_inicio')";
$registro1 = mysqli_query($conexion,$sql1);

echo 'Correcto';

?>