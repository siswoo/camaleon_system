<?php
session_start();
include('conexion.php');
$modelo = $_POST['modelo'];
$tipo = $_POST['tipo'];
$concepto = $_POST['concepto'];
$valor = $_POST['valor'];
$responsable = $_SESSION['id'];
//$fecha_inicio = date('Y-m-d');
$fecha_desde = $_POST['fecha'];
$fecha_hasta = $_POST['fecha'];
$fecha_inicio = $_POST['fecha'];

$sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$modelo;
$consulta1 = mysqli_query($conexion,$sql1);
$contador1 = mysqli_num_rows($consulta1);

if($contador1 == 0){
	$datos = [
		"contador1" => $contador1,
	];
	echo json_encode($datos);
	exit;
}

while($row1 = mysqli_fetch_array($consulta1)) {
	$id_modelo = $row1['id'];
}

switch ($tipo) {
	case 'descuento':
		$sqlTipo = "INSERT INTO descuento (id_modelo,concepto,valor,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'tienda':
		$sqlTipo = "INSERT INTO tienda (id_modelo,concepto,valor,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'avances':
		$sqlTipo = "INSERT INTO avances (id_modelo,concepto,valor,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'multas':
		$sqlTipo = "INSERT INTO multas (id_modelo,concepto,valor,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'bonos_horas':
		$sqlTipo = "INSERT INTO bonos_horas (id_modelo,concepto,monto,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'bonos_streamate':
		$sqlTipo = "INSERT INTO bonos_streamate (id_modelo,concepto,monto,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'odontologia':
		$sqlTipo = "INSERT INTO odontologia (id_modelo,concepto,monto,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'seguridad_social':
		$sqlTipo = "INSERT INTO seguridad_social (id_modelo,concepto,monto,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'coopserpak':
		$sqlTipo = "INSERT INTO coopserpak (id_modelo,concepto,monto,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'sexshop':
		$sqlTipo = "INSERT INTO sexshop (id_modelo,concepto,monto,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'belleza':
		$sqlTipo = "INSERT INTO belleza (id_modelo,concepto,monto,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'sancionpagina':
		$sqlTipo = "INSERT INTO sancionpagina (id_modelo,concepto,monto,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;

	case 'lenceria':
		$sqlTipo = "INSERT INTO lenceria (id_modelo,concepto,monto,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','$concepto','$valor','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$datos = [
			"contador1" => $contador1,
		];
		echo json_encode($datos);
	break;
	
	default:
		$datos = [
			"contador1" => 0,
		];
		echo json_encode($datos);
	break;
}
?>