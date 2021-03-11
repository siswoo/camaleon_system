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
								<option value="">Seleccione</option>
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
								<option value="">Seleccione</option>
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

?>