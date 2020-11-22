<?php
session_start();
include('conexion.php');
$tipo = $_POST['value'];
//$responsable = $_SESSION['id'];
//$fecha_inicio = date('Y-m-d');

$html = '';

switch ($tipo) {
	case 'descuento':
		$sqlTipo = "SELECT * FROM descuento";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
	break;

	case 'tienda':
		$sqlTipo = "SELECT * FROM tienda";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
	break;

	case 'avances':
		$sqlTipo = "SELECT * FROM avances";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
	break;

	case 'multas':
		$sqlTipo = "SELECT * FROM multas";
		$consulta2 = mysqli_query($conexion,$sqlTipo);
	break;
	
	default:
		$html .= '
			<div class="col-12 text-center">Sin resultados</div>
		';
		$datos = [
			"html" => $html,
		];
		echo json_encode($datos);
		exit;
	break;
}

$html .= '
	<table class="table" border="1">
		<thead>
			<tr>
				<th class="text-center">Tipo Documento</th>
				<th class="text-center">Número Documento</th>
				<th class="text-center">Modelo</th>
				<th class="text-center">Concepto</th>
				<th class="text-center">Valor</th>
				<th class="text-center">Fecha</th>
				<th class="text-center">Opción</th>
			</tr>
		</thead>
		<tbody>
';

while($row1 = mysqli_fetch_array($consulta2)) {
	$id_modelo = $row1['id_modelo'];
	$concepto = $row1['concepto'];
	$valor = $row1['valor'];
	$responsable = $row1['responsable'];
	$fecha_inicio = $row1['fecha_inicio'];

	$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo;
	$consulta3 = mysqli_query($conexion,$sql3);
	while($row2 = mysqli_fetch_array($consulta3)) {
		$tipo_documento = $row2['documento_tipo'];
		$numero_documento = $row2['documento_numero'];
		$nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
	}

	$html .= '
		<tr>
			<td class="text-center">'.$tipo_documento.'</td>
			<td class="text-center">'.$numero_documento.'</td>
			<td class="text-center">'.$nombre_modelo.'</td>
			<td class="text-center">'.$concepto.'</td>
			<td class="text-center">'.$valor.'</td>
			<td class="text-center">'.$fecha_inicio.'</td>
			<td class="text-center">
				<button class="btn btn-danger" type="button" onclick="borrar_extra1();">Pagado</button>
			</td>
		</tr>
	';
}

$html .= '
		</tbody>
	</table>
';

$datos = [
	"html" => $html,
];

echo json_encode($datos);



?>