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
	$fecha_expedicion 	= $_POST['fecha_expedicion'];
	$funcion 			= $_POST['funcion'];
	$contrato 			= $_POST['contrato'];
	$clave = md5($numero_documento);

	$sql2 = "SELECT * FROM nomina WHERE documento_numero = '".$numero_documento."'";
	$consulta2 = mysqli_query($conexion,$sql2);
	$contador1 = mysqli_num_rows($consulta2);

	if($contador1>=1){
		$datos = [
			"estatus" => 'repetido',
		];
		echo json_encode($datos);
	}else{
		$sql1 = "INSERT INTO nomina (nombre,apellido,documento_tipo,documento_numero,genero,correo,direccion,salario,telefono,estatus,fecha_inicio,turno,sede,cargo,fecha_nacimiento,fecha_ingreso,clave,fecha_expedicion,funcion,contrato) VALUES ('$nombre','$apellido','$tipo_documento','$numero_documento','$genero','$correo','$direccion','$salario','$telefono','Aceptado','$fecha_inicio','$turno','$sedes','$cargo','$fecha_nacimiento','$fecha_ingreso','$clave','$fecha_expedicion','$funcion','$contrato')";
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
		$fecha_retiro = $row1['fecha_retiro'];
		$fecha_expedicion = $row1['fecha_expedicion'];
		$funcion = $row1['funcion'];
		$contrato = $row1['contrato'];

		$emergencia_nombre = $row1['emergencia_nombre'];
		$emergencia_telefono = $row1['emergencia_telefono'];
		$emergencia_parentesco = $row1['emergencia_parentesco'];
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
		"fecha_retiro" => $fecha_retiro,
		"fecha_expedicion" => $fecha_expedicion,
		"funcion" => $funcion,
		"contrato" => $contrato,
		"emergencia_nombre" => $emergencia_nombre,
		"emergencia_telefono" => $emergencia_telefono,
		"emergencia_parentesco" => $emergencia_parentesco,
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
	$fecha_retiro = $_POST['fecha_retiro'];
	$fecha_expedicion = $_POST['fecha_expedicion'];
	$funcion = $_POST['funcion'];
	$contrato = $_POST['contrato'];

	if($estatus=='Aceptado'){
		$fecha_retiro = '';
	}

	$sql1 = "UPDATE nomina SET documento_tipo = '$tipo_documento', documento_numero = '$numero_documento', nombre = '$nombre', apellido = '$apellido', genero = '$genero', correo = '$correo', direccion = '$direccion', salario = '$salario', turno = '$turno', telefono = '$telefono', cargo = '$cargo', sede = '$sedes', estatus = '$estatus', fecha_nacimiento = '$fecha_nacimiento', fecha_ingreso = '$fecha_ingreso', fecha_retiro = '$fecha_retiro', fecha_expedicion = '$fecha_expedicion', funcion = '$funcion', contrato = '$contrato' WHERE id = ".$id;
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
		"fecha_retiro" => $fecha_retiro,
		"contrato" => $contrato,
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
	$condicion2 = $_POST['condicion2'];
	$condicion3 = $_POST['condicion3'];

	$imagen_temporal = $_FILES['file']['tmp_name'];
	$location = "../resources/documentos/nominas/archivos/".$id."/";
	$imagen_nombre = $_FILES['file']['name'];
	$imagen = getimagesize($_FILES['file']['tmp_name']);
	$ancho = $imagen[0];
	$alto = $imagen[1];
	$extension = explode(".", $imagen_nombre);
	$extension = $extension[count($extension)-1];

	if(file_exists('../resources/documentos/nominas/archivos/'.$id)){}else{
    	mkdir('../resources/documentos/nominas/archivos/'.$id, 0777);
	}

	if($extension == 'pdf'){
		@unlink($location.$condicion3.'.pdf');
		move_uploaded_file ($_FILES['file']['tmp_name'],$location.$condicion3.'.pdf');
	}

	if($extension!="pdf"){
        $datos = [
			"estatus" => 'error',
		];
		echo json_encode($datos);
		exit;
    }

	$sql4 = "SELECT * FROM n_documentos WHERE nombre = '".$condicion2."'";
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

if($condicion=='guardar_bancarios'){
	$id = $_POST['id'];
	$BCPP = $_POST['BCPP'];
	$banco_cedula = $_POST['banco_cedula'];
	$banco_nombre = $_POST['banco_nombre'];
	$banco_tipo = $_POST['banco_tipo'];
	$banco_numero = $_POST['banco_numero'];
	$banco_banco = $_POST['banco_banco'];

	$sql1 = "UPDATE nomina SET banco_cedula = '".$banco_cedula."', banco_nombre = '".$banco_nombre."', banco_tipo = '".$banco_tipo."', banco_numero = '".$banco_numero."', banco_banco = '".$banco_banco."', BCPP = '".$BCPP."' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
		"sql" => $sql1,
	];

	echo json_encode($datos);
}

if($condicion=='guardar_emergencia'){
	$id = $_POST['id'];
	$emergencia_nombre = $_POST['emergencia_nombre'];
	$emergencia_telefono = $_POST['emergencia_telefono'];
	$emergencia_parentesco = $_POST['emergencia_parentesco'];

	$sql1 = "UPDATE nomina SET emergencia_nombre = '".$emergencia_nombre."', emergencia_telefono = '".$emergencia_telefono."', emergencia_parentesco = '".$emergencia_parentesco."' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
	];

	echo json_encode($datos);
}

if($condicion=='consultar_bancarios1'){
	$id = $_POST['id'];

	$sql1 = "SELECT * FROM nomina WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	while($row1 = mysqli_fetch_array($proceso1)) {
		$banco_cedula = $row1['banco_cedula'];
		$banco_nombre = $row1['banco_nombre'];
		$banco_tipo = $row1['banco_tipo'];
		$banco_numero = $row1['banco_numero'];
		$banco_banco = $row1['banco_banco'];
		$bcpp = $row1['BCPP'];
	}

	$datos = [
		"estatus" => 'ok',
		"banco_cedula" => $banco_cedula,
		"banco_nombre" => $banco_nombre,
		"banco_tipo" => $banco_tipo,
		"banco_numero" => $banco_numero,
		"banco_banco" => $banco_banco,
		"bcpp" => $bcpp,
	];

	echo json_encode($datos);
}


if($condicion=='modificar_bancarios1'){
	$id = $_POST['id'];
	$bcpp = $_POST['bcpp'];
	$banco_cedula = $_POST['banco_cedula'];
	$banco_nombre = $_POST['banco_nombre'];
	$banco_tipo = $_POST['banco_tipo'];
	$banco_numero = $_POST['banco_numero'];
	$banco_banco = $_POST['banco_banco'];

	$sql1 = "UPDATE nomina SET banco_cedula = '$banco_cedula', banco_nombre = '$banco_nombre', banco_tipo = '$banco_tipo', banco_numero = '$banco_numero', banco_banco = '$banco_banco', BCPP = '$bcpp' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
	];

	echo json_encode($datos);
}

if($condicion=='documentos1'){
	$id = $_POST['id'];

	$sql1 = "SELECT * FROM n_archivos WHERE id_nomina = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$html = '
		<div class="row">
			<input type="hidden" name="edit_documento_id" id="edit_documento_id" value="'.$id.'">
	';
	$contador1 = mysqli_num_rows($proceso1);
	while($row1 = mysqli_fetch_array($proceso1)) {
		$id_documento = $row1["id_documento"];
		$sql2 = "SELECT * FROM n_documentos WHERE id = ".$id_documento;
		$proceso2 = mysqli_query($conexion,$sql2);
		while($row2 = mysqli_fetch_array($proceso2)) {
			switch ($row2["id"]) {
				case '1':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/seguridad_social.pdf" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;

				case '2':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/eps.pdf" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;

				case '3':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/fondo_de_pension.pdf" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;

				case '4':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/arl.pdf" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;

				case '5':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/antecedentes_penales.pdf" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;

				case '6':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/hoja_de_vida.pdf" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;

				case '7':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/identificacion.pdf" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;

				case '8':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/firma_digital.jpg" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;

				case '9':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/rut.pdf" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;

				case '10':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/certificacion_bancaria.pdf" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;

				case '11':
					$html .= '
						<div class="col-12 text-center" id="div_documento1_'.$row2["id"].'">
							<label style="text-transform: capitalize;">'.$row2["nombre"].'</label>
							<br>
							<embed src="../resources/documentos/nominas/archivos/'.$id.'/acta_cuenta_prestada.jpg" type="application/pdf" width="100%" height="300px" style="">
							<button type="button" class="btn btn-danger" onclick="eliminar2('.$id.','.$row2["id"].');">Eliminar</button>
							<hr style="background-color:black;">
						</div>
					';
				break;
				
				default:
					# code...
					break;
			}
		}
	}
	$html .= '
		</div>
	';

	if($contador1==0){
		$html = '
			<div class="col-12 text-center" style="font-weight:bold; font-size: 20px;">
				Sin Documentos Subidos Actualmente
			</div>
		';
	}

	$datos = [
		"estatus" => 'ok',
		"html" => $html,
	];

	echo json_encode($datos);
}



if($condicion=='contrato1'){
	$id = $_POST['id'];

	$sql1 = "SELECT * FROM n_archivos WHERE id_nomina = ".$id." and id_documento = 8";
	$proceso1 = mysqli_query($conexion,$sql1);

	$sql3 = "SELECT * FROM nomina WHERE id = ".$id;
	$proceso3 = mysqli_query($conexion,$sql3);
	while($row3 = mysqli_fetch_array($proceso3)) {
		$contrato = $row3["contrato"];
		$funcion = $row3["funcion"];
	}

	$html = '
		<div class="row">
			<input type="hidden" name="edit_contrato_id" id="edit_contrato_id" value="'.$id.'">
	';
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1==0){
		$html .= '
			<div class="col-12 text-center mt-3" style="font-weight:bold; font-size:20px;">No Ha Firmado el Contrato</div>
		';
	}else if($contrato==0){
		$html .= '
			<div class="col-12 text-center mt-3" style="font-weight:bold; font-size:20px;">No se le ha asignado un contrato</div>
		';
	}else if($funcion==0){
		$html .= '
			<div class="col-12 text-center mt-3" style="font-weight:bold; font-size:20px;">No se le ha asignado una función</div>
		';
	}else{
		while($row1 = mysqli_fetch_array($proceso1)) {
			$sql2 = "SELECT * FROM nomina WHERE id = ".$id;
			$proceso2 = mysqli_query($conexion,$sql2);
			while($row2 = mysqli_fetch_array($proceso2)) {
				$sede = $row2["sede"];
				$cargo = $row2["cargo"];
				$funcion = $row2["funcion"];
				$contrato = $row2["contrato"];
				$html .= '
					<div class="col-12 text-center">
						<label style="text-transform: capitalize;">Firma de Contrato</label>
						<br>
						<embed src="../script/generador_nomina_contrato2.php?id='.$id.'" type="application/pdf" width="100%" height="300px" style="">
					</div>
				';
			}
		}
	}

	$html .= '
		</div>
	';

	$datos = [
		"estatus" => 'ok',
		"html" => $html,
	];

	echo json_encode($datos);
}



if($condicion=='cambiar_clave1'){
	$id = $_POST['id'];
	$clave_password1 = md5($_POST['clave_password1']);
	$clave_password2 = $_POST['clave_password2'];

	$sql1 = "UPDATE nomina SET clave = '".$clave_password1."' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
		"sql" => $sql1,
	];

	echo json_encode($datos);
}

if($condicion=='eliminar2'){
	$id = $_POST['id'];
	$id_documento = $_POST['id_documento'];

	$sql1 = "DELETE FROM n_archivos WHERE id_nomina = $id and id_documento = $id_documento";
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
		"sql" => $sql1,
	];

	echo json_encode($datos);
}

if($condicion=='subir_archivo2'){

	$id_nomina = $_POST["id"];
	
	if(file_exists('../resources/documentos/nominas/archivos/'.$id_nomina)){}else{
    	mkdir('../resources/documentos/nominas/archivos/'.$id_nomina, 0777);
	}

	function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){
	    $ext = explode(".", $nombreimg);
	    $ext = $ext[count($ext)-1];

	    if($ext!="jpg" && $ext!="jpeg" && $ext!="png" && $ext!="gif"){
	        echo 'error';
	        exit;
	    }
	      
	    if($ext == "jpg" || $ext == "jpeg")  
	        $imagen = imagecreatefromjpeg($rutaimg);
	    elseif($ext == "png")  
	        $imagen = imagecreatefrompng($rutaimg);
	    elseif($ext == "gif")  
	        $imagen = imagecreatefromgif($rutaimg);

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

	$imagen_temporal = $_FILES['file']['tmp_name'];
	$location = "../resources/documentos/nominas/archivos/".$id_nomina."/";
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

	$sql3 = "DELETE FROM n_archivos WHERE id_documentos = 8 and id_nomina = ".$id_nomina;
	$eliminar1 = mysqli_query($conexion,$sql3);

	$sql2 = "INSERT INTO n_archivos (id_nomina,id_documento,responsable,fecha_inicio) VALUES ($id_nomina,8,'$responsable','$fecha_inicio')";
	$registro1 = mysqli_query($conexion,$sql2);


	$datos = [
		"estatus" => 'ok',
	];

	echo json_encode($datos);
}

if($condicion=='subir_archivo3'){
	$id = $_POST['id'];
	$condicion2 = $_POST['condicion2'];
	$condicion3 = $_POST['condicion3'];

	$banco_cedula = $_POST['banco_cedula'];
	$banco_nombre = $_POST['banco_nombre'];
	$banco_tipo = $_POST['banco_tipo'];
	$banco_numero = $_POST['banco_numero'];
	$banco_banco = $_POST['banco_banco'];
	$bcpp = $_POST['bcpp'];

	if(file_exists('../resources/documentos/nominas/archivos/'.$id)){}else{
    	mkdir('../resources/documentos/nominas/archivos/'.$id, 0777);
	}

	function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){
	    $ext = explode(".", $nombreimg);
	    $ext = $ext[count($ext)-1];

	    if($ext!="jpg" && $ext!="jpeg" && $ext!="png" && $ext!="gif"){
	        $datos = [
				"estatus" => 'error',
			];
			echo json_encode($datos);
	        exit;
	    }
	      
	    if($ext == "jpg" || $ext == "jpeg")  
	        $imagen = imagecreatefromjpeg($rutaimg);
	    elseif($ext == "png")  
	        $imagen = imagecreatefrompng($rutaimg);
	    elseif($ext == "gif")  
	        $imagen = imagecreatefromgif($rutaimg);

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

	if(@$_FILES['file']!=null and $bcpp=="Prestada"){
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
		    imagejpeg($imagen_optimizada, $location.$condicion3.'.jpg');
		}else if($ancho<$alto){
		    $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1920);
		    imagejpeg($imagen_optimizada, $location.$condicion3.'.jpg');
		}else{
		    $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1080);
		    imagejpeg($imagen_optimizada, $location.$condicion3.'.jpg');
		}

		if($extension=='jpg'){}else{
		    $extension='jpg';
		}

		$sql4 = "SELECT * FROM n_documentos WHERE nombre = '".$condicion2."'";
		$proceso4 = mysqli_query($conexion,$sql4);
		while($row4 = mysqli_fetch_array($proceso4)) {
			$documento_id = $row4['id'];
		}

		$sql3 = "DELETE FROM n_archivos WHERE id_documento = ".$documento_id." and id_nomina = ".$id;
		$eliminar1 = mysqli_query($conexion,$sql3);

		$sql2 = "INSERT INTO n_archivos (id_documento,id_nomina,responsable,fecha_inicio) VALUES ('$documento_id','$id','$responsable','$fecha_inicio')";
		$registro1 = mysqli_query($conexion,$sql2);
	}

	$sql3 = "UPDATE nomina SET banco_cedula = '$banco_cedula', banco_nombre = '$banco_nombre', banco_tipo = '$banco_tipo', banco_numero = '$banco_numero', banco_banco = '$banco_banco', BCPP = '$bcpp' WHERE id = ".$id;
	$proceso3 = mysqli_query($conexion,$sql3);

	$datos = [
		"estatus" => 'ok',
		"sql3" => $sql3,
	];

	echo json_encode($datos);
}
