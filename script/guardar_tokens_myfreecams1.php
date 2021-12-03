<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$id = $_POST['id'];
$tokens = $_POST['tokens'];
$fecha_desde_Myfreecams = $_POST['fecha_desde_Myfreecams'];
$fecha_hasta_Myfreecams = $_POST['fecha_hasta_Myfreecams'];
if($tokens!=''){
	$dolares = $tokens*0.05;
}
$responsable = $_SESSION['id'];

/*************VALIDACION DE FECHA HASTA****************/
$fecha_hasta_Myfreecams = explode('-',$fecha_hasta_Myfreecams);
$contador1 = 0;
do {
    if(checkdate($fecha_hasta_Myfreecams[1], $fecha_hasta_Myfreecams[2], $fecha_hasta_Myfreecams[0])){
		$contador1 = 1;
	}else{
		$fecha_hasta_Myfreecams[2] = $fecha_hasta_Myfreecams[2]-1;
	}
} while ($contador1==0);
/*****************************************************/

$fecha_hasta_Myfreecams = $fecha_hasta_Myfreecams[0]."-".$fecha_hasta_Myfreecams[1]."-".$fecha_hasta_Myfreecams[2];

if($tokens==''){
	$sql3 = "DELETE FROM myfreecams WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde_Myfreecams."' AND  '".$fecha_hasta_Myfreecams."'";
	$registro3 = mysqli_query($conexion,$sql3);
	echo 'Correcto';
	exit;
}

$sql2 = "DELETE FROM myfreecams WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde_Myfreecams."' AND  '".$fecha_hasta_Myfreecams."' and fecha_hasta BETWEEN  '".$fecha_desde_Myfreecams."' AND  '".$fecha_hasta_Myfreecams."'";
$registro2 = mysqli_query($conexion,$sql2);

$sql1 = "INSERT INTO myfreecams (id_modelo,tokens,dolares,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id','$tokens','$dolares','$fecha_desde_Myfreecams','$fecha_hasta_Myfreecams','$responsable','$fecha_inicio')";
$registro1 = mysqli_query($conexion,$sql1);

echo 'Correcto';

?>