<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$id = $_POST['id'];
$dolares = $_POST['dolares'];
$fecha_desde = $_POST['fecha_desde'];
$fecha_hasta = $_POST['fecha_hasta'];
if($dolares!=''){
	$tokens = $dolares/0.05;
}
$responsable = $_SESSION['id'];

/*************VALIDACION DE FECHA HASTA****************/
$fecha_hasta = explode('-',$fecha_hasta);
$contador1 = 0;
do {
    if(checkdate($fecha_hasta[1], $fecha_hasta[2], $fecha_hasta[0])){
		$contador1 = 1;
	}else{
		$fecha_hasta[2] = $fecha_hasta[2]-1;
	}
} while ($contador1==0);
/*****************************************************/

$fecha_hasta = $fecha_hasta[0]."-".$fecha_hasta[1]."-".$fecha_hasta[2];

if($dolares==''){
	$sql3 = "DELETE FROM amateur WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde."' AND  '".$fecha_hasta."' and fecha_hasta BETWEEN  '".$fecha_desde."' AND  '".$fecha_hasta."'";
	$registro3 = mysqli_query($conexion,$sql3);
	echo 'Correcto';
	exit;
}

$sql2 = "DELETE FROM amateur WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde."' AND  '".$fecha_hasta."' and fecha_hasta BETWEEN  '".$fecha_desde."' AND  '".$fecha_hasta."'";
$registro2 = mysqli_query($conexion,$sql2);

$sql1 = "INSERT INTO amateur (id_modelo,tokens,dolares,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id','$tokens','$dolares','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
$registro1 = mysqli_query($conexion,$sql1);

echo 'Correcto';

?>