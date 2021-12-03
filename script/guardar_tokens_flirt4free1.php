<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$id = $_POST['id'];
$dolares = $_POST['dolares'];
$fecha_desde_Flirt4free = $_POST['fecha_desde_Flirt4free'];
$fecha_hasta_Flirt4free = $_POST['fecha_hasta_Flirt4free'];
if($dolares!=''){
	$tokens = $dolares/0.05;
}
$responsable = $_SESSION['id'];


/*************VALIDACION DE FECHA HASTA****************/
$fecha_hasta_Flirt4free = explode('-',$fecha_hasta_Flirt4free);
$contador1 = 0;
do {
    if(checkdate($fecha_hasta_Flirt4free[1], $fecha_hasta_Flirt4free[2], $fecha_hasta_Flirt4free[0])){
		$contador1 = 1;
	}else{
		$fecha_hasta_Flirt4free[2] = $fecha_hasta_Flirt4free[2]-1;
	}
} while ($contador1==0);
/*****************************************************/

$fecha_hasta_Flirt4free = $fecha_hasta_Flirt4free[0]."-".$fecha_hasta_Flirt4free[1]."-".$fecha_hasta_Flirt4free[2];

if($dolares==''){
	$sql3 = "DELETE FROM flirt4free WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde_Flirt4free."' AND  '".$fecha_hasta_Flirt4free."' and fecha_hasta BETWEEN  '".$fecha_desde_Flirt4free."' AND  '".$fecha_hasta_Flirt4free."'";
	$registro3 = mysqli_query($conexion,$sql3);
	echo 'Correcto';
	exit;
}

$sql2 = "DELETE FROM flirt4free WHERE id_modelo = ".$id." and fecha_desde BETWEEN '".$fecha_desde_Flirt4free."' AND  '".$fecha_hasta_Flirt4free."' and fecha_hasta BETWEEN  '".$fecha_desde_Flirt4free."' AND  '".$fecha_hasta_Flirt4free."'";
$registro2 = mysqli_query($conexion,$sql2);

$sql1 = "INSERT INTO flirt4free (id_modelo,tokens,dolares,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id','$tokens','$dolares','$fecha_desde_Flirt4free','$fecha_hasta_Flirt4free','$responsable','$fecha_inicio')";
$registro1 = mysqli_query($conexion,$sql1);

echo 'Correcto';

?>