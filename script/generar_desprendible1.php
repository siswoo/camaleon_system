<?php
session_start();
include('conexion.php');
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
$desprendible_fecha_desde 	= $_POST['desprendible_fecha_desde'];
$desprendible_fecha_hasta 	= $_POST['desprendible_fecha_hasta'];
$desprendible_trm 			= $_POST['desprendible_trm'];
$responsable = $_SESSION['id'];
$fecha_inicio = date('Y-m-d');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Sede');
$sheet->setCellValue('B1', 'Modelo');
$sheet->setCellValue('C1', 'Tipo Doc');
$sheet->setCellValue('D1', 'Numero Doc');
$sheet->setCellValue('E1', 'fecha inicio');
$sheet->setCellValue('F1', 'fecha fin');
$sheet->setCellValue('G1', 'Chaturbate');
$sheet->setCellValue('H1', 'Imlive');
$sheet->setCellValue('I1', 'Xlove');
$sheet->setCellValue('J1', 'Stripchat');
$sheet->setCellValue('K1', 'Streamate');
$sheet->setCellValue('L1', 'Myfreecams');
$sheet->setCellValue('M1', 'Livejasmin');
$sheet->setCellValue('N1', 'Bonga');
$sheet->setCellValue('O1', 'Cam4');
$sheet->setCellValue('P1', 'Camsoda');
$sheet->setCellValue('Q1', 'Flirt4free');
$sheet->setCellValue('R1', 'Total Tokens');
$sheet->setCellValue('S1', 'SubT Dolares');
$sheet->setCellValue('T1', 'RF');
$sheet->setCellValue('U1', 'Meta Porcentaje');
$sheet->setCellValue('V1', 'Total en Pesos');
$sheet->setCellValue('W1', 'Total Dolares');
$sheet->setCellValue('X1', 'TRM');
$sheet->setCellValue('Y1', 'PV');
$fila = 2;

$sql1 = "SELECT * FROM modelos";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$modelo_id = $row1['id'];
	$modelo_sede = $row1['sede'];
	$documento_tipo = $row1['documento_tipo'];
	$documento_numero = $row1['documento_numero'];
	$modelo_nombre_completo = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];

	$sql2 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$modelo_id;
	$consulta2 = mysqli_query($conexion,$sql2);

	$contador_tokens1 = 0;
	$contador_tokens_chaturbate1 = 0;
	$contador_tokens_myfreecams1 = 0;
	$contador_tokens_camsoda1 = 0;
	$contador_tokens_bonga1 = 0;
	$contador_tokens_stripchat1 = 0;
	$contador_tokens_cam41 = 0;
	$contador_tokens_streamate1 = 0;
	$contador_tokens_flirt4free1 = 0;
	$contador_tokens_livejasmin1 = 0;
	$contador_tokens_imlive1 = 0;
	$contador_tokens_xlove1 = 0;

	$contador_dolares_chaturbate1 = 0;
	$contador_dolares_myfreecams1 = 0;
	$contador_dolares_camsoda1 = 0;
	$contador_dolares_bonga1 = 0;
	$contador_dolares_stripchat1 = 0;
	$contador_dolares_cam41 = 0;
	$contador_dolares_streamate1 = 0;
	$contador_dolares_flirt4free1 = 0;
	$contador_dolares_livejasmin1 = 0;
	$contador_dolares_imlive1 = 0;
	$contador_dolares_xlove1 = 0;

	/**************CONSULTA DE PAGINAS************/

	while($row2 = mysqli_fetch_array($consulta2)) {
		
		if($row2['id_paginas']==1){
			$sql_paginas1 = "SELECT * FROM chaturbate WHERE nickname = '".$row2['usuario']."' and fecha BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_chaturbate1 = $contador_tokens_chaturbate1 + $row3['tokens'];
				$contador_dolares_chaturbate1 = $contador_dolares_chaturbate1 + $row3['payout'];
			}
		}

		if($row2['id_paginas']==2){
			$sql_paginas1 = "SELECT * FROM myfreecams WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_myfreecams1 = $contador_tokens_myfreecams1 + $row3['tokens'];
				$contador_dolares_myfreecams1 = $contador_dolares_myfreecams1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==3){
			$sql_paginas1 = "SELECT * FROM camsoda WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_camsoda1 = $contador_tokens_camsoda1 + $row3['tokens'];
				$contador_dolares_camsoda1 = $contador_dolares_camsoda1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==4){
			$sql_paginas1 = "SELECT * FROM bonga WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_bonga1 = $contador_tokens_bonga1 + $row3['tokens'];
				$contador_dolares_bonga1 = $contador_dolares_bonga1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==5){
			$sql_paginas1 = "SELECT * FROM stripchat WHERE nickname = '".$row2['usuario']."' and fecha BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_stripchat1 = $contador_tokens_stripchat1 + $row3['tokens'];
				$contador_dolares_stripchat1 = $contador_dolares_stripchat1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==6){
			$sql_paginas1 = "SELECT * FROM cam4 WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_cam41 = $contador_tokens_cam41 + $row3['tokens'];
				$contador_dolares_cam41 = $contador_dolares_cam41 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==7){
			$sql_paginas1 = "SELECT * FROM streamate WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_streamate1 = $contador_tokens_streamate1 + $row3['tokens'];
				$contador_dolares_streamate1 = $contador_dolares_streamate1 + $row3['ganancia'];
			}
		}

		if($row2['id_paginas']==8){
			$sql_paginas1 = "SELECT * FROM flirt4free WHERE id_modelo = '".$modelo_id."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_flirt4free1 = $contador_tokens_flirt4free1 + $row3['tokens'];
				$contador_dolares_flirt4free1 = $contador_dolares_flirt4free1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==9){
			$sql_paginas1 = "SELECT * FROM livejasmin WHERE id_modelo = '".$modelo_id."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_livejasmin1 = $contador_tokens_livejasmin1 + $row3['tokens'];
				$contador_dolares_livejasmin1 = $contador_dolares_livejasmin1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==10){
			$sql_paginas1 = "SELECT * FROM imlive WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_imlive1 = $contador_tokens_imlive1 + $row3['tokens'];
				$contador_dolares_imlive1 = $contador_dolares_imlive1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==11){
			$sql_paginas1 = "SELECT * FROM xlove WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_xlove1 = $contador_tokens_xlove1 + $row3['tokens'];
				$contador_dolares_xlove1 = $contador_dolares_xlove1 + $row3['dolares'];
			}
		}		

		/*
		$spreadsheet->getActiveSheet()->getCell('B'.$fila)->setValue($numero_documento);
		$spreadsheet->getActiveSheet()->getStyle('B'.$fila)->getNumberFormat()->setFormatCode('00');
		$sheet->setCellValue('C'.$fila, $primer_nombre);
		$sheet->setCellValue('D'.$fila, $segundo_nombre);
		$sheet->setCellValue('E'.$fila, $primer_apellido);
		$sheet->setCellValue('F'.$fila, $segundo_apellido);
		$sheet->setCellValue('G'.$fila, $genero);
		$sheet->setCellValue('H'.$fila, $correo);
		$sheet->setCellValue('I'.$fila, "".$telefono1."");
		$sheet->setCellValue('J'.$fila, $direccion);
		$sheet->setCellValue('K'.$fila, $estatus);
		$sheet->setCellValue('L'.$fila, $barrio);
		$sheet->setCellValue('M'.$fila, $sede_nombre);
		$sheet->setCellValue('N'.$fila, $fecha_inicio);
		$sheet->setCellValue('X'.$fila, $sede);
		*/
	}


		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(60);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
		$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);

		$sheet->setCellValue('A'.$fila, $modelo_sede);
		$sheet->setCellValue('B'.$fila, $modelo_nombre_completo);
		$sheet->setCellValue('C'.$fila, $documento_tipo);
		$spreadsheet->getActiveSheet()->getCell('D'.$fila)->setValue($documento_numero);
		$spreadsheet->getActiveSheet()->getStyle('D'.$fila)->getNumberFormat()->setFormatCode('00');
		$sheet->setCellValue('E'.$fila, $desprendible_fecha_desde);
		$sheet->setCellValue('F'.$fila, $desprendible_fecha_hasta);
		$sheet->setCellValue('G'.$fila, $contador_tokens_chaturbate1);
		$sheet->setCellValue('H'.$fila, $contador_tokens_myfreecams1);
		$sheet->setCellValue('I'.$fila, $contador_tokens_camsoda1);
		$sheet->setCellValue('J'.$fila, $contador_tokens_bonga1);
		$sheet->setCellValue('K'.$fila, $contador_tokens_stripchat1);
		$sheet->setCellValue('L'.$fila, $contador_tokens_cam41);
		$sheet->setCellValue('M'.$fila, $contador_tokens_streamate1);
		$sheet->setCellValue('N'.$fila, $contador_tokens_flirt4free1);
		$sheet->setCellValue('O'.$fila, $contador_tokens_livejasmin1);
		$sheet->setCellValue('P'.$fila, $contador_tokens_imlive1);
		$sheet->setCellValue('Q'.$fila, $contador_tokens_xlove1);

		$total_tokens = $contador_tokens_chaturbate1+$contador_tokens_myfreecams1+$contador_tokens_camsoda1+$contador_tokens_bonga1+$contador_tokens_stripchat1+$contador_tokens_cam41+$contador_tokens_streamate1+$contador_tokens_flirt4free1+$contador_tokens_livejasmin1+$contador_tokens_imlive1+$contador_tokens_xlove1;

		$sheet->setCellValue('R'.$fila, $total_tokens);

		$subt_total_dolares = $contador_dolares_chaturbate1+$contador_dolares_myfreecams1+$contador_dolares_camsoda1+$contador_dolares_bonga1+$contador_dolares_stripchat1+$contador_dolares_cam41+$contador_dolares_streamate1+$contador_dolares_flirt4free1+$contador_dolares_livejasmin1+$contador_dolares_imlive1+$contador_dolares_xlove1;

		$sheet->setCellValue('S'.$fila, $subt_total_dolares);

		$retencion_fuente = $subt_total_dolares*0.03;

		$sheet->setCellValue('T'.$fila, $retencion_fuente);

		if($total_tokens==0){
			$meta1 = '0%';
			$meta2 = 0;
		}

		if($total_tokens>=1 and $total_tokens<=9999){
			$meta1 = '50%';
			$meta2 = 50;
		}

		if($total_tokens>=10000 and $total_tokens<=14999){
			$meta1 = '55%';
			$meta2 = 55;
		}

		if($total_tokens>=15000 and $total_tokens<=34999){
			$meta1 = '60%';
			$meta2 = 60;
		}

		if($total_tokens>=35000){
			$meta1 = '65%';
			$meta2 = 65;
		}

		//$desprendible_trm = 

		//QUEDE AQUI!

}

$datos = [
	"sql" 			=> $sql_paginas1,
];

echo json_encode($datos);

/*
$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('test '.$fecha_inicio1.'.xlsx');
header("Location: test ".$fecha_inicio1.".xlsx");
*/

?>