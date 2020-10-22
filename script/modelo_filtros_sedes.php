<?php
include('conexion.php');
$id = $_POST['variable'];
$sede = $_POST['sede'];
$contador = 0;

$consulta_macro = "SELECT * FROM modelos WHERE sede = ".$id;
$resultado_macro = mysqli_query($conexion,$consulta_macro);
$contador = mysqli_num_rows($resultado_macro);

if($contador==0){
	echo '
		<table id="example" class="table row-border hover table-bordered" >
			<tbody>

			</tbody>
		</table>
	';
	exit;
}

while($row = mysqli_fetch_array($resultado_macro)) {
	$modelo_id 					= $row['id'];
	$modelo_nombre1 			= $row['nombre1'];
	$modelo_nombre2 			= $row['nombre2'];
	$modelo_apellido1 			= $row['apellido1'];
	$modelo_apellido2 			= $row['apellido2'];
	$modelo_documento_tipo 		= $row['documento_tipo'];
	$modelo_documento_numero 	= $row['documento_numero'];
	$modelo_nickname 			= $row['sugerenciaNickname'];
	$modelo_turno 				= $row['turno'];
	$modelo_sede 				= $row['sede'];
	$modelo_telefono1 			= $row['telefono1'];
	$modelo_fecha_inicio 		= $row['fecha_inicio'];
	//$modelo_correo 			= $row['correo'];
	//$modelo_usuario 			= $row['usuario'];
	//$modelo_telefono2 		= $row['telefono2'];
	//$modelo_estatus 			= $row['estatus'];

	$sql_sede = "SELECT * FROM sedes WHERE id = ".$modelo_sede;
	$resultado_sede = mysqli_query($conexion,$sql_sede);
	while($row2 = mysqli_fetch_array($resultado_sede)) {
		$sede_nombre = $row2['nombre'];
	}

	$sql_responsable1 = "SELECT * FROM soporte_responsable_modelo WHERE id_modelo = ".$modelo_id;
	$resultado3 = mysqli_query($conexion,$sql_responsable1);
	$contador2 = mysqli_num_rows($resultado3);

	if($contador2>=1){
		while($row6 = mysqli_fetch_array($resultado3)) {
			$soporte_responsable_id = $row6['id_soporte'];
		}

		$sql_responsable2 = "SELECT * FROM usuarios WHERE id = ".$soporte_responsable_id;
		$resultado4 = mysqli_query($conexion,$sql_responsable2);
		while($row7 = mysqli_fetch_array($resultado4)) {
			$soporte_responsable_id = $row7['id'];
			$soporte_responsable_usuario = $row7['usuario'];
		}
	}

	$sql_responsable3 = "SELECT * FROM usuarios WHERE rol = 9";
	$resultado5 = mysqli_query($conexion,$sql_responsable3);

	/*
	$sql_responsable1 = "SELECT * FROM soporte_responsable_modelo WHERE id_modelo = ".$modelo_id;
	$resultado3 = mysqli_query($conexion,$sql_responsable1);
	$contador2 = mysqli_num_rows($resultado3);

	if($contador2>=1){
		while($row6 = mysqli_fetch_array($resultado3)) {
			$soporte_responsable_id = $row6['id_soporte'];
		}

		$sql_responsable2 = "SELECT * FROM usuarios WHERE id = ".$soporte_responsable_id;
		$resultado4 = mysqli_query($conexion,$sql_responsable2);
		while($row7 = mysqli_fetch_array($resultado4)) {
			$soporte_responsable_usuario = $row7['usuario'];
		}
	}
	*/
	
		echo '
			<tr>
		';

		if($contador2>=1){
			echo '
				<td class="text-center">
					<select class="form-control" id="select_responsable_'.$modelo_id.'" onchange="colocar_responsable('.$modelo_id.',value);">
						<option value="">Nadie</option>
					';
					
					while($row9 = mysqli_fetch_array($resultado5)) {
						$soporte_responsable_id_general = $row9['id'];
						$soporte_responsable_usuario_general = $row9['usuario'];
						if($soporte_responsable_id == $soporte_responsable_id_general){
							echo '
								<option value="'.$soporte_responsable_id_general.'" selected="selected">'.$soporte_responsable_usuario_general.'</option>
							';	
						}else{
							echo '
								<option value="'.$soporte_responsable_id_general.'">'.$soporte_responsable_usuario_general.'</option>
							';
						}
					}
					
					echo '
						</select>
					</td>
					';
		}else{
			echo '
				<td class="text-center">
					<select class="form-control" id="select_responsable_'.$modelo_id.'" onchange="colocar_responsable('.$modelo_id.',value);">
						<option value="">Nadie</option>
						';
						while($row9 = mysqli_fetch_array($resultado5)) {
							$soporte_responsable_id_general = $row9['id'];
							$soporte_responsable_usuario_general = $row9['usuario'];
							echo '
								<option value="'.$soporte_responsable_id_general.'">'.$soporte_responsable_usuario_general.'</option>
							';
						}
						echo '
							</select>
						</td>
						';
		}

		echo '
				<!--
				<td class="text-center">
					<p style="font-weight:bold;"> '.$soporte_responsable_usuario.'</p> 
					<i class="fas fa-chalkboard-teacher" value="'.$modelo_id.'" style="font-size: 20px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_responsable1" onclick="modal_responsable1('.$modelo_id.');"></i>
				</td>
				-->
				<td nowrap>'.$modelo_nombre1.' '.$modelo_nombre2.'</td>
				<td nowrap>'.$modelo_apellido1.' '.$modelo_apellido2.'</td>
				<td class="text-center">'.$modelo_documento_tipo.'</td>
				<td class="text-center">'.$modelo_documento_numero.'</td>
				<td class="text-center">'.$modelo_nickname.'</td>
				<td class="text-center">'.$modelo_turno.'</td>
				<td class="text-center">'.$sede_nombre.'</td>
				<td class="text-center">'.$modelo_telefono1.'</td>
				<td class="text-center">'.$modelo_fecha_inicio.'</td>
				<td class="text-center">
					<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$modelo_id.'" data-toggle="modal" data-target="#exampleModal_soporte1" onclick="modal_edit2('.$modelo_id.');"></i>
				</td>
				<td class="text-center">
					<i class="fas fa-camera-retro" style="cursor:pointer; font-size:20px;" title="" value="'.$modelo_id.'" data-toggle="modal" data-target="#Modal_fotos1" onclick="fotos1('.$modelo_id.');"></i>
					<i class="fas fa-images ml-3" style="cursor:pointer; font-size:20px;" title="" value="'.$modelo_id.'" data-toggle="modal" data-target="#Modal_fotos2" onclick="fotos2('.$modelo_id.');"></i>
				</td>
				<td class="text-center">
					<i class="fas fa-user-shield" style="cursor:pointer; font-size:20px;" data-toggle="modal" data-target="#Modal_cuentas1" onclick="cuentas('.$modelo_id.');"></i>
					<i class="fas fa-user-plus ml-3" style="cursor:pointer; font-size:20px;" data-toggle="modal" data-target="#Modal_cuentas2" onclick="cuentas2('.$modelo_id.');"></i>
				</td>
			</tr>
		';
}
?>