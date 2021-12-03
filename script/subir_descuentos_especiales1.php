<?php
include('conexion.php');
$fecha_inicio = date('Y-m-d');

$concepto = $_POST['concepto'];
$valor = $_POST['valor'];
$corte = $_POST['corte'];
$mes = $_POST['mes'];

if($corte==1){
	$fecha1 = '01';
}else if($corte==2){
	$fecha1 = '16';
}

$fecha_desde = '2021-'.$mes.'-'.$fecha1;
$fecha_hasta = '2021-'.$mes.'-'.$fecha1;

$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa'";
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$modelo_id = $row1["id"];
	
	$sql2 = "INSERT INTO descuento (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,estado,fecha_inicio) VALUES 
	($modelo_id,'$concepto',$valor,'$fecha_desde','$fecha_hasta',1,'Activo','$fecha_inicio')";
	$proceso2 = mysqli_query($conexion,$sql2);
}

$datos = [
	"sql1" => $sql1,
	"estatus" => "ok",
	"msg" => "Se ha Subido exitosamente!",
];

echo json_encode($datos);
?>