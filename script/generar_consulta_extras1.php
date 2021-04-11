<?php
session_start();
include('conexion.php');
$tipo = $_POST['value'];
//$responsable = $_SESSION['id'];
//$fecha_inicio = date('Y-m-d');

$html = '';

if($_SESSION['rol']==1){
	$extra = '';
}else{
	$extra = ' and sede = '.$_SESSION['sede'];
	//$extra = '';
}

switch ($tipo) {
	case 'Todos':
		$sqlTipo = "";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['valor'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'descuento':
		$sqlTipo = "SELECT * FROM descuento WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['valor'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'tienda':
		$sqlTipo = "SELECT * FROM tienda WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['valor'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'avances':
		$sqlTipo = "SELECT * FROM avances WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['valor'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'multas':
		$sqlTipo = "SELECT * FROM multas WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['valor'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'bonos_horas':
		$sqlTipo = "SELECT * FROM bonos_horas WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['monto'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'bonos_streamate':
		$sqlTipo = "SELECT * FROM bonos_streamate WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['monto'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'odontologia':
		$sqlTipo = "SELECT * FROM odontologia WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['monto'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'seguridad_social':
		$sqlTipo = "SELECT * FROM seguridad_social WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['monto'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'coopserpak':
		$sqlTipo = "SELECT * FROM coopserpak WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['monto'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'sexshop':
		$sqlTipo = "SELECT * FROM sexshop WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['monto'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'belleza':
		$sqlTipo = "SELECT * FROM belleza WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['monto'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'sancionpagina':
		$sqlTipo = "SELECT * FROM sancionpagina WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['monto'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_desde.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;

	case 'lenceria':
		$sqlTipo = "SELECT * FROM lenceria WHERE estado = 'Activo'";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
		$contador2 = mysqli_num_rows($consulta2);
		while($row1 = mysqli_fetch_array($consulta2)) {
			$id_tipo = $row1['id'];
			$id_modelo = $row1['id_modelo'];
			$concepto = $row1['concepto'];
			$valor = $row1['monto'];
			$responsable = $row1['responsable'];
			$fecha_inicio = $row1['fecha_inicio'];
			$fecha_desde = $row1['fecha_desde'];

			$sql5 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			$consulta5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($consulta5)) {
				$nombre_responsable = $row5['nombre']." ".$row5['apellido'];
			}

			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo.$extra;
			$consulta3 = mysqli_query($conexion,$sql3);
			$contador1 = mysqli_num_rows($consulta3);
			if($contador1>=1){
				while($row2 = mysqli_fetch_array($consulta3)) {
					$tipo_documento = $row2['documento_tipo'];
					$numero_documento = $row2['documento_numero'];
					$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
					$sede = $row2['sede'];
					$sql4 = "SELECT * FROM sedes WHERE id = ".$sede;
					$consulta4 = mysqli_query($conexion,$sql4);
					while($row3 = mysqli_fetch_array($consulta4)) {
						$sede_nombre = $row3['nombre'];
					}
					$html .= '
						<tr id="tr_'.$id_tipo.'">
							<td class="text-center">'.$sede_nombre.'</td>
							<td class="text-center">'.$tipo_documento.'</td>
							<td class="text-center">'.$numero_documento.'</td>
							<td class="text-center">'.$nombre_modelo.'</td>
							<td class="text-center">'.$concepto.'</td>
							<td class="text-center">'.$valor.'</td>
							<td class="text-center">'.$fecha_inicio.'</td>
							<td class="text-center">'.$nombre_responsable.'</td>
							<td class="text-center">
								<button class="btn btn-danger" type="button" value="'.$tipo.'" onclick="borrar_extra1('.$id_tipo.',value);">Eliminar</button>
							</td>
						</tr>
					';
				}
			}
		}
	break;
	
	default:/*
		$html .= '
			<div class="col-12 text-center">Sin resultados</div>
		';
		*/
		$html .= '
		
		';
		$datos = [
			"html" => $html,
			"sql" => $sql3,
		];
		echo json_encode($datos);
		exit;
	break;
}

if($contador2==0){
	$html .= '
		
	';
}else{
	$contador1 = mysqli_num_rows($consulta3);
	if($contador1==0){
		$html .= '
			
		';
	}
}

$datos = [
	"html" => $html,
];

echo json_encode($datos);



?>