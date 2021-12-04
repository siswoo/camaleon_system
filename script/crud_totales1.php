<?php
include('conexion.php');
session_start();
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
$fecha_creacion = date("Y-m-d");
$responsable = $_SESSION["id"];
$condicion = $_POST['condicion'];

if($condicion=='resultado1'){
	$value = $_POST['value'];
	$id = $_POST['totales_fecha'];

	$html = '';

	$sql1 = "SELECT * FROM presabana WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	while ($row1=mysqli_fetch_array($proceso1)) {
		$desde = $row1["inicio"];
		$hasta = $row1["fin"];
	}

	$sql2 = "SELECT sum(tokens) as tokens FROM chaturbate WHERE fecha BETWEEN '$desde' AND '$hasta'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$cha_tokens = $row2["tokens"];
		$cha_dolares = $row2["tokens"]*0.05;
	}

	$sql2 = "SELECT sum(tokens) as tokens FROM bonga WHERE fecha_desde BETWEEN '$desde' AND '$hasta'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$bon_tokens = $row2["tokens"];
		$bon_dolares = $row2["tokens"]*0.05;
	}

	$sql2 = "SELECT sum(tokens) as tokens FROM stripchat WHERE fecha BETWEEN '$desde' AND '$hasta'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$strip_tokens = $row2["tokens"];
		$strip_dolares = $row2["tokens"]*0.05;
	}

	$sql2 = "SELECT sum(tokens) as tokens FROM cam4 WHERE fecha_desde BETWEEN '$desde' AND '$hasta'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$cam_tokens = $row2["tokens"];
		$cam_dolares = $row2["tokens"]*0.05;
	}

	$sql2 = "SELECT sum(tokens) as tokens FROM streamate WHERE fecha_desde BETWEEN '$desde' AND '$hasta'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$strea_tokens = $row2["tokens"];
		$strea_dolares = $row2["tokens"]*0.05;
	}

	$sql2 = "SELECT sum(tokens) as tokens FROM camsoda WHERE fecha_desde BETWEEN '$desde' AND '$hasta'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$cams_tokens = $row2["tokens"];
		$cams_dolares = $row2["tokens"]*0.05;
	}

	$sql2 = "SELECT sum(tokens) as tokens FROM xlove WHERE fecha_desde BETWEEN '$desde' AND '$hasta'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$xlo_tokens = $row2["tokens"];
		$xlo_dolares = $row2["tokens"]*0.05;
	}

	$sql2 = "SELECT sum(tokens) as tokens FROM flirt4free WHERE fecha_desde BETWEEN '$desde' AND '$hasta'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$fli_tokens = $row2["tokens"];
		$fli_dolares = $row2["tokens"]*0.05;
	}

	$sql2 = "SELECT sum(tokens) as tokens FROM myfreecams WHERE fecha_desde BETWEEN '$desde' AND '$hasta'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$my_tokens = $row2["tokens"];
		$my_dolares = $row2["tokens"]*0.05;
	}

	$sql2 = "SELECT sum(tokens) as tokens FROM imlive WHERE fecha_desde BETWEEN '$desde' AND '$hasta'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$iml_tokens = $row2["tokens"];
		$iml_dolares = $row2["tokens"]*0.05;
	}

	$total_sedes = $cha_dolares+$bon_dolares+$strip_dolares+$cam_dolares+$strea_dolares+$cams_dolares+$xlo_dolares+$fli_dolares+$my_dolares+$iml_dolares;

	$html .= '

	<div class="col-3 text-center" style="font-weight: bold; font-size: 20px;">SUBTOTAL</div>
	<div class="col-6 text-center" style="font-weight: bold; font-size: 20px;">DESCUENTOS</div>
	<div class="col-3 text-center" style="font-weight: bold; font-size: 20px;">TOTAL</div>
	<div class="col-3 text-center">Cantidad SUBTOTAL</div>
	<div class="col-3 text-center">(3%): Cantidad</div>
	<div class="col-3 text-center">(6%): Cantidad</div>
	<div class="col-3 text-center">Cantidad Total</div>

	<div class="col-12 mt-3 mb-3">
		<table border="1" class="table">
			<thead>
				<tr>
					<td></td>
					<td style="font-weight: bold;">Chaturbate</td>
					<td style="font-weight: bold;">Bonga</td>
					<td style="font-weight: bold;">Stripchat</td>
					<td style="font-weight: bold;">Cam4</td>
					<td style="font-weight: bold;">Streamate</td>
					<td style="font-weight: bold;">Camsoda</td>
					<td style="font-weight: bold;">Xlove</td>
					<td style="font-weight: bold;">Flirt4free</td>
					<td style="font-weight: bold;">Paxum</td>
					<td style="font-weight: bold;">Epay</td>
					<td style="font-weight: bold;">Total Sede</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="font-weight: bold;">Total Página</td>
					<td>$'.$cha_dolares.'</td>
					<td>$'.$bon_dolares.'</td>
					<td>$'.$strip_dolares.'</td>
					<td>$'.$cam_dolares.'</td>
					<td>$'.$strea_dolares.'</td>
					<td>$'.$cams_dolares.'</td>
					<td>$'.$xlo_dolares.'</td>
					<td>$'.$fli_dolares.'</td>
					<td>$'.$my_dolares.'</td>
					<td>$'.$iml_dolares.'</td>
					<td>$'.$total_sedes.'</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">VIP Occ</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">VIP Suba</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
				</tr>

				<tr>
					<td style="font-weight: bold;">Occ 1</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Norte</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
				</tr>

				<tr>
					<td style="font-weight: bold;">Residuales</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
					<td>$'.$cha_tokens.'</td>
				</tr>
			</tbody>
		</table>
	</div>

	';

    $datos = [
		"estatus" => "ok",
		"html" => $html,
		"cha_tokens" => $cha_tokens,
	];
	echo json_encode($datos);
}

?>