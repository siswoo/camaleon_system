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
	
		echo '
			<tr>
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