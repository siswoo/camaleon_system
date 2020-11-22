<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$id = $_POST['id'];
$dolares = $_POST['dolares'];
$fecha_desde_Flirt4free = $_POST['fecha_desde_Flirt4free'];
$fecha_hasta_Flirt4free = $_POST['fecha_hasta_Flirt4free'];
$tokens = $dolares/0.05;
$responsable = $_SESSION['id'];

$sql2 = "DELETE FROM flirt4free WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde_Flirt4free."' AND  '".$fecha_hasta_Flirt4free."' and fecha_hasta BETWEEN  '".$fecha_desde_Flirt4free."' AND  '".$fecha_hasta_Flirt4free."'";
$registro2 = mysqli_query($conexion,$sql2);

$sql1 = "INSERT INTO flirt4free (id_modelo,tokens,dolares,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id','$tokens','$dolares','$fecha_desde_Flirt4free','$fecha_hasta_Flirt4free','$responsable','$fecha_inicio')";
$registro1 = mysqli_query($conexion,$sql1);

echo 'Correcto';

?>