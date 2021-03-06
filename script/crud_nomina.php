<?php
session_start();
include('conexion.php');
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];

if($condicion=='guardar1'){
	$tipo_documento 	= $_POST['tipo_documento'];
	$numero_documento 	= $_POST['numero_documento'];
	$nombre 			= $_POST['nombre'];
	$apellido 			= $_POST['apellido'];
	$genero 			= $_POST['genero'];
	$correo 			= $_POST['correo'];
	$direccion 			= $_POST['direccion'];
	$salario 			= $_POST['salario'];
	$turno 				= $_POST['turno'];
	$telefono 			= $_POST['telefono'];
	$cargo 				= $_POST['cargo'];
	$sedes 				= $_POST['sedes'];
	$turno 				= $_POST['turno'];
	$fecha_nacimiento 	= $_POST['fecha_nacimiento'];
	$fecha_ingreso 		= $_POST['fecha_ingreso'];

	$sql2 = "SELECT * FROM nomina WHERE documento_numero = '".$numero_documento."'";
	$consulta2 = mysqli_query($conexion,$sql2);
	$contador1 = mysqli_num_rows($consulta2);

	if($contador1>=1){
		$datos = [
			"estatus" => 'repetido',
		];
		echo json_encode($datos);		
	}else{
		$sql1 = "INSERT INTO nomina (nombre,apellido,documento_tipo,documento_numero,genero,correo,direccion,salario,telefono,estatus,fecha_inicio,turno,sede,cargo,fecha_nacimiento,fecha_ingreso) VALUES ('$nombre','$apellido','$tipo_documento','$numero_documento','$genero','$correo','$direccion','$salario','$telefono','Aceptado','$fecha_inicio','$turno','$sedes','$cargo','$fecha_nacimiento','$fecha_ingreso')";
		$consulta1 = mysqli_query($conexion,$sql1);

		$datos = [
			"estatus" => 'ok',
			"sql1" => $sql1,
		];

		echo json_encode($datos);
	}
}


if($condicion=='consultar1'){
	$id = $_POST['id'];

	$sql1 = "SELECT * FROM nomina WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);
	while($row1 = mysqli_fetch_array($consulta1)) {
		$tipo_documento = $row1['documento_tipo'];
		$numero_documento = $row1['documento_numero'];
		$nombre = $row1['nombre'];
		$apellido = $row1['apellido'];
		$genero = $row1['genero'];
		$correo = $row1['correo'];
		$direccion = $row1['direccion'];
		$salario = $row1['salario'];
		$turno = $row1['turno'];
		$telefono = $row1['telefono'];
		$cargo = $row1['cargo'];
		$sedes = $row1['sede'];
		$estatus = $row1['estatus'];
		$fecha_nacimiento = $row1['fecha_nacimiento'];
		$fecha_ingreso = $row1['fecha_ingreso'];
	}

	$datos = [
		"estatus" => 'ok',
		"id" => $id,
		"tipo_documento" => $tipo_documento,
		"numero_documento" => $numero_documento,
		"nombre" => $nombre,
		"apellido" => $apellido,
		"genero" => $genero,
		"correo" => $correo,
		"direccion" => $direccion,
		"salario" => $salario,
		"turno" => $turno,
		"telefono" => $telefono,
		"cargo" => $cargo,
		"sedes" => $sedes,
		"estatus2" => $estatus,
		"fecha_nacimiento" => $fecha_nacimiento,
		"fecha_ingreso" => $fecha_ingreso,
	];

	echo json_encode($datos);
}

if($condicion=='editar1'){
	$id = $_POST['id'];
	$tipo_documento = $_POST['tipo_documento'];
	$numero_documento = $_POST['numero_documento'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$genero = $_POST['genero'];
	$correo = $_POST['correo'];
	$direccion = $_POST['direccion'];
	$salario = $_POST['salario'];
	$turno = $_POST['turno'];
	$telefono = $_POST['telefono'];
	$cargo = $_POST['cargo'];
	$sedes = $_POST['sedes'];
	$estatus = $_POST['estatus'];
	$fecha_nacimiento = $_POST['fecha_nacimiento'];
	$fecha_ingreso = $_POST['fecha_ingreso'];

	$sql1 = "UPDATE nomina SET documento_tipo = '$tipo_documento', documento_numero = '$numero_documento', nombre = '$nombre', apellido = '$apellido', genero = '$genero', correo = '$correo', direccion = '$direccion', salario = '$salario', turno = '$turno', telefono = '$telefono', cargo = '$cargo', sede = '$sedes', estatus = '$estatus', fecha_nacimiento = '$fecha_nacimiento', fecha_ingreso = '$fecha_ingreso' WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);

	$sql2 = "SELECT * FROM sedes WHERE id = ".$sedes;
	$resultado2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($resultado2)) {
		$nombre_sede = $row2['nombre'];
	}

	$sql3 = "SELECT * FROM cargos WHERE id = ".$cargo;
	$resultado3 = mysqli_query($conexion,$sql3);
	while($row3 = mysqli_fetch_array($resultado3)) {
		$nombre_cargo = $row3['nombre'];
	}

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
		"id" => $id,
		"tipo_documento" => $tipo_documento,
		"numero_documento" => $numero_documento,
		"nombre" => $nombre,
		"apellido" => $apellido,
		"genero" => $genero,
		"correo" => $correo,
		"direccion" => $direccion,
		"salario" => $salario,
		"turno" => $turno,
		"telefono" => $telefono,
		"cargo" => $nombre_cargo,
		"sedes" => $nombre_sede,
		"estatus2" => $estatus,
		"fecha_nacimiento" => $fecha_nacimiento,
		"fecha_ingreso" => $fecha_ingreso,
	];

	echo json_encode($datos);
}


if($condicion=='eliminar1'){
	$id = $_POST['id'];

	$sql1 = "DELETE FROM nomina WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
	];

	echo json_encode($datos);
}

if($condicion=='subir_archivo1'){
	$id = $_POST['id'];

	if(file_exists('../resources/documentos/nominas/archivos/'.$id)){}else{
    	mkdir('../resources/documentos/nominas/archivos/'.$id, 0777);
	}

	/***************FUNCIONES****************/
	function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){
	    $ext = explode(".", $nombreimg);
	    $ext = $ext[count($ext)-1];

	    if($ext!="pdf"){

	        $datos = [
				"estatus" => 'error',
			];

			echo json_encode($datos);
	        exit;
	    }
	      
	    if($extension == 'pdf'){
		    unlink($location.'foto_cedula_con_cara.jpg');
		    unlink($location.'foto_cedula_con_cara.pdf');
		    move_uploaded_file ($_FILES['file']['tmp_name'],$location.'foto_cedula_con_cara.pdf');
		}

	    $x = imagesx($imagen);
	    $y = imagesy($imagen);
	          
	    if($x <= $xmax && $y <= $ymax){
	        return $imagen;
	    }
	      
	    if($x >= $y) {  
	        $nuevax = $xmax;  
	        $nuevay = $nuevax * $y / $x;  
	    }  
	    else {  
	        $nuevay = $ymax;  
	        $nuevax = $x / $y * $nuevay;  
	    }  

	    $img2 = imagecreatetruecolor($nuevax, $nuevay);
	    imagecopyresized($img2, $imagen, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);
	    return $img2;
	}
	/*******************************************/

	$imagen_temporal = $_FILES['file']['tmp_name'];
	$location = "../resources/documentos/nominas/archivos/".$id."/";
	$imagen_nombre = $_FILES['file']['name'];
	$imagen = getimagesize($_FILES['file']['tmp_name']);
	$ancho = $imagen[0];
	$alto = $imagen[1];
	$extension = explode(".", $imagen_nombre);
	$extension = $extension[count($extension)-1];

	if($ancho>$alto){
	    $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1920,1080);
	    imagejpeg($imagen_optimizada, $location.'firma_digital'.'.jpg');
	}else if($ancho<$alto){
	    $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1920);
	    imagejpeg($imagen_optimizada, $location.'firma_digital'.'.jpg');
	}else{
	    $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1080);
	    imagejpeg($imagen_optimizada, $location.'firma_digital'.'.jpg');
	}

	if($extension=='jpg'){}else{
	    $extension='jpg';
	}

	$documento = $_POST["condicion2"];

	$sql4 = "SELECT * FROM n_documentos WHERE nombre = '".$documento."'";
	$proceso4 = mysqli_query($conexion,$sql4);
	while($row4 = mysqli_fetch_array($proceso4)) {
		$documento_id = $row4['id'];
	}

	$sql3 = "DELETE FROM n_archivos WHERE id_documento = ".$documento_id." and id_nomina = ".$id;
	$eliminar1 = mysqli_query($conexion,$sql3);

	$sql2 = "INSERT INTO n_archivos (id_documento,id_nomina,responsable,fecha_inicio) VALUES ('$documento_id','$id','$responsable','$fecha_inicio')";
	$registro1 = mysqli_query($conexion,$sql2);

	$datos = [
		"estatus" => 'ok',
	];

	echo json_encode($datos);
}

