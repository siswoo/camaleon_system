<?php
include('conexion.php');
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');

if($condicion=='cambiar1'){
	$modelo = $_POST["modelo"];
	$documento = $_POST["documento"];

	$sql1 = "SELECT * FROM modelos WHERE documento_numero = '$modelo'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1==0){
		$datos = [
			"estatus" => 'error',
			"msg" => "Validar Numero de documento de la modelo por favor",
		];
		echo json_encode($datos);
		exit;
	}

	while($row1=mysqli_fetch_array($proceso1)){
		$modelo_id = $row1["id"];
	}

	$sql2 = "DELETE FROM modelos_documentos WHERE id_modelos = ".$modelo_id." and id_documentos = ".$documento;
	$proceso2 = mysqli_query($conexion,$sql2);

	$datos = [
		"estatus" => 'ok',
		"msg" => "Se ha eliminado exitosamente",
	];
	echo json_encode($datos);
}

if($condicion=='cambiar2'){
	$modelo = $_POST["modelo"];
	$sede = $_POST["sede"];

	$sql1 = "SELECT * FROM modelos WHERE documento_numero = '$modelo'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1==0){
		$datos = [
			"estatus" => 'error',
			"msg" => "Validar Numero de documento de la modelo por favor",
		];
		echo json_encode($datos);
		exit;
	}

	while($row1=mysqli_fetch_array($proceso1)){
		$modelo_id = $row1["id"];
	}

	$sql2 = "UPDATE modelos SET sede = $sede WHERE id = ".$modelo_id;
	$proceso2 = mysqli_query($conexion,$sql2);

	$datos = [
		"estatus" => 'ok',
		"msg" => "Se ha cambido exitosamente",
	];
	echo json_encode($datos);
}

if($condicion=='clave1'){
	$modelo = $_POST["modelo"];

	$sql1 = "SELECT * FROM modelos WHERE documento_numero = '$modelo'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1==0){
		$datos = [
			"estatus" => 'error',
			"msg" => "Validar Numero de documento de la modelo por favor",
		];
		echo json_encode($datos);
		exit;
	}

	while($row1=mysqli_fetch_array($proceso1)){
		$modelo_id = $row1["id"];
		$modelo_correo = $row1["correo"];
	}

	$sql2 = "SELECT * FROM usuarios WHERE documento_numero = '$modelo' and correo = '$modelo_correo' and rol = 5";
	$proceso2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($proceso2);
	if($contador2==0){
		$datos = [
			"estatus" => 'error',
			"msg" => "Documento o correo cambiado en usuario",
		];
		echo json_encode($datos);
		exit;
	}

	while($row2=mysqli_fetch_array($proceso2)){
		$usuario_id = $row2["id"];
		$usuario_usuario = $row2["usuario"];
	}

	$clave = md5($modelo);

	$sql3 = "UPDATE usuarios SET clave = '$clave' WHERE id = ".$usuario_id;
	$proceso3 = mysqli_query($conexion,$sql3);

	$datos = [
		"estatus" => 'ok',
		"msg" => "Se ha cambido exitosamente",
		"html"=> "usuario: ".$usuario_usuario."
		clave: ".$modelo,
	];
	echo json_encode($datos);
}

if($condicion=='documento_nuevo1'){
	$modelo = $_POST["modelo"];
	$documento_nuevo = $_POST["documento_nuevo"];

	$sql1 = "SELECT * FROM modelos WHERE documento_numero = '$modelo'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1==0){
		$datos = [
			"estatus" => 'error',
			"msg" => "Validar Numero de documento de la modelo por favor",
		];
		echo json_encode($datos);
		exit;
	}

	while($row1=mysqli_fetch_array($proceso1)){
		$modelo_id = $row1["id"];
		$modelo_correo = $row1["correo"];
	}

	$sql2 = "SELECT * FROM usuarios WHERE documento_numero = '$modelo' and correo = '$modelo_correo' and rol = 5";
	$proceso2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($proceso2);
	if($contador2==0){
		$datos = [
			"estatus" => 'error',
			"msg" => "Documento o correo cambiado en usuario",
		];
		echo json_encode($datos);
		exit;
	}

	while($row2=mysqli_fetch_array($proceso2)){
		$usuario_id = $row2["id"];
		$usuario_usuario = $row2["usuario"];
	}

	$clave = md5($documento_nuevo);

	$sql3 = "UPDATE usuarios SET documento_numero = '$documento_nuevo', clave = '$clave' WHERE id = ".$usuario_id;
	$proceso3 = mysqli_query($conexion,$sql3);

	$sql4 = "UPDATE modelos SET documento_numero = '$documento_nuevo', clave = '$clave' WHERE id = ".$modelo_id;
	$proceso4 = mysqli_query($conexion,$sql4);

	$datos = [
		"estatus" => 'ok',
		"msg" => "Se ha cambido exitosamente",
	];
	echo json_encode($datos);
}