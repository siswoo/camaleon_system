<?php
include('conexion.php');
$id = $_POST['variable'];
$contador = 0;

if($id == ''){
	$sql1 = "SELECT * FROM modelos";
	$consulta1 = mysqli_query($conexion,$sql1);
	while($row2 = mysqli_fetch_array($consulta1)) {
		$modelo_id 					= $row2['id'];
		$modelo_nombre1 			= $row2['nombre1'];
		$modelo_nombre2 			= $row2['nombre2'];
		$modelo_apellido1 			= $row2['apellido1'];
		$modelo_apellido2 			= $row2['apellido2'];
		$modelo_documento_tipo 		= $row2['documento_tipo'];
		$modelo_documento_numero 	= $row2['documento_numero'];
		$modelo_nickname 			= $row2['sugerenciaNickname'];
		$modelo_turno 				= $row2['turno'];
		$modelo_sede 				= $row2['sede'];
		$modelo_telefono1 			= $row2['telefono1'];
		$modelo_fecha_inicio 		= $row2['fecha_inicio'];

		$sql_sede = "SELECT * FROM sedes WHERE id = ".$modelo_sede;
		$resultado_sede = mysqli_query($conexion,$sql_sede);
		while($row2 = mysqli_fetch_array($resultado_sede)) {
			$sede_nombre = $row2['nombre'];
		}
	
		echo '
			<tr>
				<td class="text-center">
					<i class="fas fa-chalkboard-teacher" value="'.$modelo_id.'" style="font-size: 20px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_responsable1" onclick="modal_responsable1('.$modelo_id.');"></i>
				</td>
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
	exit;
}

$consulta_macro = "SELECT * FROM soporte_responsable_modelo WHERE id_soporte = ".$id;
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
	$sql1 = "SELECT * FROM modelos WHERE id = ".$row['id_modelo'];
	$consulta1 = mysqli_query($conexion,$sql1);
	$html_responsable = '';
	while($row2 = mysqli_fetch_array($consulta1)) {
		$modelo_id 					= $row2['id'];
		$modelo_nombre1 			= $row2['nombre1'];
		$modelo_nombre2 			= $row2['nombre2'];
		$modelo_apellido1 			= $row2['apellido1'];
		$modelo_apellido2 			= $row2['apellido2'];
		$modelo_documento_tipo 		= $row2['documento_tipo'];
		$modelo_documento_numero 	= $row2['documento_numero'];
		$modelo_nickname 			= $row2['sugerenciaNickname'];
		$modelo_turno 				= $row2['turno'];
		$modelo_sede 				= $row2['sede'];
		$modelo_telefono1 			= $row2['telefono1'];
		$modelo_fecha_inicio 		= $row2['fecha_inicio'];

		$sql_sede = "SELECT * FROM sedes WHERE id = ".$modelo_sede;
		$resultado_sede = mysqli_query($conexion,$sql_sede);
		while($row2 = mysqli_fetch_array($resultado_sede)) {
			$sede_nombre = $row2['nombre'];
		}

		$contador1 = 0;
		$sql2 = "SELECT * FROM usuarios WHERE id = ".$id;
		$consulta2 = mysqli_query($conexion,$sql2);
		while($row3 = mysqli_fetch_array($consulta2)) {
			$soporte_nombre = $row3['nombre'];
			$html_responsable .= " | ".$soporte_nombre." | ";
			$contador1 = $contador1+1;
		}

		if($contador1>=2){
			$html_contador1 = 'Y ('.$contador1.')';
		}else{
			$html_contador1 = '';
		}
	
		echo '
			<tr>
				<td class="text-center">
					<p>'.$html_responsable.' '.$html_contador1.'</p>
					<i class="fas fa-chalkboard-teacher" value="'.$modelo_id.'" style="font-size: 20px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_responsable1" onclick="modal_responsable1('.$modelo_id.');"></i>
				</td>
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
}
?>