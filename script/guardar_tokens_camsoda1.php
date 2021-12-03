<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$id = $_POST['id'];
$tokens = $_POST['tokens'];
$fecha_desde_Camsoda = $_POST['fecha_desde_Camsoda'];
$fecha_hasta_Camsoda = $_POST['fecha_hasta_Camsoda'];
if($tokens!=''){
	$dolares = $tokens*0.05;
}
$responsable = $_SESSION['id'];


/*************VALIDACION DE FECHA HASTA****************/
$fecha_hasta_Camsoda = explode('-',$fecha_hasta_Camsoda);
$contador1 = 0;
do {
    if(checkdate($fecha_hasta_Camsoda[1], $fecha_hasta_Camsoda[2], $fecha_hasta_Camsoda[0])){
		$contador1 = 1;
	}else{
		$fecha_hasta_Camsoda[2] = $fecha_hasta_Camsoda[2]-1;
	}
} while ($contador1==0);
/*****************************************************/

$fecha_hasta_Camsoda = $fecha_hasta_Camsoda[0]."-".$fecha_hasta_Camsoda[1]."-".$fecha_hasta_Camsoda[2];

//$sql3 = "SELECT * FROM camsoda WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde_Camsoda."' AND  '".$fecha_hasta_Camsoda."'";

if($tokens==''){
	$sql3 = "DELETE FROM camsoda WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde_Camsoda."' AND  '".$fecha_hasta_Camsoda."'";
	$registro3 = mysqli_query($conexion,$sql3);
	echo 'Correcto';
	exit;
}

$sql2 = "DELETE FROM camsoda WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde_Camsoda."' AND  '".$fecha_hasta_Camsoda."'";
$registro2 = mysqli_query($conexion,$sql2);

$sql1 = "INSERT INTO camsoda (id_modelo,tokens,dolares,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id','$tokens','$dolares','$fecha_desde_Camsoda','$fecha_hasta_Camsoda','$responsable','$fecha_inicio')";
$registro1 = mysqli_query($conexion,$sql1);

echo 'Correcto';

?>