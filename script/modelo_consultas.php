<?php
include('conexion.php');
$condicional = $_POST['condicional'];
$modelo_view = $_POST['modelo_view'];
$modelo_edit = $_POST['modelo_edit'];
$modelo_delete = $_POST['modelo_delete'];

if($condicional=='Sin filtros'){
	$consulta_macro = "SELECT * FROM modelos";
	$resultado_macro = mysqli_query( $conexion, $consulta_macro );
	$contador = mysqli_num_rows($resultado_macro);
}

if($condicional=='Filtrar Activas'){
	$consulta_macro = "SELECT * FROM modelos WHERE estatus = 'Activa'";
	$resultado_macro = mysqli_query( $conexion, $consulta_macro );
	$contador = mysqli_num_rows($resultado_macro);
}

if($condicional=='Filtrar Inactivas'){
	$consulta_macro = "SELECT * FROM modelos WHERE estatus = 'Inactiva'";
	$resultado_macro = mysqli_query( $conexion, $consulta_macro );
	$contador = mysqli_num_rows($resultado_macro);
}

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
	$modelo_correo 				= $row['correo'];
	$modelo_usuario 			= $row['usuario'];
	$modelo_telefono1 			= $row['telefono1'];
	$modelo_telefono2 			= $row['telefono2'];
	$modelo_turno 				= $row['turno'];
	$modelo_estatus 			= $row['estatus'];
	$modelo_sede 				= $row['sede'];
	$modelo_fecha_inicio 		= $row['fecha_inicio'];
	
	//for($a=0;$a<=100;$a++){
		echo '
			<tr>
				<td nowrap>'.$modelo_nombre1.' '.$modelo_nombre2.'</td>
				<td nowrap>'.$modelo_apellido1.' '.$modelo_apellido2.'</td>
				<td class="text-center">'.$modelo_documento_tipo.'</td>
				<td class="text-center">'.$modelo_documento_numero.'</td>
				<td class="text-center">'.$modelo_correo.'</td>
				<td class="text-center">'.$modelo_usuario.'</td>
				<td class="text-center">'.$modelo_telefono1.'</td>
				<td class="text-center">'.$modelo_turno.'</td>
				<td class="text-center">'.$modelo_estatus.'</td>
				<td class="text-center">'.$modelo_sede.'</td>
				<td>'.$modelo_fecha_inicio.'</td>
				<td class="text-center">
		';

			if($modelo_edit==1){
				echo '<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$modelo_id.'" data-toggle="modal" data-target="#exampleModal" onclick="modal_edit('.$modelo_id.');"></i>';
			}else{
				echo '<i class="fas fa-edit" style="color:#c3bebe; cursor:pointer;" data-toggle="popover-hover" data-placement="top" title="Deshabilitado" data-content="Falta de permisos"></i>';
			}
			
			if($modelo_delete==1){
				echo '<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" onclick="eliminar('.$modelo_id.');" value="'.$modelo_id.'"></i>';
			}else{
				echo '<i class="fas fa-trash-alt ml-3" style="color:#c3bebe; cursor:pointer;" data-toggle="popover-hover" data-placement="top" title="Deshabilitado" data-content="Falta de permisos"></i>';
			}

			echo '
				</td>
			</tr>';
	//}
}
?>