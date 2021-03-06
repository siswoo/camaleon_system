<?php
session_start();
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');

include('../script/conexion.php');

if($condicion == 'registro'){
	$monitor = $_POST['monitor_registro'];
	$fecha = $_POST['fecha_registro'];
	$tokens = $_POST['tokens_registro'];
	$turno = $_POST['turno_registro'];
	$sql1 = "INSERT INTO monitores_registro_diario (monitor,fecha,tokens,turno,fecha_inicio) VALUES ('$monitor','$fecha','$tokens','$turno','$fecha_inicio')";
	$registro1 = mysqli_query($conexion, $sql1);

	$datos = [
		"resultado" => "ok",
	];

	echo json_encode($datos);

}

if($condicion == 'editar'){
	$id = $_POST['variable'];
	$sql1 = "SELECT * FROM monitores_registro_diario WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);
	while($row1 = mysqli_fetch_array($consulta1)) {
		$monitor = $row1['monitor'];
		$fecha = $row1['fecha'];
		$tokens = $row1['tokens'];
		$turno = $row1['turno'];
		$fecha_inicio = $row1['fecha_inicio'];
	}

	$datos = [
		"id" => $id,
		"monitor" => $monitor,
		"fecha" => $fecha,
		"tokens" => $tokens,
		"turno" => $turno,
		"fecha_inicio" => $fecha_inicio,
	];

	echo json_encode($datos);
}

if($condicion == 'actualizar'){
	$id = $_POST['id'];
	$monitor = $_POST['monitor'];
	$fecha = $_POST['fecha'];
	$tokens = $_POST['tokens'];
	$turno = $_POST['turno'];
	$sql1 = "UPDATE monitores_registro_diario SET monitor = '$monitor', fecha = '$fecha', tokens = '$tokens', turno = '$turno' WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
	];

	echo json_encode($datos);
}

if($condicion == 'eliminar'){
	$id = $_POST['variable'];
	$sql1 = "DELETE FROM monitores_registro_diario WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
	];

	echo json_encode($datos);
}

if($condicion == 'consultar1'){
	$fecha_desde = $_POST['fecha_desde'];
	$fecha_hasta = $_POST['fecha_hasta'];
	$monitor = $_POST['monitor'];
	$turno = $_POST['turno'];
	if($monitor=='' and $turno==''){
		$sql1 = "SELECT SUM(tokens) as Total FROM monitores_registro_diario WHERE fecha BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	}else if($monitor!='' and $turno==''){
		$sql1 = "SELECT SUM(tokens) as Total FROM monitores_registro_diario WHERE fecha BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and monitor =".$monitor;
	}else if($monitor!='' and $turno!=''){
		$sql1 = "SELECT SUM(tokens) as Total FROM monitores_registro_diario WHERE fecha BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and monitor =".$monitor." and turno = '".$turno."'";
	}else{
		$sql1 = "SELECT SUM(tokens) as Total FROM monitores_registro_diario WHERE fecha BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and turno = '".$turno."'";
	}
	$consulta1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($consulta1);

	$contador1 = 8300;
	$contador2 = 49800;
	$contador3 = 150000;

	$extra1 = ' ';
	$extra2 = ' ';
	$extra3 = ' ';

	if($contador1>=1){
		while($row1 = mysqli_fetch_array($consulta1)) {
			$total = $row1['Total'];
			if($total==NULL){
				$total = 0;
			}
		}

		if($total>=$contador1){
			$extra1 .= '<p style="color:green;"><strong>Diario</strong> '.number_format($contador1, 0, '', '.').'</p>';
		}else{
			$extra1 .= '<p style="color:red;"><strong>Diario</strong> '.number_format($contador1, 0, '', '.').'</p>';
		}

		if($total>=$contador2){
			$extra2 .= '<p style="color:green;"><strong>Semanal</strong> '.number_format($contador2, 0, '', '.').'</p>';
		}else{
			$extra2 .= '<p style="color:red;"><strong>Semanal</strong> '.number_format($contador2, 0, '', '.').'</p>';
		}

		if($total>=$contador3){
			$extra3 .= '<p style="color:green;"><strong>Mensual</strong> '.number_format($contador3, 0, '', '.').'</p>';
		}else{
			$extra3 .= '<p style="color:red;"><strong>Mensual</strong> '.number_format($contador3, 0, '', '.').'</p>';
		}

		$html = '<p>Total: $'.number_format($total, 0, '', '.').'</p>';
		$html .= $extra1."".$extra2."".$extra3;
	}else{
		$html = '<p>No se ha conseguido registros</p>';
	}

	$datos = [
		"estatus" => 'ok',
		"html" => $html,
	];

	echo json_encode($datos);
}


?>