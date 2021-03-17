<?php
include('conexion.php');
$condicion = $_POST['condicion'];

if($condicion=="consultar1"){
	$turno = $_POST['turno'];
	$fecha = $_POST['fecha'];
	$condicion1 = $_POST['condicion1'];
	$html = '';

	if($condicion1=='Consultar'){
		$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa' and turno = '$turno'";
		$consulta1 = mysqli_query($conexion,$sql1);
		$contador1 = mysqli_num_rows($consulta1);
		
		if($contador1>=1){
			while($row1 = mysqli_fetch_array($consulta1)) {
				$id = $row1['id'];
				$nombre = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
				$nickname = $row1['sugerenciaNickname'];
				$fecha_inicio = $row1['fecha_inicio'];
				$estatus = $row1['estatus'];

				$sql2 = "SELECT * FROM personal1 WHERE id_modelo = ".$id." and fecha_asignada = '".$fecha."'";
				$consulta2 = mysqli_query($conexion,$sql2);
				while($row2 = mysqli_fetch_array($consulta2)) {
					$html .= '
						<tr id="tr_'.$id.'">
							<td>'.$nombre.'</td>
							<td class="text-center">'.$turno.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td>
								<input type="text" class="form-control" id="observacion_'.$id.'" name="observacion_'.$id.'">
							</td>
							<td>
								<select class="form-control" id="fotos_'.$id.'" name="fotos_'.$id.'">
									<option value="">Seleccione</option>
									<option value="Si">Si</option>
									<option value="Pasaporte">Pasaporte</option>
									<option value="Montaje">Montaje</option>
									<option value="No">No</option>
								</select>
							</td>
							<td class="text-center">'.$nickname.'</td>
							<td class="text-center">
								<select class="form-control" id="estatus_'.$id.'" name="estatus_'.$id.'">
					';
					if($estatus=='Activa'){
						$html .= '
							<option value="Activa" selected="selected">Activa</option>
							<option value="Inactiva">Inactiva</option>
						';	
					}else{
						$html .= '
							<option value="Activa">Activa</option>
							<option value="Inactiva" selected="selected">Inactiva</option>
						';
					}

					$html .= '
							</td>
							<td class="text-center">
								<button type="button" onclick="guardar1('.$id.');" class="btn btn-primary">Guardar</button>
							</td>
						</tr>
					';
				}
			}
		}
	}else if($condicion1=='Agregar'){
		$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa' and turno = '$turno'";
		$consulta1 = mysqli_query($conexion,$sql1);
		$contador1 = mysqli_num_rows($consulta1);
		
		if($contador1>=1){
			while($row1 = mysqli_fetch_array($consulta1)) {
				$id = $row1['id'];
				$nombre = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
				$nickname = $row1['sugerenciaNickname'];
				$fecha_inicio = $row1['fecha_inicio'];

				$html .= '
					<tr id="tr_'.$id.'">
						<td>
							<input type="hidden" name="nombre_'.$id.'" id="nombre_'.$id.'" value="'.$nombre.'">
							'.$nombre.'
						</td>
						<td class="text-center">
							<input type="hidden" name="turno_'.$id.'" id="turno_'.$id.'" value="'.$turno.'">
							'.$turno.'
						</td>
						<td class="text-center">
							<input type="hidden" name="fecha_inicio_'.$id.'" id="fecha_inicio_'.$id.'" value="'.$fecha_inicio.'">
							'.$fecha_inicio.'
						</td>
						<td>
							<input type="text" class="form-control" id="observacion_'.$id.'" name="observacion_'.$id.'">
						</td>
						<td>
							<select class="form-control" id="fotos_'.$id.'" name="fotos_'.$id.'">
								<option value="">Seleccione</option>
								<option value="Si">Si</option>
								<option value="Pasaporte">Pasaporte</option>
								<option value="Montaje">Montaje</option>
								<option value="No">No</option>
							</select>
						</td>
						<td class="text-center">
							<input type="hidden" name="nickname_'.$id.'" id="nickname_'.$id.'" value="'.$nickname.'">
							'.$nickname.'
						</td>
						<td class="text-center">
							<select class="form-control" id="estatus_'.$id.'" name="estatus_'.$id.'" onchange="cambiar_estatus1('.$id.')">
								<option value="Activa">Activa</option>
								<option value="Inactiva">Inactiva</option>
							</select>
						</td>
						<td class="text-center">
							<button type="button" onclick="guardar1('.$id.');" class="btn btn-primary">Guardar</button>
						</td>
					</tr>
				';
			}
		}
	}

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
		"html" => $html,
	];

	echo json_encode($datos);
}



if($condicion=="guardar1"){
	$id = $_POST['id_modelo'];
	$nombre = $_POST['nombre'];
	$turno = $_POST['turno'];
	$fecha_inicio = $_POST['fecha_inicio'];
	$observacion = $_POST['observacion'];
	$fotos = $_POST['fotos'];
	$nickname = $_POST['nickname'];
	$estatus = $_POST['estatus'];
	$fecha = $_POST['fecha'];
	$html = '';

	$sql1 = "SELECT * FROM personal1 WHERE id_modelo = ".$id." and fecha = '".$fecha."'";
	$consulta1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($consulta1);
		
	if($contador1>=1){
		while($row1 = mysqli_fetch_array($consulta1)) {
			$sql2 = "UPDATE personal1 SET observacion = '".$observacion."', fotos = '".$fotos."', estatus = '".$estatus."' WHERE id_modelo = ".$id." and fecha = '".$fecha."'";
			$consulta2 = mysqli_query($conexion,$sql2);
		}
	}else{
		$sql2 = "INSERT INTO personal1 (id_modelo, turno, observacion, fotos, nickname, responsable, fecha_asignada, fecha_inicio) VALUES ('$as','$as','$as','$as','$as','$as','$as')";
		$consulta2 = mysqli_query($conexion,$sql2);
	}

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
		"sql2" => $sql12,
		"html" => $html,
	];

	echo json_encode($datos);
}

if($condicion=="estatus1"){
	$id = $_POST['id_modelo'];
	$fecha = $_POST['fecha'];

	$sql1 = "SELECT * FROM personal1 WHERE id_modelo = ".$id." and fecha = '".$fecha."'";
	$consulta1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($consulta1);

	if($contador1>=1){
		while($row1 = mysqli_fetch_array($consulta1)) {
			$sql2 = "UPDATE personal1 SET observacion = '".$observacion."', fotos = '".$fotos."', estatus = '".$estatus."' WHERE id_modelo = ".$id." and fecha = '".$fecha."'";
			$consulta2 = mysqli_query($conexion,$sql2);
		}
	}else{
		$sql2 = "INSERT INTO personal1 (id_modelo, turno, observacion, fotos, nickname, responsable, fecha_asignada, fecha_inicio) VALUES ('$id','$turno','$as','$as','$as','$as','$as')";
		$consulta2 = mysqli_query($conexion,$sql2);
	}

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
		"sql2" => $sql12,
	];

	echo json_encode($datos);
}

?>