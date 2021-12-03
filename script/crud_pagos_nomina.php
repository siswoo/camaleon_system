<?php
session_start();
include('conexion.php');
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];

if($condicion=='consultar1'){
	$inicio = $_POST['inicio'];
	$fin 	= $_POST['fin'];

	$sql1 = "SELECT * FROM n_pagos WHERE inicio BETWEEN '".$inicio."' AND '".$fin."' and fin BETWEEN '".$inicio."' AND '".$fin."'";
	$consulta1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($consulta1);

	$html = '';

	if($contador1>=1){
		$html .= '
			<tr 
		';
		$datos = [
			"estatus" => 'ok',
		];
		echo json_encode($datos);
	}
}

if($condicion=='consultar2'){
	$value = $_POST["value"];
	$sede = $_SESSION["sede"];

	if($_SESSION["id"]==1){
		$sql1 = "SELECT * FROM nomina WHERE documento_numero LIKE '%".$value."%' or nombre LIKE '%".$value."%' or apellido LIKE '%".$value."%'";
	}else{
		$sql1 = "SELECT * FROM nomina WHERE (documento_numero LIKE '%".$value."%' or nombre LIKE '%".$value."%' or apellido LIKE '%".$value."%') and sede = ".$sede;
	}

	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	$html = '';

	$sql2 = "SELECT * FROM nomina WHERE documento_numero = '".$value."'";
	$proceso2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($proceso2);

	if($contador2>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$nomina_id = $row2["id"];
			$nombre = $row2["nombre"];
			$apellido = $row2["apellido"];
			$documento_tipo = $row2["documento_tipo"];
			$documento_numero = $row2["documento_numero"];
			$cargo = $row2["cargo"];
			$funcion = $row2["funcion"];
			$salario = $row2["salario"];
		}

		$datos = [
			"estatus" => 'especifico',
			"nomina_id" => $nomina_id,
			"nombre" => $nombre,
			"apellido" => $apellido,
			"documento_tipo" => $documento_tipo,
			"documento_numero" => $documento_numero,
			"cargo" => $cargo,
			"funcion" => $funcion,
			"salario" => $salario,
		];
		echo json_encode($datos);
		exit;
	}

	while($row1 = mysqli_fetch_array($proceso1)) {
		$nombre = $row1["nombre"];
		$apellido = $row1["apellido"];
		$documento_tipo = $row1["documento_tipo"];
		$documento_numero = $row1["documento_numero"];
		$cargo = $row1["cargo"];
		$funcion = $row1["funcion"];
		$salario = $row1["salario"];
		$html .= '
			<option value="'.$documento_numero.'">'.$nombre.' '.$apellido.'</option>
		';
	}

	if($contador1>=1){
		$datos = [
			"estatus" => 'ok',
			"html" => $html,
		];
	}else{
		$datos = [
			"estatus" => 'sin resultados',
		];
	}

	echo json_encode($datos);

}


if($condicion=='guardar1'){
	$nomina_id 		= $_POST['nomina_id'];
	$salario 		= $_POST['salario'];
	$inasistencia 	= $_POST['inasistencia'];
	$descuento 		= $_POST['descuento'];
	$bonos 			= $_POST['bonos'];
	$inicio 		= $_POST['inicio'];
	$fin 			= $_POST['fin'];

	$sql1 = "INSERT INTO n_pagos (id_nomina,salario,bonos,multas,inasistencias,inicio,fin,fecha_inicio,responsable) VALUES ('$nomina_id','$salario','$bonos','$descuento','$inasistencia','$inicio','$fin','$fecha_inicio','$responsable')";
	$proceso1 = mysqli_query($conexion,$sql1);
	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
	];
	echo json_encode($datos);
}

if($condicion=='consultar3'){
	$id = $_POST['id'];
	$sql1 = "SELECT * FROM n_pagos WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	while($row1 = mysqli_fetch_array($proceso1)) {
		$id_nomina = $row1["id_nomina"];
		$salario = $row1["salario"];
		$bonos = $row1["bonos"];
		$inasistencia = $row1["inasistencias"];
		$multas = $row1["multas"];
		$responsable = $row1["responsable"];
		$inicio = $row1["inicio"];
		$fin = $row1["fin"];
		$fecha_inicio = $row1["fecha_inicio"];
	}

	$sql2 = "SELECT * FROM nomina WHERE id = ".$id_nomina;
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($proceso2)) {
		$nombre = $row2["nombre"];
		$apellido = $row2["apellido"];
		$documento_tipo = $row2["documento_tipo"];
		$documento_numero = $row2["documento_numero"];
	}

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
		"nombre" => $nombre,
		"apellido" => $apellido,
		"documento_tipo" => $documento_tipo,
		"documento_numero" => $documento_numero,
		"salario" => $salario,
		"inasistencia" => $inasistencia,
		"bonos" => $bonos,
		"multas" => $multas,
		"inicio" => $inicio,
		"fin" => $fin,
	];
	echo json_encode($datos);
}

if($condicion=='editar1'){
	$id = $_POST['id'];
	$salario = $_POST['salario'];
	$inasistencia = $_POST['inasistencia'];
	$descuento = $_POST['descuento'];
	$bonos = $_POST['bonos'];
	$sql1 = "UPDATE n_pagos SET salario = ".$salario.", bonos = ".$bonos.", inasistencias = ".$inasistencia.", multas = ".$descuento." WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
	];
	echo json_encode($datos);
}

if($condicion=='eliminar1'){
	$id = $_POST['id'];
	$sql1 = "DELETE FROM n_pagos WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
	];
	echo json_encode($datos);
}

if($condicion=='validar1'){
	$id = $_POST['id'];
	$sql1 = "UPDATE n_pagos SET estatus = 'Aceptado' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
	];
	echo json_encode($datos);
}

if($condicion=='cancelar1'){
	$id = $_POST['id'];
	$sql1 = "UPDATE n_pagos SET estatus = 'Proceso' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
	];
	echo json_encode($datos);
}




